<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FaqController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:faq-list|faq-create|faq-edit|faq-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:faq-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faq-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faq-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $faqPages = Faq::pageOptions();

        if ($request->ajax()) {
            $query = $this->faqListQuery();

            if ($request->filled('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('question', 'like', '%' . $request->search . '%')
                        ->orWhere('answer', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->get('status') !== 'All' && $request->get('status') !== null && $request->get('status') !== '') {
                $status = $request->status == 2 ? 0 : $request->status;
                $query->where('status', $status);
            }

            if ($request->filled('page_key') && $request->page_key !== 'All') {
                $query->where('page_key', $request->page_key);
            }

            $models = $query->paginate(10);

            return (string) view('admin.faq.search', compact('models', 'faqPages'));
        }

        $page_title = 'All FAQs';
        $models = $this->faqListQuery()->paginate(10);

        return view('admin.faq.index', compact('models', 'page_title', 'faqPages'));
    }

    public function create()
    {
        $page_title = 'Add FAQ';
        $faqPages = Faq::pageOptions();
        $services = $this->servicesForPicker();

        return view('admin.faq.create', compact('page_title', 'faqPages', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateFaq($request);

        $model = new Faq();
        $model->created_by = Auth::id();
        $this->fillFaqFromValidated($model, $validated);
        $model->save();

        return redirect()->route('faq.index')->with('message', 'FAQ added successfully.');
    }

    public function show($id)
    {
        $page_title = 'View FAQ';
        $model = Faq::with(['hasCreatedBy', 'service'])->findOrFail($id);

        return view('admin.faq.show', compact('model', 'page_title'));
    }

    public function edit($id)
    {
        $page_title = 'Edit FAQ';
        $model = Faq::findOrFail($id);
        $faqPages = Faq::pageOptions();
        $services = $this->servicesForPicker();
        $selectedServiceId = $model->service_id;

        return view('admin.faq.edit', compact('model', 'page_title', 'faqPages', 'services', 'selectedServiceId'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateFaq($request, true);

        $update = Faq::findOrFail($id);
        $this->fillFaqFromValidated($update, $validated);
        $update->save();

        return redirect()->route('faq.index')->with('message', 'FAQ updated successfully.');
    }

    public function destroy($id)
    {
        $model = Faq::find($id);
        if ($model) {
            $model->delete();

            return true;
        }

        return response()->json(['message' => 'Failed'], 404);
    }

    private function faqListQuery()
    {
        return Faq::query()
            ->with(['hasCreatedBy', 'service'])
            ->orderBy('page_key')
            ->orderBy('service_id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /** @return \Illuminate\Database\Eloquent\Collection<int, Services> */
    private function servicesForPicker()
    {
        return Services::query()->orderBy('heading')->get(['id', 'heading', 'status']);
    }

    /** @return array<string, mixed> */
    private function validateFaq(Request $request, bool $requireStatus = false): array
    {
        $pageKeys = array_keys(Faq::pageOptions());

        $rules = [
            'page_key' => ['required', Rule::in($pageKeys)],
            'service_id' => [
                Rule::requiredIf(fn () => $request->page_key === Faq::PAGE_SERVICE_DETAIL),
                'nullable',
                'integer',
                Rule::exists('services', 'id'),
            ],
            'question' => 'required|max:255',
            'answer' => 'required|max:5000',
            'sort_order' => 'nullable|integer|min:0|max:9999',
            'status' => ($requireStatus ? 'required' : 'nullable') . '|in:0,1',
        ];

        return $request->validate($rules);
    }

    /** @param  array<string, mixed>  $validated */
    private function fillFaqFromValidated(Faq $model, array $validated): void
    {
        $model->page_key = $validated['page_key'];
        $model->sort_order = (int) ($validated['sort_order'] ?? 0);
        $model->question = $validated['question'];
        $model->answer = $validated['answer'];
        $model->status = $validated['status'] ?? $model->status ?? 1;

        if ($validated['page_key'] === Faq::PAGE_SERVICE_DETAIL) {
            $model->service_id = (int) $validated['service_id'];
        } else {
            $model->service_id = null;
        }
    }
}
