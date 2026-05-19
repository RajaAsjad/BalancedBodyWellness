<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\WebLink; 
use App\Models\Brand;
use Illuminate\Http\Request;
use PDF;



class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:brands-list|brands-create|brands-edit|brands-delete', ['only' => ['index','store']]);
        $this->middleware('permission:brands-create', ['only' => ['create','store']]);
        $this->middleware('permission:brands-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brands-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query=Brand::orderby('id' , 'desc')->where('id' ,'>' , 0);
            if($request['search'] != ""){
                $query->where('name', 'like', '%'. $request['search'] .'%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status' ,$request['status']);
            }
            $models=$query->paginate(10);
            return (string) view('admin.brands.search' , compact('models'));
        }

        // Handle status filtering from dashboard
        $status_filter = $request->get('status');
        $query = Brand::orderby('id', 'desc')->where('id', '>', 0);
        
        if ($status_filter === 'active') {
            $query->where('status', 1);
            $page_title = 'Active Brands';
        } elseif ($status_filter === 'inactive') {
            $query->where('status', 0);
            $page_title = 'Inactive Brands';
        } else {
            $page_title = 'All Brands';
        }
        
        $models = $query->paginate(10);
        return view('admin.brands.index' , compact('models', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Brand'; 
        return View('admin.brands.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg', // Validate image type and size
        ]);

        // Check if a brand with the same name already exists
        $existingBrand = Brand::where('name', $request->name)->first();

        if ($existingBrand) {
            // If it exists, return with an error message
            return redirect()->back()->withErrors(['message' => 'This Brand name already exists.'])->withInput();
        }

        // Create a new brand record
        $model = new Brand();

        // Handle the image upload if an image is provided
        if (isset($request->image)) {
            $photo = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/brands'), $photo);
            $model->image = $photo;
        }

        // Fill the rest of the fields
        $model->name = $request->name;
        $model->url = $request->url;
        $model->slug = \Str::slug($request->name);
        $model->email = $request->email;

        // Save the new brand
        $model->save();

        // Redirect with a success message
        return redirect()->route('brands.index')->with('message', 'Brand Added Successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $page_title = "Edit Brand";
        $model = Brand::where('slug', $slug)->first();
        return view('admin.brands.edit', compact('page_title', 'model',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // Validate request
        $validator = $request->validate([
            'name' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif,svg',
        ]);
        
        // Find Brand by slug
        $update = Brand::where('slug', $slug)->first();
        if (!$update) {
            return redirect()->back()->with('error', 'Brand not found');
        }
    
        // Check if a brand with the same name exists but exclude the current brand
        $existingBrand = Brand::where('name', $request->name)
                              ->where('slug', '!=', $slug) // Exclude current brand by slug
                              ->first();
    
        if ($existingBrand) {
            // If a brand with the same name exists, return with an error message
            return redirect()->back()->withErrors(['message' => 'This Brand name already exists.'])->withInput();
        }
    
        // Handle image upload if an image is provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($update->image && file_exists(public_path('admin/assets/images/brands/' . $update->image))) {
                unlink(public_path('admin/assets/images/brands/' . $update->image));
            }
    
            // Upload new image
            $photo = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/brands'), $photo);
            $update->image = $photo;
        }
    
        // Update data
        $update->name = $request->name;
        $update->url = $request->url;
        $update->slug = \Str::slug($request->name);
        $update->email = $request->email;
        $update->status = $request->status;
        $update->save();
    
        return redirect()->route('brands.index')->with('message', 'Brand Updated Successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $brand=Brand::where('slug' , $slug)->first();
        if($brand){
            $brand->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
