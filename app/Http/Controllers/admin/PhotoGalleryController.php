<?php

namespace App\Http\Controllers\admin;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class PhotoGalleryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:photogallery-list|photogallery-create|photogallery-edit|photogallery-delete', ['only' => ['index','store']]);
        $this->middleware('permission:photogallery-create', ['only' => ['create','store']]);
        $this->middleware('permission:photogallery-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:photogallery-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusFilter = $request->get('status');
        $query = PhotoGallery::orderBy('id', 'desc');
        if ($statusFilter !== null && $statusFilter !== '' && $statusFilter !== 'All') {
            $query->where('status', (string) $statusFilter);
        }
        $photoGalleries = $query->paginate(14)->withQueryString();

        if ($request->ajax()) {
            return (string) view('admin.photo_gallery.search', compact('photoGalleries'));
        }

        $page_title = 'Photo Gallery';
        $totalPhotos = PhotoGallery::count();
        $activePhotos = PhotoGallery::whereIn('status', ['1', 1])->count();
        $inactivePhotos = PhotoGallery::whereIn('status', ['0', 0])->count();
        return view('admin.photo_gallery.index', compact('photoGalleries', 'page_title', 'totalPhotos', 'activePhotos', 'inactivePhotos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Add Photo Gallery';
        return view('admin.photo_gallery.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'mimes:jpeg,webp,png,jpg,gif,svg,tif,tiff',
        ]);

        // Allow more than PHP default 20 file uploads per request (e.g. 93 images)
        if (function_exists('ini_set')) {
            @ini_set('max_file_uploads', '200');
        }

        $dir = public_path('admin/assets/website/photo_gallery');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $files = $request->file('images');
        if (!is_array($files)) {
            $files = $files ? [$files] : [];
        }

        $count = 0;
        foreach ($files as $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }
            $photo = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $photo);
            PhotoGallery::create([
                'image' => $photo, 
            ]);
            $count++;
        }

        $msg = $count === 1 ? '1 photo added successfully.' : $count . ' photos added successfully.';
        return redirect()->route('photogallery.index')->with('message', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = PhotoGallery::where('id', $id)->first();
        return view('admin.photo_gallery.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title = 'Edit Photo Gallery';
        $model = PhotoGallery::where('id', $id)->first();
        return view('admin.photo_gallery.edit', compact('model', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'status' => 'required|in:0,1',
        ];
        if ($request->hasFile('image')) {
            $rules['image'] = 'mimes:jpeg,webp,png,jpg,gif,svg,tif,tiff';
        }
        $request->validate($rules);

        $model = PhotoGallery::where('id', $id)->first();
        if (!$model) {
            return redirect()->route('photogallery.index')->with('status', 'Photo not found.');
        }

        $model->status = $request->status;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $dir = public_path('admin/assets/website/photo_gallery');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $photo = date('YmdHis') . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dir, $photo);
            $model->image = $photo;
        }

        $model->save();
        return redirect()->route('photogallery.index')->with('message', 'Photo Gallery updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = PhotoGallery::where('id', $id)->first();
        if($model){
            if(file_exists(public_path('/admin/assets/website/photo_gallery/' . $model->image))){
                unlink(public_path('/admin/assets/website/photo_gallery/' . $model->image));
            }
            $model->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
