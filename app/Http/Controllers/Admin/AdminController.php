<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\OtherContact;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use App\Services\Services;
use DB;
use Auth;
use phpDocumentor\Reflection\Types\Null_;
use Session;


class AdminController extends Controller
{
    use AuthenticatesUsers;

 

    // protected $guard = 'admin';

    // protected $redirectTo = '/home';

    // public function __construct()
    // {
    //     $this->middleware('admin')->except('admin-logout');
    // }

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

    	$admin = User::where('email', $request->email)
                  ->where('password', md5($request->password))
                  ->first();
        if(!$admin){
            Session::flash('msg', 'Email ID or Password not match.');
            return \Redirect::back()->withInput();
        }else{
            Auth::login($admin, $request->has('remember'));
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
        $totalusers = User::where('is_admin',null)->orderBy('id','desc')->get();
        $pending = Loan::where('loan_status',0)->get();
        $approved = Loan::where('loan_status',1)->get();
        $rejected = Loan::where('loan_status',2)->get();
        $totalUsers = $totalusers->count();
        $pendingUsers = $pending->count();
        $approvedUsers = $approved->count();
        $rejectedUsers = $rejected->count();
        return view('admin.admin-dashboard')->with(array('total_user'=>$totalUsers,'pending_loan'=>$pendingUsers,'approved_loan'=>$approvedUsers,'rejected_loan'=>$rejectedUsers));
    }


    public function getUsers(){
        $users = User::where('is_admin',null)->orderBy('id','desc')->get(['id','first_name','last_name','email','phone','father_name','dob','gender','martial_status','aadhar_no','aadhar_front','aadhar_back','pan_no','pan_front','live_image','bank_name','bank_account_no','bank_ifsc','residential_status','permanent_address','company_name','salary','profile_status','created_at']);
        
        return view('admin.list-user')->with(array('users'=>$users));
    }

