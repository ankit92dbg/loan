<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Loan;
use App\Models\OtherContact;
use Illuminate\Support\Facades\Storage;



class ApiController extends Controller
{
    // User's registration
    public function registerUser(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'max:20'],
            'last_name' => ['required', 'max:20'],
            'email' => 'required|max:50|unique:users',
            //'password' => ['required', 'max:50'],
            // 'phone' => 'required|digits_between:10,12',
            'phone' => 'required',
            'device_id' => ['required', 'max:500'],
            'father_name' => ['required', 'max:20'],
            'dob' => ['required', 'max:20'],
            'gender' => 'required',
            'martial_status' => 'required',
            'aadhar_no' => ['required', 'max:13'],
            'aadhar_front' => 'required',
            'aadhar_back' => 'required',
            'pan_no' => ['required', 'max:20'],
            'pan_front' => 'required',
            'live_image' => 'required',
            'bank_name' => ['required', 'max:20'],
            'bank_account_no' => ['required'],
            'bank_ifsc' => ['required', 'max:15'],
            'loan_purpose' => 'required',
            'residential_status' => 'required',
            'permanent_address' => ['required', 'max:255'],
            'company_name' => ['required', 'max:20'],
            'salary' => ['required'],
            'family_type_one' => ['required'],
            'name_one' => ['required'],
            'phone_number_one' => ['required'],
            'family_type_two' => ['required'],
            'name_two' => ['required'],
            'phone_number_two' => ['required']
            //'requested_amount' => ['required', 'integer', 'digits_between:1,9'],
            // 'other_contact' => ['required']
        ]);
        if ($validator->fails()) {
            $response = array('status' => '400','error' => "true",'message' => 'Parameter validation error - '.$validator->errors()->first());
            return $response;
        }else{
            $user = new User();
            $loan = new Loan();
            //transaction begin
            \DB::beginTransaction();
            try {
                #save user
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                //$user->password = $request->password;
                $user->phone = $request->phone;
                $user->device_id = $request->device_id;
                $user->father_name = $request->father_name;
                $user->dob = $request->dob;
                $user->gender = $request->gender;
                $user->martial_status = $request->martial_status;
                $user->aadhar_no = $request->aadhar_no;
                $file_aadhar_front_original_name = $request->aadhar_front->getClientOriginalName();
                $user->aadhar_front = Storage::disk('local')->putFileAs('Aadhar', $request->aadhar_front, $file_aadhar_front_original_name);
                // $user->aadhar_front = $this->converImage($request->aadhar_front,'Aadhar');
                //$user->aadhar_front = $request->aadhar_front;
               // $user->aadhar_back = $request->aadhar_back;
                $file_aadhar_back_original_name = $request->aadhar_back->getClientOriginalName();
                $user->aadhar_back = Storage::disk('local')->putFileAs('Aadhar', $request->aadhar_back, $file_aadhar_back_original_name);
                // $user->aadhar_back = $this->converImage($request->aadhar_back,'Aadhar');

                $user->pan_no = $request->pan_no;
                // $user->pan_front = $request->pan_front;
                $file_pan_front_original_name = $request->pan_front->getClientOriginalName();
                $user->pan_front = Storage::disk('local')->putFileAs('Pan', $request->pan_front, $file_pan_front_original_name);
                // $user->pan_front = $this->converImage($request->pan_front,'Pan');

                $file_live_image_original_name = $request->live_image->getClientOriginalName();
                $user->live_image = Storage::disk('local')->putFileAs('Live_image', $request->live_image, $file_live_image_original_name);
                // $user->live_image = $this->converImage($request->live_image,'Live_image');

                $user->bank_name = $request->bank_name;
                $user->bank_account_no = $request->bank_account_no;
                $user->bank_ifsc = $request->bank_ifsc;
                $user->permanent_address = $request->permanent_address;
                $user->company_name = $request->company_name;
                $user->salary = $request->salary;
                $user->profile_status = 1;
                $user->save();

                #get userId
                $user_id = $user->id;
                //save requested amount
                $loan->user_id = $user_id;
                //$loan->requested_amount = $request->requested_amount;
                $loan->loan_purpose = $request->loan_purpose;
                $loan->loan_duration = (string)18;//in days
                $loan->loan_status = -1;
                $loan->save();


                //save other contact
                
                $other_contact_one = new OtherContact();
                $other_contact_one->user_id = $user_id;
                $other_contact_one->family_type = $request->family_type_one;
                $other_contact_one->name = $request->name_one;
                $other_contact_one->phone_number = $request->phone_number_one;
                //$other_contact->type = $other_contacts->type;
                $other_contact_one->save();

                $other_contact_two = new OtherContact();
                $other_contact_two->user_id = $user_id;
                $other_contact_two->family_type = $request->family_type_two;
                $other_contact_two->name = $request->name_two;
                $other_contact_two->phone_number = $request->phone_number_two;
                //$other_contact->type = $other_contacts->type;
                $other_contact_two->save();
             
                
                \DB::commit();
                $user->loan = Loan::findorfail($loan->id);
                $user->other_contact = OtherContact::where('user_id',$user_id)->get();
                return $user;
                
            } catch (Exception $e) {
                \DB::rollback();
                // something went wrong
                throw $e;
            }

            $response = array('status' => '200','error' => "false",'message' => 'Success','payload' => $validResponse);
            
            return $response;
        }
    }

    //conver base_64 image
    public function converImage($image,$folder){
        $base64_image = $image; // your base64 encoded     
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data); 
        $imageName = $folder.'/img_'.time().'.'.'png';   
        Storage::disk('local')->put($imageName, base64_decode($file_data));
        return $imageName;
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

    //get user by id
    public function getUser(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails()) {
            $response = array('status' => '400','error' => "true",'message' => 'Parameter validation error - '.$validator->errors()->first());
            return $response;
        }else{
            $user = User::findorfail($request->user_id);
            $user['loan'] = Loan::where('user_id',$request->user_id)->get();
            $user['other_contact'] = OtherContact::where('user_id',$request->user_id)->get();
            return $user;
        }   
    }
    
    //find interest amount
    public function loanAmount(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'required|exists:loan,id',
            'loan_amount' => 'required|integer'
        ]);
        if ($validator->fails()) {
            $response = array('status' => '400','error' => "true",'message' => 'Parameter validation error - '.$validator->errors()->first());
            return $response;
        }else{
            $checkMaxLoan = Loan::findorfail($request->loan_id);
            $maxLoan = $checkMaxLoan->eligible_amount;
            if($request->loan_amount > $maxLoan){
                $response = array('status' => '400','error' => "true",'message' => 'Parameter validation error - You are not eligible for this loan amount');
                return $response;
            }
            if($checkMaxLoan->loan_status == 1){
                $response = array('status' => '400','error' => "true",'message' => 'Your loan is already approved');
                return $response;
            }
            if($checkMaxLoan->loan_status == 2){
                $response = array('status' => '400','error' => "true",'message' => 'Your loan is rejected');
                return $response;
            }

            \DB::beginTransaction();
            try {
                #save user
                $loan = Loan::findorfail($request->loan_id);
                $loan->loan_amount = $request->loan_amount;
                $interest = $this->findInterest($loan->loan_amount);
                $loan->payable_amount = (string)$interest['payable_amount'];
                $loan->interest_rate = (string)$interest['interest_rate'];
                $loan->processing_fee = (string)$interest['processing_fee'];
                $loan->gst = (string)$interest['gst'];
                $loan->loan_status = 0;
                $loan->save();

        
                
                \DB::commit();
                return $loan;
                
            } catch (Exception $e) {
                \DB::rollback();
                // something went wrong
                throw $e;
            }

            $user = User::findorfail($request->user_id);
            $user['loan'] = Loan::findorfail($request->loan_id);
            $user['other_contact'] = OtherContact::where('user_id',$request->user_id)->get();
            return $user;
        }   
    }

    //new loan apply
    public function newLoan(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'loan_purpose' => 'required|in:0,1,2,3',
            'requested_amount' => ['required', 'integer', 'digits_between:1,9']
        ]);
        if ($validator->fails()) {
            $response = array('status' => '400','error' => "true",'message' => 'Parameter validation error - '.$validator->errors()->first());
            return $response;
        }else{
            $loan = new Loan();
            //transaction begin
            \DB::beginTransaction();
            try {

                #get userId
                $user_id = $request->user_id;
                //save requested amount
                $loan->user_id = $user_id;
                $loan->requested_amount = $request->requested_amount;
                $loan->loan_purpose = $request->loan_purpose;
                $loan->loan_duration = (string)18;//in days
                $loan->loan_status = -1;
                $loan->save();
                \DB::commit();
                $user = User::findorfail($user_id);
                $user['loan'] = Loan::findorfail($loan->id);
                $user['other_contact'] = OtherContact::where('user_id',$user_id)->get();
                return $user;
                
            } catch (Exception $e) {
                \DB::rollback();
                // something went wrong
                throw $e;
            }

            $response = array('status' => '200','error' => "false",'message' => 'Success','payload' => $validResponse);
            
            return $response;
        }
    }

}