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
        $page_title = 'Add FAQs';
        $faqPages = Faq::pageOptions();
        $services = $this->servicesForPicker();

        return view('admin.faq.create', compact('page_title', 'faqPages', 'services'));
    }

    public function store(Request $request)
    {
        $this->normalizeFaqItems($request);
        $validated = $this->validateFaqBulk($request, true);

        $baseSortOrder = (int) ($validated['sort_order'] ?? 0);
        $created = 0;

        foreach ($validated['faqs'] as $index => $item) {
            $model = new Faq();
            $model->created_by = Auth::id();
            $this->fillFaqFromValidated($model, array_merge($validated, [
                'question' => $item['question'],
                'answer' => $item['answer'],
                'sort_order' => $baseSortOrder + $index,
            ]));
            $model->save();
            $created++;
        }

        $message = $created === 1
            ? 'FAQ added successfully.'
            : $created . ' FAQs added successfully.';

        return redirect()->route('faq.index')->with('message', $message);
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
        $selectedServiceSlug = $model->service_slug;
        if (! $selectedServiceSlug && $model->service_id) {
            $heading = Services::query()->whereKey($model->service_id)->value('heading');
            $selectedServiceSlug = $heading ? \Illuminate\Support\Str::slug($heading) : '';
        }
        $selectedLocationSlug = $model->location_slug;

        return view('admin.faq.edit', compact(
            'model',
            'page_title',
            'faqPages',
            'services',
            'selectedServiceSlug',
            'selectedLocationSlug'
        ));
    }

    public function update(Request $request, $id)
    {
        $this->normalizeFaqItems($request);
        $validated = $this->validateFaqBulk($request, true);

        $update = Faq::findOrFail($id);
        $baseSortOrder = (int) ($validated['sort_order'] ?? 0);
        $created = 0;

        foreach ($validated['faqs'] as $index => $item) {
            if ($index === 0) {
                $faq = $update;
            } else {
                $faq = new Faq();
                $faq->created_by = Auth::id();
                $created++;
            }

            $this->fillFaqFromValidated($faq, array_merge($validated, [
                'question' => $item['question'],
                'answer' => $item['answer'],
                'sort_order' => $baseSortOrder + $index,
            ]));
            $faq->save();
        }

        $message = $created > 0
            ? 'FAQ updated and ' . $created . ' more added successfully.'
            : 'FAQ updated successfully.';

        return redirect()->route('faq.index')->with('message', $message);
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
            ->orderBy('location_slug')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /** @return \Illuminate\Database\Eloquent\Collection<int, Services> */
    private function servicesForPicker()
    {
        return Services::query()->orderBy('heading')->get(['id', 'heading', 'status']);
    }

    /** @return list<string> */
    private function allowedServiceSlugs(): array
    {
        return collect(Faq::serviceLandingPagesForPicker())
            ->pluck('slug')
            ->merge(
                $this->servicesForPicker()->map(fn (Services $s) => \Illuminate\Support\Str::slug($s->heading))
            )
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    /** @return list<string> */
    private function allowedLocationSlugs(): array
    {
        return collect(Faq::locationLandingPagesForPicker())
            ->pluck('slug')
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    /** @return array<string, mixed> */
    private function validateFaqBulk(Request $request, bool $requireStatus = false): array
    {
        $pageKeys = array_keys(Faq::pageOptions());

        $rules = [
            'page_key' => ['required', Rule::in($pageKeys)],
            'service_slug' => [
                Rule::requiredIf(fn () => $request->page_key === Faq::PAGE_SERVICE_DETAIL),
                'nullable',
                'string',
                'max:120',
                Rule::in($this->allowedServiceSlugs()),
            ],
            'location_slug' => [
                Rule::requiredIf(fn () => $request->page_key === Faq::PAGE_LOCATION_DETAIL),
                'nullable',
                'string',
                'max:120',
                Rule::in($this->allowedLocationSlugs()),
            ],
            'faqs' => 'required|array|min:1',
            'faqs.*.question' => 'required|max:255',
            'faqs.*.answer' => 'required|max:5000',
            'sort_order' => 'nullable|integer|min:0|max:9999',
            'status' => ($requireStatus ? 'required' : 'nullable') . '|in:0,1',
        ];

        return $request->validate($rules);
    }

    private function normalizeFaqItems(Request $request): void
    {
        $items = collect($request->input('faqs', []))
            ->map(fn ($item) => [
                'question' => trim((string) ($item['question'] ?? '')),
                'answer' => trim((string) ($item['answer'] ?? '')),
            ])
            ->filter(fn ($item) => $item['question'] !== '' || $item['answer'] !== '')
            ->values()
            ->all();

        $request->merge(['faqs' => $items]);
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
            $model->service_slug = $validated['service_slug'];
            $model->service_id = null;
            $model->location_slug = null;
        } elseif ($validated['page_key'] === Faq::PAGE_LOCATION_DETAIL) {
            $model->location_slug = $validated['location_slug'];
            $model->service_slug = null;
            $model->service_id = null;
        } else {
            $model->service_slug = null;
            $model->service_id = null;
            $model->location_slug = null;
        }
    }
}
