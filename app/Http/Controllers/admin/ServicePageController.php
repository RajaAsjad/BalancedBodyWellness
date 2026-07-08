<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:servicepage-list|servicepage-create|servicepage-edit|servicepage-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:servicepage-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:servicepage-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:servicepage-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $models = $this->filteredQuery($request)->paginate(10);

            return (string) view('admin.service_pages.search', compact('models'));
        }

        $page_title = 'All Service Pages';
        $totalPages = ServicePage::count();
        $activePages = ServicePage::whereIn('status', [1, '1'])->count();
        $inactivePages = $totalPages - $activePages;
        $models = ServicePage::query()->orderBy('sort_order')->orderBy('id')->paginate(10);

        return view('admin.service_pages.index', compact(
            'models',
            'page_title',
            'totalPages',
            'activePages',
            'inactivePages'
        ));
    }

    public function create()
    {
        $page_title = 'Add Service Page';

        return view('admin.service_pages.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        $existing = ServicePage::where('slug', $request->slug)->first();
        if ($existing) {
            return redirect()->back()->withErrors(['slug' => 'This URL slug is already in use.'])->withInput();
        }

        $model = new ServicePage();
        $this->fillFromRequest($model, $request);
        $model->slug = Str::slug($request->slug);
        $model->status = $request->input('status', 1);
        $model->show_in_nav = $request->boolean('show_in_nav', true);
        $model->is_legacy = false;
        $model->save();

        return redirect()->route('servicePage.index')->with('message', 'Service page added successfully.');
    }

    public function show($id)
    {
        $page_title = 'View Service Page';
        $model = ServicePage::findOrFail($id);

        return view('admin.service_pages.show', compact('model', 'page_title'));
    }

    public function edit($id)
    {
        $page_title = 'Edit Service Page';
        $model = ServicePage::findOrFail($id);

        return view('admin.service_pages.edit', compact('page_title', 'model'));
    }

    public function update(Request $request, $id)
    {
        $model = ServicePage::findOrFail($id);
        $request->validate($this->validationRules($model));

        if ($request->filled('slug')) {
            $slug = Str::slug($request->slug);
            if (ServicePage::where('slug', $slug)->where('id', '!=', $model->id)->exists()) {
                return redirect()->back()->withErrors(['slug' => 'This URL slug is already in use.'])->withInput();
            }
            $model->slug = $slug;
        }

        $this->fillFromRequest($model, $request);
        $model->status = $request->input('status', 0);
        $model->show_in_nav = $request->boolean('show_in_nav');
        $model->save();

        return redirect()->route('servicePage.index')->with('message', 'Service page updated successfully.');
    }

    public function destroy($id)
    {
        $page = ServicePage::find($id);
        if (! $page) {
            return response()->json(['message' => 'Failed'], 404);
        }

        $page->delete();

        return true;
    }

    private function filteredQuery(Request $request)
    {
        $query = ServicePage::query()->orderBy('sort_order')->orderBy('id');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request['search'] . '%')
                    ->orWhere('slug', 'like', '%' . $request['search'] . '%')
                    ->orWhere('nav_label', 'like', '%' . $request['search'] . '%');
            });
        }

        if ($request['status'] != 'All') {
            $status = $request['status'] == 2 ? 0 : $request['status'];
            $query->where('status', $status);
        }

        return $query;
    }

    /** @return array<string, mixed> */
    private function validationRules(?ServicePage $model = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'nav_label' => 'nullable|string|max:255',
            'slug' => $model === null
                ? ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/']
                : ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:2000',
            'hero_eyebrow' => 'nullable|string|max:255',
            'hero_title_style' => 'nullable|string|max:50',
            'hero_title_prefix' => 'nullable|string|max:255',
            'hero_title_main' => 'nullable|string|max:255',
            'hero_title_accent' => 'nullable|string|max:255',
            'hero_title_suffix' => 'nullable|string|max:255',
            'hero_lead' => 'nullable|string|max:2000',
            'overview_label' => 'nullable|string|max:255',
            'overview_title' => 'nullable|string|max:255',
            'overview_paragraphs' => 'nullable|array',
            'overview_paragraphs.*' => 'nullable|string|max:5000',
            'overview_features' => 'nullable|array',
            'overview_features.*.title' => 'nullable|string|max:255',
            'overview_features.*.text' => 'nullable|string|max:2000',
            'drip_menu_title' => 'nullable|string|max:255',
            'drip_menu_items' => 'nullable|array',
            'drip_menu_items.*.title' => 'nullable|string|max:255',
            'drip_menu_items.*.text' => 'nullable|string|max:2000',
            'supports_label' => 'nullable|string|max:255',
            'supports_title' => 'nullable|string|max:255',
            'supports_lead' => 'nullable|string|max:2000',
            'supports_items' => 'nullable|array',
            'supports_items.*.title' => 'nullable|string|max:255',
            'supports_items.*.text' => 'nullable|string|max:2000',
            'supports_stats' => 'nullable|array',
            'supports_stats.*.value' => 'nullable|string|max:100',
            'supports_stats.*.label' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0|max:9999',
            'show_in_nav' => 'nullable|boolean',
            'status' => 'nullable|in:0,1',
        ];
    }

    private function fillFromRequest(ServicePage $model, Request $request): void
    {
        $model->name = $request->name;
        $model->nav_label = $request->nav_label;
        $model->meta_title = $request->meta_title;
        $model->meta_description = $request->meta_description;
        $model->hero = ServicePage::buildHeroFromInput($request->all());
        $model->overview = ServicePage::buildOverviewFromInput($request->all());
        $model->drip_menu = ServicePage::buildDripMenuFromInput($request->all());
        $model->supports = ServicePage::buildSupportsFromInput($request->all());
        $model->sort_order = (int) $request->input('sort_order', 0);
    }
}
