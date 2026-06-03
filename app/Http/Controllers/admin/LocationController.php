<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:location-list|location-create|location-edit|location-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:location-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:location-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $models = $this->filteredQuery($request)->paginate(10);

            return (string) view('admin.locations.search', compact('models'));
        }

        $page_title = 'All Locations';
        $totalLocations = Location::count();
        $activeLocations = Location::whereIn('status', [1, '1'])->count();
        $inactiveLocations = $totalLocations - $activeLocations;
        $models = Location::query()->orderBy('sort_order')->orderBy('id')->paginate(10);

        return view('admin.locations.index', compact(
            'models',
            'page_title',
            'totalLocations',
            'activeLocations',
            'inactiveLocations'
        ));
    }

    public function create()
    {
        $page_title = 'Add Location';

        return view('admin.locations.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        $existing = Location::where('name', $request->name)->first();
        if ($existing) {
            return redirect()->back()->withErrors(['name' => 'This location name already exists.'])->withInput();
        }

        $model = new Location();
        $this->fillFromRequest($model, $request);

        if ($request->hasFile('image')) {
            $model->image = $this->storeImage($request->file('image'));
        }

        $model->slug = Location::uniqueSlug($request->name);
        $model->status = $request->input('status', 1);
        $model->save();

        return redirect()->route('location.index')->with('message', 'Location added successfully.');
    }

    public function show($id)
    {
        $page_title = 'View Location';
        $model = Location::findOrFail($id);

        return view('admin.locations.show', compact('model', 'page_title'));
    }

    public function edit($id)
    {
        $page_title = 'Edit Location';
        $model = Location::findOrFail($id);

        return view('admin.locations.edit', compact('page_title', 'model'));
    }

    public function update(Request $request, $id)
    {
        $model = Location::findOrFail($id);
        $request->validate($this->validationRules($model));

        $existing = Location::where('name', $request->name)->where('id', '!=', $model->id)->first();
        if ($existing) {
            return redirect()->back()->withErrors(['name' => 'This location name already exists.'])->withInput();
        }

        $this->fillFromRequest($model, $request);

        if ($request->hasFile('image')) {
            $this->deleteImage($model->image);
            $model->image = $this->storeImage($request->file('image'));
        }

        if ($request->filled('slug')) {
            $slug = \Str::slug($request->slug);
            if (
                Location::where('slug', $slug)->where('id', '!=', $model->id)->exists()
            ) {
                return redirect()->back()->withErrors(['slug' => 'This URL slug is already in use.'])->withInput();
            }
            $model->slug = $slug;
        } else {
            $model->slug = Location::uniqueSlug($request->name, $model->id);
        }

        $model->status = $request->input('status', 0);
        $model->save();

        return redirect()->route('location.index')->with('message', 'Location updated successfully.');
    }

    public function destroy($id)
    {
        $location = Location::find($id);
        if (! $location) {
            return response()->json(['message' => 'Failed'], 404);
        }

        $this->deleteImage($location->image);
        $location->delete();

        return true;
    }

    private function filteredQuery(Request $request)
    {
        $query = Location::query()->orderBy('sort_order')->orderBy('id');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request['search'] . '%')
                    ->orWhere('slug', 'like', '%' . $request['search'] . '%');
            });
        }

        if ($request['status'] != 'All') {
            $status = $request['status'] == 2 ? 0 : $request['status'];
            $query->where('status', $status);
        }

        return $query;
    }

    /** @return array<string, mixed> */
    private function validationRules(?Location $model = null): array
    {
        $imageRule = ['nullable', 'image', 'mimes:jpeg,webp,png,jpg,gif', 'max:5120'];

        return [
            'name' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:2000',
            'hero_eyebrow' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_lead' => 'nullable|string|max:2000',
            'welcome_label' => 'nullable|string|max:255',
            'welcome_title' => 'nullable|string|max:255',
            'welcome_paragraphs' => 'nullable|array',
            'welcome_paragraphs.*' => 'nullable|string|max:5000',
            'welcome_highlights' => 'nullable|array',
            'welcome_highlights.*' => 'nullable|string|max:500',
            'welcome_services' => 'nullable|array',
            'welcome_services.*.title' => 'nullable|string|max:255',
            'welcome_services.*.text' => 'nullable|string|max:2000',
            'process_label' => 'nullable|string|max:255',
            'process_title' => 'nullable|string|max:255',
            'process_items' => 'nullable|array',
            'process_items.*.title' => 'nullable|string|max:255',
            'process_items.*.text' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0|max:9999',
            'status' => 'nullable|in:0,1',
            'image' => array_merge(
                [Rule::requiredIf(fn () => ! $model || ! $model->image)],
                $imageRule
            ),
        ];
    }

    private function fillFromRequest(Location $model, Request $request): void
    {
        $model->name = $request->name;
        $model->meta_title = $request->meta_title;
        $model->meta_description = $request->meta_description;
        $model->hero_eyebrow = $request->hero_eyebrow;
        $model->hero_title = $request->hero_title;
        $model->hero_lead = $request->hero_lead;
        $model->welcome_label = $request->welcome_label;
        $model->welcome_title = $request->welcome_title;
        $model->welcome_paragraphs = Location::normalizeList($request->input('welcome_paragraphs', []));
        $model->welcome_highlights = Location::normalizeList($request->input('welcome_highlights', []));
        $model->welcome_services = Location::normalizePairs($request->input('welcome_services', []));
        $model->process_label = $request->process_label;
        $model->process_title = $request->process_title;
        $model->process_items = Location::normalizePairs($request->input('process_items', []));
        $model->sort_order = (int) $request->input('sort_order', 0);
    }

    private function storeImage($file): string
    {
        $dir = public_path('admin/assets/images/locations');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $photo = date('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $photo);

        return $photo;
    }

    private function deleteImage(?string $filename): void
    {
        if (! $filename) {
            return;
        }

        $path = public_path('admin/assets/images/locations/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
