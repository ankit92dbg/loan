<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
// use App\Services\Services;
use DB;
use Auth;
use Session;


class AdminController extends Controller
{

    public function getAdminLogin(){
    	return view('admin.admin-login');
    }
    public function getAdminLogout(){
        Auth::logout();
        return redirect('/');
    }

    public function postAdminLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

    	$admin = Admin::where('email', $request->email)
                  ->where('password', md5($request->password))
                  ->first();
        if(!$admin){
            Session::flash('msg', 'Email ID or Password not match.');
            return \Redirect::back()->withInput();
        }else{
            Auth::login($admin);
        	return redirect('admin/dashboard');
        };
    }

    public function getAdminRegister(){
        //dd(Auth::user());
    	return view('admin.register');
    }

    public function postAdminRegister(){
    	//admin register code here
        return view('admin.dashboard');
    }

    public function viewAdminDashboard(){
        dd('sss');
        return view('admin.admin-dashboard');
    }

    public function getInspection(){
        return view('admin.inspection');
    }

    public function getUsers(){
        $users = User::where('role_id', '!=', 1)->orderBy('id','desc')->get(['id','first_name','last_name','email','organization','location','role_id']);
        return view('admin.list-user')->with(array('users'=>$users));
    }

    public function postAddUser(Request $request){

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|unique:users',
            'password' => 'required|max:50',
            'role_id' => 'required|integer',
        ]);

        $user_obj = new User;
        $user = $user_obj->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'organization' => $request->organization,
                'location' => $request->location,
                'password' => md5($request->password),
                'role_id' => $request->role_id,
            ]);

        
        if($user){
            Session::flash('msg', 'User saved successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return \Redirect::back();
    }

    public function getPermanentDeleteUser($id){
        $user = User::findOrFail($id);
        $status = $user->delete();
        if($status == 1){
            Session::flash('msg', 'User Deleted successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/users');
    }

    public function getEditUser($id){
        $user = User::findOrFail($id);
        return view('admin.edit-user')->with(array('user' => $user));
    }

    public function postUpdateUser(Request $request, $id){
        $request->validate([
            'first_name' => 'required|max:100',
            'email' => 'required|max:100|unique:users'.$id,
            'password' => 'nullable|max:50',
            'role_id' => 'required|integer',
        ]);

        $user_obj = User::findOrFail($id);
        $user_obj->first_name = $request->first_name;
        $user_obj->last_name = $request->last_name;
        $user_obj->email = $request->email;
        $user_obj->organization = $request->organization;
        $user_obj->location = $request->location;
        if($request->password != ''){
            $user_obj->password = md5($request->password);
        }
        $user_obj->role_id = $request->role_id;
        $status = $user_obj->save();

        if($status == 1){
            Session::flash('msg', 'User Updated successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/users');
    }
}
