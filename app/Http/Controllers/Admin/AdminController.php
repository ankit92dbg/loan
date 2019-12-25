<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\OtherContact;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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
        $totalusers = User::orderBy('id','desc')->get();
        $pending = User::where('loan_status',0)->get();
        $approved = User::where('loan_status',1)->get();
        $rejected = User::where('loan_status',2)->get();
        $totalUsers = $totalusers->count();
        $pendingUsers = $pending->count();
        $approvedUsers = $approved->count();
        $rejectedUsers = $rejected->count();
        return view('admin.admin-dashboard')->with(array('total_user'=>$totalUsers,'pending_loan'=>$pendingUsers,'approved_loan'=>$approvedUsers,'rejected_loan'=>$rejectedUsers));
    }

    public function getInspection(){
        return view('admin.inspection');
    }

    public function getUsers(){
        $users = User::orderBy('id','desc')->get(['id','first_name','last_name','email','phone','father_name','dob','gender','martial_status','aadhar_no','aadhar_front','aadhar_back','pan_no','pan_front','live_image','bank_name','bank_account_no','bank_ifsc','loan_purpose','residential_status','permanent_address','company_name','salary','loan_amount','eligible_amount','payable_amount','loan_duration','interest_rate','processing_fee','gst','loan_status','profile_status','created_at']);
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

    public function getViewUser($id){
        $user = User::findOrFail($id);
        $contact = OtherContact::where('user_id',$id)->get();
        $user->aadhar_front = "http://ec2-3-134-105-96.us-east-2.compute.amazonaws.com/loan/storage/app/".$user->aadhar_front;
        $user->aadhar_back = "http://ec2-3-134-105-96.us-east-2.compute.amazonaws.com/loan/storage/app/".$user->aadhar_back;
        $user->pan_front = "http://ec2-3-134-105-96.us-east-2.compute.amazonaws.com/loan/storage/app/".$user->pan_front;
        $user->live_image = "http://ec2-3-134-105-96.us-east-2.compute.amazonaws.com/loan/storage/app/".$user->live_image;
        return view('admin.view-user')->with(array('user' => $user,'other_contact' => $contact));
    }

    public function postUpdateUser(Request $request, $id){
        // dd($request);
        $request->validate([
            'loan_status' => 'in:-1,0,1,2',
            'eligible_amount' => 'integer',
        ]);
        $user_obj = User::findOrFail($id);
        if(isset($request->eligible_amount)){
            $user_obj->eligible_amount = $request->eligible_amount;
        }
        if(isset($request->loan_status)){
            $user_obj->loan_status = $request->loan_status;
        }
        $status = $user_obj->save();

        if($status == 1){
            Session::flash('msg', 'Loan Status And Eligible Amount Updated successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/users');
    }
}
