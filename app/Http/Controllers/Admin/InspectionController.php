<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inspection;
use App\Models\InspectionStep;
use App\Models\User;
use App\Models\InspectionSchedule;
use Carbon\Carbon;
use App\Services\Services;
use App\Services\ImageServices;
use Session;
use Auth;


class InspectionController extends Controller
{
    
    public function getInspection(){
        $inspections = Inspection::orderBy('id')->get();
        return view('admin.inspection')->with(array('inspections'=>$inspections)); 
    }

    public function postAddInspection(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'identification_number' => 'required',
            'entity' => 'required',
            'classification' => 'required'
        ]);

        $inspections = new Inspection;
        $inspections->name = $request->name;
        $inspections->description = $request->description;
        $inspections->identification_number = $request->identification_number;
        $inspections->entity = $request->entity;
        $inspections->reference = $request->reference;
        $inspections->classification = $request->classification;
        $status = $inspections->save();
        if ($status==1){
            Session::flash('msg', 'Inspection saved successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/inspection');
    }        
    

    public function getEditInspection($id){
        $inspections = Inspection::findOrFail($id);
        return view('admin.edit-inspection')->with(array('inspections' => $inspections));
    }

    public function postUpdateInspection(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'created_by' => 'required',
            'identification_number' => 'required',
            'entity' => 'required',
        ]);
        $inspections = Inspection::findOrFail($id);
        $inspections->name = $request->name;
        $inspections->description = $request->description;
        $inspections->created_by = $request->created_by;
        $inspections->identification_number = $request->identification_number;
        $inspections->entity = $request->entity;
        $status = $inspections->save();
        if($status == 1){
            Session::flash('msg', 'Inspection Updated successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/inspection');
    }

    public function getPermanentDeleteInspection($id){
        $inspections = Inspection::findOrFail($id);
        $status = $inspections->delete();
        if($status == 1){
            Session::flash('msg', 'Inspection Deleted successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/inspection');
    }
    
    public function getInspectionSteps($id){
        $inspection_steps = InspectionStep::where('inspection_id',$id)->orderBy('id')->get();
        return view('admin.steps-list')->with(array('inspection_steps'=>$inspection_steps,'inspection_id'=>$id)); 
    }

    public function postAddInspectionSteps(Request $request,$id){
        $request->validate([
            'type' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'description' => 'required',
            /*'is_numerical' => 'required',
            'option' => 'required',
            'photo_option' => 'required',
            'evidence_option' => 'required',
            'evidence_type' => 'required'*/
            
        ]);
        $image = $request->file('image_document_url');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('Inspection-images'), $new_name);

        $inspection_steps = new InspectionStep;
        $inspection_steps->type = $request->type;
        $inspection_steps->inspection_id = $id;
        $inspection_steps->category = $request->category;
        $inspection_steps->sub_category = $request->sub_category;
        $inspection_steps->description = $request->description;
        $inspection_steps->is_numerical = $request->is_numerical;
        $inspection_steps->option = $request->option;
        /*$inspection_steps->photo_option = $request->photo_option;*/
        $inspection_steps->evidence_option = $request->evidence_option;
        $inspection_steps->evidence_type = $request->evidence_type;
        $inspection_steps->image_document_url = $new_name;
        $inspection_steps->sequence = 1;
        $status = $inspection_steps->save();

        /*$imageName = time().'.'.request()->image_document_url->getClientOriginalExtension();
        request()->image_document_url->move(public_path('images'), $imageName);*/
        /*$inspection_steps->image_document_url = $request->file('image_document_url')->storeAs(
                'public/ima/', $inspection_steps->slug);
        $inspection_steps->save();*/

        if ($status==1){
            Session::flash('msg', 'Inspection Step saved successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/inspection/step/steps-list/'.$id);
    } 

    public function getEditInspectionSteps($i_id,$s_id){
        $inspection_steps = InspectionStep::findOrFail($s_id);
        return view('admin.edit-steps')->with(array('inspection_steps' => $inspection_steps));
    }

    public function postUpdateInspectionSteps(Request $request, $i_id, $s_id){
        /*$image_name = $request->hidden_image;
        $image = $request->file('image_document_url');
        if($image != '')*/
            
        $request->validate([
            'type' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'description' => 'required',
            /*'is_numerical' => 'required',
            'option' => 'required',
            'photo_option' => 'required',
            'evidence_option' => 'required',
            'evidence_type' => 'required'*/
            
        ]);
        /*$image_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);*/

        $inspection_steps = InspectionStep::findOrFail($s_id);
        $inspection_steps->type = $request->type;
        $inspection_steps->inspection_id = $i_id;
        $inspection_steps->category = $request->category;
        $inspection_steps->sub_category = $request->sub_category;
        $inspection_steps->description = $request->description;
        $inspection_steps->is_numerical = $request->is_numerical;
        /*dd($inspection_steps->is_numerical);*/
        $inspection_steps->option = $request->option;
        $inspection_steps->photo_option = $request->photo_option;
        $inspection_steps->evidence_option = $request->evidence_option;
        $inspection_steps->evidence_type = $request->evidence_type;
        /*$inspection_steps->image_document_url = $image_name;*/
        $inspection_steps->sequence = 1;
        $status = $inspection_steps->save();
        if($status == 1){
            Session::flash('msg', 'Inspection Steps Updated successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/inspection/step/steps-list/'.$i_id);
    }

    public function getPermanentDeleteInspectionStep($id){
        $inspection_steps = InspectionStep::findOrFail($id);
        $status = $inspection_steps->delete();
        if($status == 1){
            Session::flash('msg', 'Inspection Deleted successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return \Redirect::back();
    }   

    public function getInspectionSchedule($id){
        $inspection_schedules = InspectionSchedule::with(['inspection','user'])->where('inspection_id',$id)->get();
        /*echo "<pre>";print_r($inspection_schedules);die;*/
        return view('admin.inspection-schedule')->with(array('inspection_schedules'=>$inspection_schedules,'inspection_id' =>$id)); 
    }

    public function postAddInspectionSchedule(Request $request, $id){

        //dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'inspection_date' => 'required|date_format:m/d/Y',
            /*'status' => 'required|numeric' */
        ]);
        $inspection_schedules = new InspectionSchedule;
        $inspection_schedules->user_id = $request->user_id;
        $inspection_schedules->inspection_id = $id;
        $inspection_schedules->inspection_date = Carbon::createFromFormat('m/d/Y', $request->inspection_date)->format('Y-m-d');
        /*$inspection_schedules->status = 0;*/
        $status = $inspection_schedules->save();
        if ($status==1){
            Session::flash('msg', 'Inspection Schedule saved successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/inspection/inspection-schedule/'.$id);
    }

    public function getAddInspectionSchedule(){
        $users = User::where('role_id',2)->orderBy('id')->get();
        return view('admin.add-inspection-schedule')->with(array('users'=>$users)); 
    }

    public function getEditInspectionSchedule($id){
        $users = User::where('role_id',2)->orderBy('id')->get();
        $inspection_schedules = InspectionSchedule::findOrFail($id);
        return view('admin.edit-inspection-schedule')->with(array('inspection_schedules' => $inspection_schedules, 'users'=>$users));
    }

    public function postUpdateInspectionSchedule(Request $request, $id){
        /*dd($request);*/
        $request->validate([
           'user_id' => 'required',
           'inspection_date' => 'required|date_format:m/d/Y',
        ]);

        $inspection_schedules = InspectionSchedule::findOrFail($id);
        $inspection_schedules->user_id = $request->user_id;
        $inspection_schedules->inspection_id = $id;
        $inspection_schedules->inspection_date = Carbon::createFromFormat('m/d/Y', $request->inspection_date)->format('Y-m-d');
        $inspection_schedules->status = strval($request->status);
        /*$inspection_schedules->status = $request->status;*/
        /*dd($request->status);*/
        $status = $inspection_schedules->save();
        if($status == 1){
            Session::flash('msg', 'Inspection Updated successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return redirect('/admin/inspection/schedule/edit/'.$id);
    }

    public function getPermanentDeleteInspectionSchedule($id){
        $inspection_schedules = InspectionSchedule::findOrFail($id);
        $status = $inspection_schedules->delete();
        if($status == 1){
            Session::flash('msg', 'Inspection Deleted successfully.');
        }else{
            Session::flash('msg', 'Something went wrong, Try again later!');
        }
        return \Redirect::back();
    }  
 
}

