<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog_Categories;
use Illuminate\Http\Request;
use Auth;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:blogcategory-list|blogcategory-create|blogcategory-edit|blogcategory-delete', ['only' => ['index','store']]);
        $this->middleware('permission:blogcategory-create', ['only' => ['create','store']]);
        $this->middleware('permission:blogcategory-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:blogcategory-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Blog_Categories::orderby('id', 'desc')->where('id', '>', 0);
            if($request['search'] != ""){
                $query->where('name', 'like', '%'. $request['search'] .'%');
            }
            if($request['status']!="All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $models = $query->paginate(10);
            return (string) view('admin.blog_category.search', compact('models'));
        }
        $page_title = 'All Blog Categories';
        $models = Blog_Categories::orderby('id', 'desc')->paginate(10);
        return view('admin.blog_category.index', compact("models","page_title"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Blog Category';
        return view('admin.blog_category.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:100',
        ]);

        $model = new Blog_Categories();
        $model->created_by = Auth::user()->id;
        $model->name = $request->name;
        $model->save();

        return redirect()->route('blogcategory.index')->with('message', 'Blog Category Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Blog_Categories $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Blog Category';
        $model = Blog_Categories::where('id', $id)->first();
        return view('admin.blog_category.edit', compact("model", "page_title"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => 'required|max:100',
        ]);

        $model = Blog_Categories::where('id', $id)->first();
        $model->name = $request->name; 
        $model->status = $request->status;
        $model->update();

        return redirect()->route('blogcategory.index')->with('message', 'Blog Category Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Blog_Categories::where('id', $id)->first();
        if ($model) {
            $model->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }
}
