<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OtherContact;
use Illuminate\Support\Facades\Storage;



class ApiController extends Controller
{
    // User's scheduled inspection using user_id
    public function registerUser(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'max:20'],
            'last_name' => ['required', 'max:20'],
            'email' => 'required|max:50|unique:users',
            'password' => ['required', 'max:50'],
            'phone' => 'required|digits_between:10,11',
            'device_id' => ['required', 'max:500'],
            'father_name' => ['required', 'max:20'],
            'dob' => ['required', 'max:20','date_format:d/m/Y'],
            'gender' => 'required|in:0,1',
            'martial_status' => 'required|in:0,1',
            'aadhar_no' => ['required', 'max:13'],
            'aadhar_front' => ['required', 'max:255','mimes:pdf,jpeg,jpg|max:5120'],
            'aadhar_back' => ['required', 'max:255','mimes:pdf,jpeg,jpg|max:5120'],
            'pan_no' => ['required', 'max:20'],
            'pan_front' => ['required', 'max:255','mimes:pdf,jpeg,jpg|max:5120'],
            'video' => 'required|mimes:mp4|max:20000',
            'bank_name' => ['required', 'max:20'],
            'bank_account_no' => ['required', 'integer','digits_between:6,20'],
            'bank_ifsc' => ['required', 'max:15'],
            'loan_purpose' => 'required|in:0,1,2,3',
            'residential_status' => 'required|in:0,1,2',
            'permanent_address' => ['required', 'max:255'],
            'company_name' => ['required', 'max:20'],
            'salary' => ['required', 'integer','digits_between:1,9'],
            'loan_amount' => ['required', 'integer', 'digits_between:1,9'],
            'other_contact' => ['required']
        ]);
        if ($validator->fails()) {
            $response = array('status' => '400','error' => "true",'message' => 'Parameter validation error - '.$validator->errors()->first());
            return $response;
        }else{
            $user = new User();
            //transaction begin
            \DB::beginTransaction();
            try {
                #save user
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->phone = $request->phone;
                $user->device_id = $request->device_id;
                $user->father_name = $request->father_name;
                $user->dob = $request->dob;
                $user->gender = $request->gender;
                $user->martial_status = $request->martial_status;
                $user->aadhar_no = $request->aadhar_no;
                $file_aadhar_front_original_name = $request->aadhar_front->getClientOriginalName();
                $user->aadhar_front = Storage::disk('local')->putFileAs('Aadhar', $request->aadhar_front, $file_aadhar_front_original_name);
                //$user->aadhar_front = $request->aadhar_front;
               // $user->aadhar_back = $request->aadhar_back;
                $file_aadhar_back_original_name = $request->aadhar_back->getClientOriginalName();
                $user->aadhar_back = Storage::disk('local')->putFileAs('Aadhar', $request->aadhar_back, $file_aadhar_back_original_name);
                $user->pan_no = $request->pan_no;
                // $user->pan_front = $request->pan_front;
                $file_pan_front_original_name = $request->pan_front->getClientOriginalName();
                $user->pan_front = Storage::disk('local')->putFileAs('Pan', $request->pan_front, $file_pan_front_original_name);
                $file_video_original_name = $request->video->getClientOriginalName();
                $user->video = Storage::disk('local')->putFileAs('Video', $request->video, $file_video_original_name);
                $user->bank_name = $request->bank_name;
                $user->bank_account_no = $request->bank_account_no;
                $user->bank_ifsc = $request->bank_ifsc;
                $user->loan_purpose = $request->loan_purpose;
                $user->permanent_address = $request->permanent_address;
                $user->company_name = $request->company_name;
                $user->salary = $request->salary;
                $user->loan_amount = $request->loan_amount;
                $user->profile_status = 1;
                $user->loan_status = 0;
                $user->save();

                #get userId
                $user_id = $user->id;
                if($request->other_contact!=''){
                    $other_contact_field = json_decode($request->other_contact); 
                    foreach($other_contact_field as $other_contacts){
                        $other_contact = new OtherContact();
                        $other_contact->user_id = $user_id;
                        $other_contact->family_type = $other_contacts->family_type;
                        $other_contact->name = $other_contacts->name;
                        $other_contact->phone_number = $other_contacts->phone_number;
                        $other_contact->type = $other_contacts->type;
                        $other_contact->save();
                    }
                }
                
                \DB::commit();
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
    // Inspection Details API using Inspection Id
    public function getInspectionDetails(Request $request){
        $validator = Validator::make($request->all(), [
            "inspection_id" => "required",
        ]);
        if ($validator->fails()) {
            $response = array('status' => '400','error' => "true",'message' => 'Parameter validation error'.$validator->errors()->first());
            return $response;
        }else{
            $inspection_id = $request->inspection_id;
            $validResponse = \DB::table('inspections')
            ->where(['inspections.id' => $inspection_id])
            ->select(\DB::Raw('CAST(inspections.id AS CHAR) as inspection_id,
            IFNULL(inspections.name,"") as inspection_name,IFNULL(inspections.description,"") as inspection_description,
            IFNULL(inspections.identification_number,"") as inspection_identification_number,
            IFNULL(inspections.entity,"") as inspection_entity,IFNULL(inspections.reference,"") as inspection_reference,
            IFNULL(inspections.classification,"") as inspection_classification,IFNULL(inspections.created_at,"") as inspection_created_at'    
            ))
            ->first();
            if(!empty($validResponse)){
                $validResponse->inspection_steps = $this->getInspectionSteps($validResponse->inspection_id);
                $response = array('status' => '200','error' => "false",'message' => 'Success','payload' => $validResponse);
            }else{
            $response = array('status' => '404','error' => "true",'message' => 'Data not found');
            }
            return $response;
        }
    }

    //get inspection steps
    public function getInspectionSteps($inspection_id){
        $stepQuery = \DB::table('inspection_steps')
            ->where(['inspection_steps.inspection_id' => $inspection_id])
            ->select(\DB::Raw('CAST(inspection_steps.id AS CHAR) as inspection_steps_id,
            IFNULL(inspection_steps.sequence,"") as sequence,IFNULL(inspection_steps.type,"") as type,
            IFNULL(inspection_steps.category,"") as category,IFNULL(inspection_steps.sub_category,"") as sub_category,
            IFNULL(inspection_steps.description,"") as description,IFNULL(inspection_steps.image_document_url,"") as image_document_url,
            IFNULL(inspection_steps.is_numerical,"") as is_numerical,IFNULL(inspection_steps.option,"") as steps_option,
            IFNULL(inspection_steps.photo_option,"") as photo_option,IFNULL(inspection_steps.evidence_option,"") as evidence_option,
            IFNULL(inspection_steps.evidence_type,"") as evidence_type,IFNULL(inspection_steps.created_at,"") as inspection_steps_created_at'    
            ))
            ->get();
        $i=0;    
        foreach($stepQuery as $sq){
            // echo $sq->type;
            $type = $sq->type;
            $evidence_type = $sq->evidence_type;
            if($type=='0'){
                $type = "Options";
            }elseif($type=='1'){
                $type = "DataEntry";
            }elseif($type=='2'){
                $type = "QR";
            }else{
                $type = "";
            }
            if($evidence_type=='0'){
                $evidence_type = "Photo";
            }elseif($evidence_type=='1'){
                $evidence_type = "Video";
            }elseif($evidence_type=='2'){
                $evidence_type = "Text";
            }else{
                $evidence_type = "";
            }
            $stepQuery[$i]->type = $type;
            $stepQuery[$i]->evidence_type = $evidence_type;
            $i++;
        }    
        return $stepQuery;    
    }
   
    // Login API using email and password
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required",
        ]);
        if ($validator->fails()) {
            $response = array('status' => '400','error' => "true",'message' => 'Parameter validation error'.$validator->errors()->first());
            return $response;
        }else{
            $email = $request->email;
            $password = md5($request->password);
            // dd($password);
            $validResponse = \DB::table('users')
            ->where(['users.email' => $email,'users.password' => $password])
            ->select(\DB::Raw('CAST(users.id AS CHAR) as users_id,
            IFNULL(users.first_name,"") as first_name,
            IFNULL(users.last_name,"") as last_name,
            IFNULL(users.email,"") as email,
            IFNULL(users.email_verified_at,"") as email_verified_at,
            IFNULL(users.organization,"") as organization,
            IFNULL(users.location,"") as location,
            IFNULL(users.last_login,"") as last_login,
            IFNULL(users.role_id,"") as role_id,
            IFNULL(users.remember_token,"") as remember_token,
            IFNULL(users.created_at,"") as created_at'    
            ))
            ->first();
            if(!empty($validResponse)){
                $response = array('status' => '200','error' => "false",'message' => 'Success','payload' => $validResponse);
            }else{
                $response = array('status' => '404','error' => "true",'message' => 'Invalid email/password');
            }
            return $response;
        }
    }

    // List all inspection
    public function listAllInspections(Request $request){
        // $inspection_id = $request->inspection_id;
        $validResponse = \DB::table('inspections')
        // ->where(['inspections.id' => $inspection_id])
        ->select(\DB::Raw('CAST(inspections.id AS CHAR) as inspection_id,
        IFNULL(inspections.name,"") as inspection_name,IFNULL(inspections.description,"") as inspection_description,
        IFNULL(inspections.identification_number,"") as inspection_identification_number,
        IFNULL(inspections.entity,"") as inspection_entity,IFNULL(inspections.reference,"") as inspection_reference,
        IFNULL(inspections.classification,"") as inspection_classification,IFNULL(inspections.created_at,"") as inspection_created_at'    
        ))
        ->get();
        if(!empty($validResponse)){
            $i=0;
            foreach($validResponse as $vr){
                $validResponse[$i]->inspection_steps = $this->getInspectionSteps($vr->inspection_id);
                $i++;
            }
            
            $response = array('status' => '200','error' => "false",'message' => 'Success','payload' => $validResponse);
        }else{
            $response = array('status' => '404','error' => "true",'message' => 'Data not found');
        }
        return $response;
        
    }
}