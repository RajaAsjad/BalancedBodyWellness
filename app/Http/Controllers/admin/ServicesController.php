<?php

namespace App\Http\Controllers\admin;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index','store']]);
        $this->middleware('permission:service-create', ['only' => ['create','store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Services::orderby('id', 'asc')->where('id', '>', 0);
            if($request['search'] != ""){
                $query->where('heading', 'like', '%'. $request['search'] .'%');
            }
            if($request['status']!="All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $models = $query->paginate(10);
            return (string) view('admin.services.search', compact('models'));
        }
        $page_title = 'All Services';
        $models = Services::orderby('id', 'asc')->paginate(10);
        return view('admin.services.index', compact("models","page_title"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Add Services';
        return view('admin.services.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|max:255',
            'description' => 'required|max:5000',
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
        $model->save();

        return redirect()->route('service.index')->with('message', 'Services Added Successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $page_title = 'Show Services';
        $model = Services::where('id', $id)->first();
        return view('admin.services.show', compact('model','page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title = 'Edit Services';
        $model = Services::where('id', $id)->first();
        return view('admin.services.edit', compact('model','page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'heading' => 'required|max:255',
            'description' => 'required|max:5000',
            'questions' => 'required|array|min:1',
            'questions.*' => 'required|string|max:500',
            'benefits' => 'required|array|min:1',
            'benefits.*' => 'required|string|max:2000',
            'status' => 'nullable|in:0,1',
        ]);

        $update = Services::where('id', $id)->first();
        $update->heading = $request->heading;
        $update->questions = $this->normalizeList($request->input('questions', []));
        $update->description = $request->description;
        $update->benefits = $this->normalizeList($request->input('benefits', []));
        $update->status = $request->status ?? $update->status;
        $update->update();

        return redirect()->route('service.index')->with('message', 'Services Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Services::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
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
}
