<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\WebLink; 
use App\Models\Brand;
use Illuminate\Http\Request;
use PDF;
class WebLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
    {
        $this->middleware('permission:weblinks-list|weblinks-create|weblinks-edit|weblinks-delete', ['only' => ['index','store']]);
        $this->middleware('permission:weblinks-create', ['only' => ['create','store']]);
        $this->middleware('permission:weblinks-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:weblinks-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $query=WebLink::orderby('id' , 'desc')->where('id' ,'>' , 0);
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
            return (string) view('admin.weblinks.search' , compact('models'));
        }

        // Handle status filtering from dashboard
        $status_filter = $request->get('status');
        $query = WebLink::orderby('id', 'desc')->where('id', '>', 0);
        
        if ($status_filter === 'active') {
            $query->where('status', 1);
            $page_title = 'Active Web Links';
        } elseif ($status_filter === 'inactive') {
            $query->where('status', 0);
            $page_title = 'Inactive Web Links';
        } else {
            $page_title = 'All Web Links';
        }
        
        $models = $query->paginate(10);
        return view('admin.weblinks.index' , compact('models', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add Web Link'; 
        //fetch the brands active 
        $brands = Brand::where('status' , 1)->get();
        return view('admin.weblinks.create', compact('page_title' ,'brands'));
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
            'brand_name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg', // Validate image type and size
        ]);

        // Check if a web link with the same name already exists
        $existingWebLink = WebLink::where('name', $request->name)->first();

        if ($existingWebLink) {
            // If it exists, return with an error message
            return redirect()->back()->withErrors(['message' => 'This Web Link name already exists.'])->withInput();
        }

        // Create a new project record
        $model = new WebLink();

        // Handle the image upload if an image is provided
        if (isset($request->image)) {
            $photo = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/weblinks'), $photo);
            $model->image = $photo;
        }

        // Fill in the remaining fields
        $model->name = $request->name;
        $model->brand_name = $request->brand_name;
        $model->slug = \Str::slug($request->name);
        $model->description = $request->description;
        
        // Save the new entry
        $model->save();

        // Redirect with a success message
        return redirect()->route('weblinks.index')->with('message', 'Web Link Added Successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebLink  $webLink
     * @return \Illuminate\Http\Response
     */
    public function show($brandSlug, $weblinkSlug)
    {
        $page_title = 'UI Design';

        // Fetch the brand using the brandSlug
        $brand = Brand::where('slug', $brandSlug)->firstOrFail();

        // Fetch the WebLink using the weblinkSlug and ensure it belongs to the correct brand
        $weblinks = WebLink::where('slug', $weblinkSlug)
                            ->where('brand_name', $brand->name)  // Ensure WebLink belongs to this Brand
                            ->firstOrFail();

        // Pass the WebLink and Brand data to the view
        return view('show', compact('page_title', 'weblinks', 'brand'));
    }



    public function edit($slug)
    {
        $page_title = "Edit Web Link";
        $brands = Brand::where('status' , 1)->get();
        $model = WebLink::where('slug', $slug)->first();
        return view('admin.weblinks.edit', compact('page_title', 'model', 'brands'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebLink  $webLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // Validate request
        $validator = $request->validate([
            'name' => 'required|max:100',
            'brand_name' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        
        // Find WebLink by slug
        $update = WebLink::where('slug', $slug)->first();
        if (!$update) {
            return redirect()->back()->with('error', 'Web Link not found');
        }

        // Check if a web link with the same name exists but excluding the current record
        $existingWebLink = WebLink::where('name', $request->name)
                                ->where('slug', '!=', $slug) // Exclude current record from duplicate check
                                ->first();

        if ($existingWebLink) {
            // If it exists, return with an error message
            return redirect()->back()->withErrors(['message' => 'This Web Link name already exists.'])->withInput();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($update->image && file_exists(public_path('admin/assets/images/weblinks/' . $update->image))) {
                unlink(public_path('admin/assets/images/weblinks/' . $update->image));
            }

            // Upload new image
            $photo = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/weblinks'), $photo);
            $update->image = $photo;
        }

        // Update data
        $update->name = $request->name;
        $update->brand_name = $request->brand_name;
        $update->slug = \Str::slug($request->name);
        $update->description = $request->description;
        $update->status = $request->status;
        $update->save();

        return redirect()->route('weblinks.index')->with('message', 'Web Link Updated Successfully!');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebLink  $webLink
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $weblink=WebLink::where('slug' , $slug)->first();
        if($weblink){
            $weblink->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}
