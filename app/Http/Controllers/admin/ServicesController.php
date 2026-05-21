<?php

namespace App\Http\Controllers\admin;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ServicesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Services::orderby('id', 'asc')->where('id', '>', 0);
            if ($request['search'] != '') {
                $query->where('heading', 'like', '%' . $request['search'] . '%');
            }
            if ($request['status'] != 'All') {
                if ($request['status'] == 2) {
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $models = $query->paginate(10);

            return (string) view('admin.services.search', compact('models'));
        }
        $page_title = 'All Services';
        $models = Services::orderby('id', 'asc')->paginate(10);

        return view('admin.services.index', compact('models', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Add Services';

        return view('admin.services.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|max:255',
            'description' => 'required|max:5000',
            'description_image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'benefit_image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'question_image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'questions' => 'required|array|min:1',
            'questions.*' => 'required|string|max:500',
            'benefits' => 'required|array|min:1',
            'benefits.*' => 'required|string|max:2000',
        ]);

        $model = new Services();
        $model->created_by = Auth::user()->id;
        $model->heading = $request->heading;
        $model->questions = $this->normalizeList($request->input('questions', []));
        $model->description = $request->description;
        $model->benefits = $this->normalizeList($request->input('benefits', []));
        $model->description_image = $this->storeServiceImage($request->file('description_image'), 'desc');
        $model->benefit_image = $this->storeServiceImage($request->file('benefit_image'), 'benefit');
        $model->question_image = $this->storeServiceImage($request->file('question_image'), 'question');
        $model->save();

        return redirect()->route('service.index')->with('message', 'Services Added Successfully !');
    }

    public function show($id)
    {
        $page_title = 'Show Services';
        $model = Services::where('id', $id)->first();

        return view('admin.services.show', compact('model', 'page_title'));
    }

    public function edit($id)
    {
        $page_title = 'Edit Services';
        $model = Services::where('id', $id)->first();

        return view('admin.services.edit', compact('model', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $update = Services::where('id', $id)->firstOrFail();

        $imageRule = ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'];

        $request->validate([
            'heading' => 'required|max:255',
            'description' => 'required|max:5000',
            'description_image' => array_merge(
                [Rule::requiredIf(fn () => empty($update->description_image))],
                $imageRule
            ),
            'benefit_image' => array_merge(
                [Rule::requiredIf(fn () => empty($update->benefit_image))],
                $imageRule
            ),
            'question_image' => array_merge(
                [Rule::requiredIf(fn () => empty($update->question_image))],
                $imageRule
            ),
            'questions' => 'required|array|min:1',
            'questions.*' => 'required|string|max:500',
            'benefits' => 'required|array|min:1',
            'benefits.*' => 'required|string|max:2000',
            'status' => 'nullable|in:0,1',
        ]);

        $update->heading = $request->heading;
        $update->questions = $this->normalizeList($request->input('questions', []));
        $update->description = $request->description;
        $update->benefits = $this->normalizeList($request->input('benefits', []));
        $update->status = $request->status ?? $update->status;

        if ($request->hasFile('description_image')) {
            $this->deleteServiceImage($update->description_image);
            $update->description_image = $this->storeServiceImage($request->file('description_image'), 'desc');
        }
        if ($request->hasFile('benefit_image')) {
            $this->deleteServiceImage($update->benefit_image);
            $update->benefit_image = $this->storeServiceImage($request->file('benefit_image'), 'benefit');
        }
        if ($request->hasFile('question_image')) {
            $this->deleteServiceImage($update->question_image);
            $update->question_image = $this->storeServiceImage($request->file('question_image'), 'question');
        }

        $update->save();

        return redirect()->route('service.index')->with('message', 'Services Updated Successfully !');
    }

    public function destroy($id)
    {
        $model = Services::where('id', $id)->first();
        if ($model) {
            $this->deleteServiceImage($model->description_image);
            $this->deleteServiceImage($model->benefit_image);
            $this->deleteServiceImage($model->question_image);
            $model->delete();

            return true;
        }

        return response()->json(['message' => 'Failed '], 404);
    }

    /**
     * @param  array<int, mixed>  $items
     * @return array<int, string>
     */
    private function normalizeList(array $items): array
    {
        return array_values(array_filter(array_map(function ($item) {
            return is_string($item) ? trim($item) : '';
        }, $items), fn ($item) => $item !== ''));
    }

    private function servicesImageDir(): string
    {
        $dir = public_path('assets/website/images/services');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        return $dir;
    }

    private function storeServiceImage($file, string $prefix): string
    {
        $filename = date('YmdHis') . '_' . $prefix . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($this->servicesImageDir(), $filename);

        return $filename;
    }

    private function deleteServiceImage(?string $filename): void
    {
        $filename = trim((string) $filename);
        if ($filename === '') {
            return;
        }
        $path = $this->servicesImageDir() . DIRECTORY_SEPARATOR . $filename;
        if (is_file($path)) {
            @unlink($path);
        }
    }
}
