<?php

namespace App\Http\Controllers\admin;

use App\Models\Audio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        $this->middleware('permission:audio-list|audio-create|audio-edit|audio-delete', ['only' => ['index','store']]);
        $this->middleware('permission:audio-create', ['only' => ['create','store']]);
        $this->middleware('permission:audio-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:audio-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Audio::orderby('id', 'desc')->where('id', '>', 0);
            if($request['search'] != ""){
                $query->where('title', 'like', '%'. $request['search'] .'%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $audios = $query->paginate(10);
            return (string) view('admin.audios.search', compact('audios'));
        }
        $page_title = 'All Audios';
        $totalAudios = Audio::count();
        $activeAudios = Audio::where('status', 1)->count();
        $inactiveAudios = Audio::where('status', 0)->count();
        $audios = Audio::orderby('id', 'desc')->paginate(10);
        return view('admin.audios.index', compact('audios', 'page_title', 'totalAudios', 'activeAudios', 'inactiveAudios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Add Audio';
        return view('admin.audios.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'file' => 'required|file|mimes:mp3,wav,ogg,m4a,aac,wma,flac,alac,opus',
        ]);

        $model = new Audio();
        $model->title = $request->title;
        if(isset($request->file)){
            $file = date('YmdHis') . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file->move(public_path('/admin/assets/website/audio'), $file);
            $model->file = $file;
        }
        $model->save();
        return redirect()->route('audio.index')->with('message', 'Audio Added Successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Audio $audio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title = 'Edit Audio';
        $model = Audio::where('id', $id)->first();
        return view('admin.audios.edit', compact('model', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|max:100',
            'status' => 'required|in:0,1',
        ];
        if ($request->hasFile('file')) {
            $rules['file'] = 'file|mimes:mp3,wav,ogg,m4a,aac,wma,flac,alac,opus';
        }
        $request->validate($rules);

        $model = Audio::where('id', $id)->first();
        $model->title = $request->title;
        if(isset($request->file)){
            $file = date('YmdHis') . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file->move(public_path('/admin/assets/website/audio'), $file);
            $model->file = $file;
        }
        $model->status = $request->status;
        $model->save();
        return redirect()->route('audio.index')->with('message', 'Audio Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Audio::where('id', $id)->first();
        if($model){
            $model->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