    public function getLoan($id){
        $users = User::findorfail($id);  
        $loan = Loan::where('user_id',$id)->get();  
        return view('admin.list-loan')->with(array('users'=>$users,'loan' => $loan));
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

    public function getEditUser($id,$loan_id){
        $user = User::findOrFail($id);
        $loan = Loan::findOrFail($loan_id);
        return view('admin.edit-user')->with(array('user' => $user,'loan' => $loan));
    }

    public function getViewUser($id,$loan_id){
        $user = User::findOrFail($id);
        $loan = Loan::findOrFail($loan_id);
        $contact = OtherContact::where('user_id',$id)->get();
        $user->aadhar_front = "http://ec2-3-134-105-96.us-east-2.compute.amazonaws.com/loan/storage/app/".$user->aadhar_front;
        $user->aadhar_back = "http://ec2-3-134-105-96.us-east-2.compute.amazonaws.com/loan/storage/app/".$user->aadhar_back;
        $user->pan_front = "http://ec2-3-134-105-96.us-east-2.compute.amazonaws.com/loan/storage/app/".$user->pan_front;
        $user->live_image = "http://ec2-3-134-105-96.us-east-2.compute.amazonaws.com/loan/storage/app/".$user->live_image;
        return view('admin.view-user')->with(array('user' => $user,'other_contact' => $contact,'loan' => $loan));
    }

    public function postUpdateUser(Request $request, $id,$loan_id){
        // dd($request);
        $request->validate([
            'loan_status' => 'in:-1,0,1,2',
            'loan_id' => 'integer',
            'eligible_amount' => 'integer',
        ]);
        $loan_obj = Loan::findOrFail($loan_id);
        $requested_amount = $loan_obj->requested_amount;
        if(isset($request->eligible_amount)){
            $loan_obj->eligible_amount = $request->eligible_amount;
            // if($request->eligible_amount >= $requested_amount){
            //     // $loan_obj->loan_amount = $loan_obj->requested_amount;
            //     // $interest = $this->findInterest($loan_obj->requested_amount);
            //     // $loan_obj->payable_amount = (string)$interest['payable_amount'];
            //     // $loan_obj->interest_rate = (string)$interest['interest_rate'];
            //     // $loan_obj->processing_fee = (string)$interest['processing_fee'];
            //     // $loan_obj->gst = (string)$interest['gst'];
            // }
            $loan_obj->loan_status = -3;

        }
        if(isset($request->loan_status)){
            $loan_obj->loan_status = $request->loan_status;
        }
        $status = $loan_obj->save();
        $loan_status = $loan_obj->loan_status;
        $user_id = $loan_obj->user_id;
        $user_obj = User::findOrFail($user_id);
        $device_token = $user_obj->device_id;

        $msgArr = ['Document is under verification','you have reequested for loan','Loan is pending for approval','Your loan is approved','Your loan is rejected','Verification Done'];
                if($loan_status==-2){
                    $msg = $msgArr[0];
                }elseif($loan_status==-3){
                    $msg = $msgArr[5];
                }elseif($loan_status==-1){
                    $msg = $msgArr[1];
                }elseif($loan_status==0){
                    $msg = $msgArr[2];
                }elseif($loan_status==1){
                    $msg = $msgArr[3];
                }elseif($loan_status==2){
                    $msg = $msgArr[4];
                }else{
                    $msg = "N/A";
                }
        $this->sendNotification($device_token,$msg);        
        if($status == 1){
            Session::flash('msg', 'Loan Status And Eligible Amount Updated successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/users');
    }

    //find interest amount
    public function findInterest($loan_amount){
        $gst = (18/100);
        $interest =(1.35/100);
        $processing_fee = 0.158; //for one rupee
        $amount['gst'] = round($gst*$loan_amount,2);
        $amount['interest_rate'] = round($interest*$loan_amount,2);
        $amount['processing_fee'] = round((($processing_fee*$loan_amount)+$processing_fee*$gst*$loan_amount),2)+round($interest*$loan_amount,2);
        $amount['payable_amount'] = round($loan_amount,2)+$amount['processing_fee'];
        return $amount;
    }

    //send push notification
    public function sendNotification($token,$msg){
     define('API_ACCESS_KEY','AIzaSyC2SzR3VVyROkp_EHkuWAY05WDdCmnPPbQ');
     $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
     $notification = [
            'title' =>'Simply Financier',
            'body' => $msg,
            'icon' =>'myIcon', 
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


        echo $result;
    }

    public function getApprovedLoan(){
        $validResponse = \DB::table('loan')
            ->leftjoin('users', 'users.id', '=', 'loan.user_id')
            ->where(['loan.loan_status' => 1])
            ->select(\DB::Raw('CAST(users.id AS CHAR) as user_id,
            users.first_name as first_name,users.last_name as last_name,
            IFNULL(loan.id,"") as loan_id,IFNULL(users.email,"") as email,IFNULL(users.phone,"") as phone,
            IFNULL(loan.created_at,"") as applied_on,IFNULL(loan.eligible_amount,"") as eligible_amount,IFNULL(loan.loan_amount ,"") as loan_amount '    
        ))->orderBy('loan.id','desc')->get();
        return view('admin.application')->with(array('loan' => $validResponse,'msg' => 'Approved Load'));

    }

    public function getPendingLoan(){
        $validResponse = \DB::table('loan')
            ->leftjoin('users', 'users.id', '=', 'loan.user_id')
            ->where(['loan.loan_status' => 0])
            ->select(\DB::Raw('CAST(users.id AS CHAR) as user_id,
            users.first_name as first_name,users.last_name as last_name,
            IFNULL(loan.id,"") as loan_id,IFNULL(users.email,"") as email,IFNULL(users.phone,"") as phone,
            IFNULL(loan.created_at,"") as applied_on,IFNULL(loan.eligible_amount,"") as eligible_amount,IFNULL(loan.loan_amount ,"") as loan_amount '    
        ))->orderBy('loan.id','desc')->get();
        return view('admin.application')->with(array('loan' => $validResponse,'msg' => 'Approved Load'));

    }

    public function getRejectedLoan(){
        $validResponse = \DB::table('loan')
            ->leftjoin('users', 'users.id', '=', 'loan.user_id')
            ->where(['loan.loan_status' => 2])
            ->select(\DB::Raw('CAST(users.id AS CHAR) as user_id,
            users.first_name as first_name,users.last_name as last_name,
            IFNULL(loan.id,"") as loan_id,IFNULL(users.email,"") as email,IFNULL(users.phone,"") as phone,
            IFNULL(loan.created_at,"") as applied_on,IFNULL(loan.eligible_amount,"") as eligible_amount,IFNULL(loan.loan_amount ,"") as loan_amount '    
        ))->orderBy('loan.id','desc')->get();
        return view('admin.application')->with(array('loan' => $validResponse,'msg' => 'Approved Load'));

    }

}
