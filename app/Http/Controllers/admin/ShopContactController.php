<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShopContact;
use Illuminate\Http\Request; 
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;    
class ShopContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = ShopContact::orderby('id', 'desc')->where('id', '>', 0);
            $search = $request->input('search', '');
            if ($search !== '' && $search !== null && $search !== 'undefined') {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('message', 'like', '%' . $search . '%');
                });
            }
            $status = $request->input('status', 'All');
            if ($status !== 'All' && $status !== '' && $status !== 'undefined' && in_array((string) $status, ['0', '1', '2'])) {
                $statusVal = ($status == '2') ? 0 : (int) $status;
                $query->where('status', $statusVal);
            }
            $models = $query->paginate(10);
            return (string) view('admin.shop_contact.search', compact('models'));
        }

        $page_title = 'Shop & Contact Form';
        $totalShopContacts = ShopContact::count();
        $models = ShopContact::orderby('id', 'desc')->paginate(10);
        return view('admin.shop_contact.index', compact('page_title', 'models', 'totalShopContacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:50',
            'message' => 'required|string|max:2000',
        ]);

        $model = new ShopContact();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->message = $request->message;
        $model->save();

        $contactData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];

        // Always send shop contact form notification to admin
        $adminEmail = 'asjadmmc67@gmail.com';
        try {
            Mail::to($adminEmail)->send(new ContactFormMail($contactData));
            Log::info('Shop contact form email sent to ' . $adminEmail);
        } catch (\Exception $e) {
            Log::error('Shop contact form email failed', [
                'to' => $adminEmail,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you soon.'
            ], 200, ['Content-Type' => 'application/json']);
        }

        return redirect()->back()->with('status', 'Your message has been sent. Thank you!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = ShopContact::findOrFail($id);
        $page_title = 'Shop & Contact Form Details';
        return view('admin.shop_contact.show', compact('model', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShopContact $shopContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShopContact $shopContact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = ShopContact::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
