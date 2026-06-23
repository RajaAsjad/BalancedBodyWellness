<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Faq;
use App\Models\Services;
use App\Mail\ContactFormMail;
use App\Rules\ContactCaptchaRule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = ContactUs::orderby('id', 'desc')->where('id', '>', 0);
            $search = $request->input('search', '');
            if ($search !== '' && $search !== null && $search !== 'undefined') {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('service_of_interest', 'like', '%' . $search . '%')
                        ->orWhere('preferred_date', 'like', '%' . $search . '%')
                        ->orWhere('message', 'like', '%' . $search . '%');
                });
            }
            $status = $request->input('status', 'All');
            if ($status !== 'All' && $status !== '' && $status !== 'undefined' && in_array((string) $status, ['0', '1', '2'])) {
                $statusVal = ($status == '2') ? 0 : (int) $status;
                $query->where('status', $statusVal);
            }
            $models = $query->paginate(10);
            return (string) view('admin.contact_us.search', compact('models'));
        }

        $page_title = 'All Contact Me';
        $totalContacts = ContactUs::count();
        $models = ContactUs::orderby('id', 'desc')->paginate(10);
        return view('admin.contact_us.index', compact('page_title', 'models', 'totalContacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = ContactUs::findOrFail($id);
        return view('admin.contact_us.show', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:200',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:50', 
            'preferred_date' => 'nullable|date',
            'service_of_interest' => 'nullable|string|max:150',
            'message' => 'nullable|string|max:2000',
            'captcha_token' => 'required|string|size:40',
            'captcha_code' => ['required', 'string', 'max:5', new ContactCaptchaRule()],
        ]);

        $note = trim((string) $request->message);
        $preferredRaw = $request->input('preferred_date');
        $preferredDate = null;
        if ($preferredRaw !== null && $preferredRaw !== '') {
            try {
                $preferredDate = \Carbon\Carbon::parse($preferredRaw)->toDateString();
            } catch (\Throwable $e) {
                return redirect()->route('contact')->withErrors(['preferred_date' => 'Please choose a valid date.'])->withInput();
            }
        }

        $serviceLabel = $this->resolveServiceOfInterest($request->input('service_of_interest'));

        if ($preferredDate === null && $note === '' && $serviceLabel === null) {
            return redirect()->route('contact')->withErrors([
                'message' => 'Please select a service, add a preferred date, or write a message.',
            ])->withInput();
        }

        $fullName = trim($request->full_name);
        $parts = preg_split('/\s+/', $fullName, 2);
        $firstName = $parts[0] ?? $fullName;
        $lastName = $parts[1] ?? '';

        $model = new ContactUs();
        $model->first_name = $firstName;
        $model->last_name = $lastName;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->service_of_interest = $serviceLabel;
        $model->preferred_date = $preferredDate;
        $model->message = $note !== '' ? $note : null;
        $model->captcha_code = strtoupper(trim((string) $request->captcha_code));
        $model->save();

        $contactData = [
            'full_name' => $fullName,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $request->email,
            'phone' => $request->phone, 
            'service_of_interest' => $serviceLabel,
            'preferred_date' => $preferredDate,
            'message' => $note,
        ];

        // Notify configured forwarder inboxes (see CONTACT_FORM_RECIPIENTS in .env)
        $recipients = array_values(array_filter(config('mail.contact_form_recipients', [])));
        if ($recipients !== []) {
            try {
                Mail::to($recipients)->send(new ContactFormMail($contactData));
                Log::info('Contact form email sent', ['to' => $recipients]);
            } catch (\Exception $e) {
                Log::error('Contact form email failed', [
                    'to' => $recipients,
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us! We will get back to you soon.'
            ]);
        }

        return redirect()->route('contact')->with('status', 'Your message has been sent. Thank you!');
    }

    private function resolveServiceOfInterest(?string $value): ?string
    {
        $value = trim((string) $value);
        if ($value === '') {
            return null;
        }

        if (str_starts_with($value, 'page:')) {
            $slug = substr($value, 5);

            return Faq::landingPageLabel($slug) ?: $slug;
        }

        if (str_starts_with($value, 'service:')) {
            $id = (int) substr($value, 8);

            return Services::query()->whereKey($id)->value('heading');
        }

        if (ctype_digit($value)) {
            return Services::query()->whereKey((int) $value)->value('heading');
        }

        return $value;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ContactUs::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
