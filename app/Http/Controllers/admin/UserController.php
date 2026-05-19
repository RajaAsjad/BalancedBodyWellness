<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Payment;
use App\Models\Role as UserRole;
use Spatie\Permission\Models\Role;
use DB;
use Auth;
use Hash;
use Illuminate\Support\Arr;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = User::orderby('id', 'asc')->where('id', '>', 0);
            if($request['search'] != ""){
                $query->where('name', 'like', '%'. $request['search'] .'%')
                    ->orWhere('last_name', 'like', '%'. $request['search'].'%')
                    ->orWhere('phone', 'like', '%'. $request['search'].'%')
                    ->orWhere('email', 'like', '%'. $request['search'].'%');
            }
            if($request['status']!="All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $users = $query->paginate(10);
            return (string) view('admin.user.search', compact('users'));
        }
        $page_title = 'All Users';
        $users = User::orderBy('id','asc')->paginate(10);
        return view('admin.user.index', compact('users','page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Add User';
        $roles = Role::orderby('id', 'asc')->get(['name', 'id']);
        return view('admin.user.create',compact('roles','page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')->with('message','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit User';
        $user = User::with('roles')->find($id);
        $roles = Role::orderby('id', 'desc')->get(['name', 'id']);
        $userRole = $user->roles->pluck('name','name')->all();
        $user =  User::where('id', $id)->first();
        return view('admin.user.edit',compact('user','roles','userRole', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if($id){
            $this->validate($request, [
                'status' => 'required',
                'top_rated' => 'required',

            ]);

            $user->status = $request->status;
            $user->top_rated = $request->top_rated;
            $user->update();
        }
        else{
           $this->validate($request, [
                'name' => 'required|max:200',
                'email' => 'required|max:200|email|unique:users,email,'.$id,
                'password' => 'same:confirm-password',
                'roles' => 'required'
            ]);

            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = Arr::except($input,array('password'));
            }

            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();

            $user->assignRole($request->input('roles'));
        }

        return redirect()->route('user.index')->with('message','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ifdeleted = User::find($id)->delete();
        if($ifdeleted){
            return true;
        }
    }

    public function userEditProfile()
    {   $cities = City::where('status', 1)->get();
        $states = State::where('city_id')->get();
        $user =  User::where('id', Auth::user()->id)->first();
        return view('website.user-dashboard.edit', compact('cities', 'states','user'));
    }

    public function userUpdateProfile(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->designation = $request->designation;
        $user->about_me = $request->about_me;
        $user->whatsapp = $request->whatsapp;
        $user->skype = $request->skype;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->behance = $request->behance;
        $user->youtube = $request->youtube;
        $user->city_id = $request->city_id;
        $user->state_id = $request->state_id;
        $user->zip_code = $request->zip_code;
        $user->license = $request->license;
        if(isset($request->image)){
            $photo= date('YmdHis').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/admin/assets/images/UserImage') , $photo);
            $user->image = $photo;
        }

        if(empty($request->name)){
            $this->validate($request, [
                'first_name' => 'required',
                'city_id' => 'required',
                'state_id' => 'required',
            ]);
        }

        if(isset($request->password)){
            $this->validate($request, [
                'first_name' => 'required',
                'password' => 'required|same:confirm-password',
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->update();
        return redirect()->back()->with('message','Profile updated successfully');
    }

    public function authenticate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!empty($user) && $user->hasRole($request->user_type)){
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user_id = Auth::user()->id;
                $isuser_paid = Payment::where('customer_id',$user_id)->where('payment_status','succeeded')->first();
                if(empty($isuser_paid)){
                    return redirect()->route('stripe');
                }else{
                    return redirect()->route('dashboard');
                }
            }
            return redirect()->back()->with('error', 'Failed to login try again.!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
    public function logOut()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
