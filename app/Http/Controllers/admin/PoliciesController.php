<?php

namespace App\Http\Controllers\admin;

use App\Models\Policies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        $this->middleware('permission:policy-list|policy-create|policy-edit|policy-delete', ['only' => ['index','store']]);
        $this->middleware('permission:policy-create', ['only' => ['create','store']]);
        $this->middleware('permission:policy-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:policy-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Policies::orderby('id', 'asc')->where('id', '>', 0);
            if($request['search'] != ""){
                $query->where('title', 'like', '%'. $request['search'] .'%');
            }
            if($request['status']!="All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $models = $query->paginate(10);
            return (string) view('admin.policies.search', compact('models'));
        }
        $page_title = 'All Policies';
        $models = Policies::orderby('id', 'asc')->paginate(10);
        return view('admin.policies.index', compact("models","page_title"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Add Policies';
        return view('admin.policies.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:1000',
        ]);

        $model = new Policies();
        $model->created_by = Auth::user()->id;
        $model->title = $request->title;
        $model->description = $request->description;
        $model->save();

        return redirect()->route('policy.index')->with('message', 'Policies Added Successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Policies $policies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title = 'Edit Policies';
        $model = Policies::where('id', $id)->first();
        return view('admin.policies.edit', compact('model','page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validator = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:1000',
        ]);

        $update = Policies::where('id', $id)->first();
        $update->title = $request->title;
        $update->description = $request->description;
        $update->status = $request->status;
        $update->update();

        return redirect()->route('policy.index')->with('message', 'Policies Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Policies::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
