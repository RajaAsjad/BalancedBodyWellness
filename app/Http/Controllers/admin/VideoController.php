<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Services\VideoThumbnailResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     function __construct()
     {
         $this->middleware('permission:video-list|video-create|video-edit|video-delete', ['only' => ['index','store']]);
         $this->middleware('permission:video-create', ['only' => ['create','store']]);
         $this->middleware('permission:video-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:video-delete', ['only' => ['destroy']]);
     }
     public function index(Request $request)
     {
         if($request->ajax()){
             $query=Video::orderby('id' , 'asc')->where('id' ,'>' , 0);
             if($request['search'] != ""){
                 $query->where('title', 'like', '%'. $request['search'] .'%')
                       ->orWhere('heading', 'like', '%'. $request['search'] .'%');
             }
             if($request['status'] != "All"){
                 if($request['status']==2){
                     $request['status'] = 0;
                 }
                 $query->where('status' ,$request['status']);
             }
             $models=$query->paginate(10);
             return (string) view('admin.videos.search' , compact('models'));
         }
 
         // Handle status filtering from dashboard
         $status_filter = $request->get('status');
         $query = Video::orderby('id', 'asc')->where('id', '>', 0);

         $totalVideos = Video::count();
         $activeVideos = Video::where('status', 1)->count();
         $inactiveVideos = Video::where('status', 0)->count();
         
         if ($status_filter === 'active') {
             $query->where('status', 1);
            $page_title = 'Published Videos';
        } elseif ($status_filter === 'inactive') {
            $query->where('status', 0);
            $page_title = 'Draft Videos';
         } else {
             $page_title = 'All Videos';
         }
         
         $models = $query->paginate(10);
         return view('admin.videos.index' , compact('models', 'page_title', 'totalVideos', 'activeVideos', 'inactiveVideos'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Create Video';
        return view('admin.videos.create' , compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validator = $request->validate([
            'title' => 'required |max:100 ',
            'heading' => 'required |max:100 ',
            'video_url' => 'required |max:255',
        ]);

        $model = new Video();
        $model->heading = $request->heading;
        $model->title = $request->title;
        $model->video_url = $request->video_url;
        $model->thumbnail_url = app(VideoThumbnailResolver::class)->resolve($request->video_url);
        $model->featured = in_array((string) $request->input('featured'), ['0', '1'], true) ? $request->input('featured') : '0';
        $model->save();

        return redirect()->route('video.index')->with('message', 'Video Added Successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title = 'Edit Video';
        $model = Video::where('id', $id)->first();
        return view('admin.videos.edit' , compact('model', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'title' => 'required |max:100 ',
            'heading' => 'required |max:100 ',
            'video_url' => 'required |max:255',
        ]);

        $model = Video::where('id', $id)->first();
        $previousUrl = (string) $model->video_url;
        $model->heading = $request->heading;
        $model->title = $request->title;
        $model->video_url = $request->video_url;
        $model->thumbnail_url = app(VideoThumbnailResolver::class)->resolve($request->video_url);
        $model->featured = in_array((string) $request->input('featured'), ['0', '1'], true) ? $request->input('featured') : '0';
        $model->status = in_array((string) $request->input('status'), ['0', '1'], true) ? $request->input('status') : '0';
        $model->save();

        Cache::forget('video_thumb_display_'.md5($previousUrl));
        Cache::forget('video_thumb_display_'.md5((string) $request->video_url));

        return redirect()->route('video.index')->with('message', 'Video Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model=Video::where('id' , $id)->first();
        if($model){
            $model->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
