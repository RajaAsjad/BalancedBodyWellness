<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blog_Categories;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:blog-list|blog-create|blog-edit|blog-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:blog-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blog-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Blog::orderby('id', 'desc')->where('id', '>', 0);
            if ($request['search'] != '') {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%'.$request['search'].'%')
                        ->orWhere('slug', 'like', '%'.$request['search'].'%')
                        ->orWhere('meta_title', 'like', '%'.$request['search'].'%')
                        ->orWhere('meta_description', 'like', '%'.$request['search'].'%');
                });
            }
            $this->applyAdminStatusFilter($query, $request['status'] ?? 'All');
            $models = $query->paginate(10);

            return (string) view('admin.blog.search', compact('models'));
        }
        $page_title = 'All Blogs';
        $models = Blog::orderby('id', 'desc')->paginate(10);

        return view('admin.blog.index', compact('models', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Add Blog';
        $categories = Blog_Categories::where('status', 1)->get();

        return view('admin.blog.create', compact('categories', 'page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif',
            'short_description' => 'required',
            'description' => 'required',
            'publish_mode' => 'required|in:active,inactive,scheduled',
            'published_at' => 'required_if:publish_mode,scheduled|nullable|date|after:now',
        ]);

        $model = new Blog();

        if ($request->hasFile('image')) {
            $model->image = $this->storeBlogImage($request->file('image'));
        }

        $model->created_by = Auth::user()->id;
        $model->slug = $request->slug;
        $model->meta_title = $request->meta_title;
        $model->meta_description = $request->meta_description;
        $model->name = $request->name;
        $model->short_description = $request->short_description;
        $model->description = $request->description;
        $this->applyPublishSettings($model, $request);
        $model->save();

        return redirect()->route('blog.index')->with('message', 'Blog Added Successfully !');
    }

    public function show($id)
    {
        $page_title = 'Blog Details';
        $blog = Blog::with('hasCreatedBy')->where('id', $id)->firstOrFail();

        return view('admin.blog.show', compact('blog', 'page_title'));
    }

    public function edit($id)
    {
        $page_title = 'Edit Blog';
        $model = Blog::where('id', $id)->first();
        $categories = Blog_Categories::where('status', 1)->get();
        $publish_mode = $this->resolvePublishMode($model);

        return view('admin.blog.edit', compact('model', 'categories', 'page_title', 'publish_mode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif',
            'short_description' => 'required',
            'description' => 'required',
            'publish_mode' => 'required|in:active,inactive,scheduled',
            'published_at' => 'required_if:publish_mode,scheduled|nullable|date|after:now',
        ]);

        $model = Blog::where('id', $id)->first();

        if ($request->hasFile('image')) {
            $this->deleteBlogImage($model->image);
            $model->image = $this->storeBlogImage($request->file('image'));
        }

        $model->slug = $request->slug;
        $model->meta_title = $request->meta_title;
        $model->meta_description = $request->meta_description;
        $model->name = $request->name;
        $model->short_description = $request->short_description;
        $model->description = $request->description;
        $this->applyPublishSettings($model, $request);
        $model->save();

        return redirect()->route('blog.index')->with('message', 'Blog Updated Successfully !');
    }

    public function destroy($id)
    {
        $model = Blog::where('id', $id)->first();
        if ($model) {
            $this->deleteBlogImage($model->image);
            $model->delete();

            return true;
        }

        return response()->json(['message' => 'Failed '], 404);
    }

    private function storeBlogImage($file): string
    {
        return $file->store('blogs', 'public');
    }

    private function deleteBlogImage(?string $path): void
    {
        $path = trim((string) $path);
        if ($path === '') {
            return;
        }

        if (str_starts_with($path, 'blogs/') && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);

            return;
        }

        if (Storage::disk('public')->exists('blogs/'.$path)) {
            Storage::disk('public')->delete('blogs/'.$path);

            return;
        }

        $legacy = public_path('admin/assets/images/blog/'.$path);
        if (is_file($legacy)) {
            @unlink($legacy);
        }
    }

    private function applyAdminStatusFilter($query, string $status): void
    {
        if ($status === 'All') {
            return;
        }

        if ($status === '2' || $status === '0') {
            $query->inactive();

            return;
        }

        if ($status === '3') {
            $query->scheduled();

            return;
        }

        $query->activePublished();
    }

    private function resolvePublishMode(Blog $blog): string
    {
        if (! $blog->status) {
            return 'inactive';
        }

        return $blog->isScheduled() ? 'scheduled' : 'active';
    }

    private function applyPublishSettings(Blog $model, Request $request): void
    {
        $publishMode = $request->input('publish_mode', 'active');

        if ($publishMode === 'inactive') {
            $model->status = 0;

            return;
        }

        $model->status = 1;

        if ($publishMode === 'scheduled') {
            $model->published_at = Carbon::parse($request->published_at);

            return;
        }

        $model->published_at = now();
    }
}
