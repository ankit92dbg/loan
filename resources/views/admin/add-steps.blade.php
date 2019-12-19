@extends('layouts.admin-layout')

@section('styles')
<link rel="stylesheet" href="{{url('/plugins/imageareaselect/css/imgareaselect-default.css')}}">
<style>
.error{
   color:red;
}
</style>
@endsection

@section('content')
<section class="content-header">
   <h1>
      Add Steps
   </h1>
<!--    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('admin/listings')}}"> Listing</a></li>
      <li class="active">Add Listing</li>
   </ol> -->
</section>

<section class="content"  style="min-height: 0;">
   <!-- Default box -->
   <div class="box">
      <div class="box-header with-border">
         <h3 class="box-title"></h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
         </div>
      </div>
      <div class="box-body">
         <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" id="addStepForm" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">
                    <div class="row">
                       <div class="form-group col-md-6">
                          <label>Type<span class="mandatory-field">*</span></label>
                          <select name="type" class="form-control" onchange="fetchTags(this.value)">
                               <option value="">Select Type</option>
                               <option value="0">Options</option>
                               <option value="1">DataEntry</option>
                               <option value="2">QR</option>
                          </select>
                          @error('type')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                       <div class="form-group col-md-6">
                          <label>Sequence<span class="mandatory-field">*</span></label>
                          <input type="text" name="sequence" onblur="checkSequence(this.value);" class="form-control" placeholder="Enter sequence">
                          @error('type')
                              <span class="invalid-feedback" role="alert">
                                  <strong id="seqMsg">{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-md-6">
                          <label for="inputName">Category<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="category" maxlength="100" value="" placeholder="Enter Type Category">
                          @error('category')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                       <div class="form-group col-md-6">
                          <label for="inputName">Sub Category<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="sub_category" maxlength="100" value="" placeholder="Enter Sub Category">
                          @error('sub_category')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-md-6">
                          <label for="inputDescription">Description</label>
                          <textarea name="description" class="form-control" rows="3" maxlength="5000" placeholder="Enter Description" style="resize: vertical;"></textarea>
                          @error('description')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                       <div class="form-group">
                          <label for="exampleInputFile">Upload Image</label>
                          <input type="file" name="image_document_url" id="exampleInputFile">
                          <p class="help-block">Example block-level help text here.</p>
                       </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6" id="is_numerical" style="display: none;">
                          <label for="inputName">Is Numerical<span class="mandatory-field">*</span></label>
                          <input type="checkbox" name="is_numerical" value="1">
                          @error('is_numerical')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                        <!-- <div class="form-group col-md-6">
                          <label>Photo Option<span class="mandatory-field">*</span></label>
                          <select class="form-control" name="city_id">
                               <option value="">Select Photo Option</option>
                               <option value=""></option>
                          </select>
                          @error('question')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $city_id }}</strong>
                              </span>
                           @enderror
                       </div>  -->
                     </div>
                     <div class="row">
                       <div class="form-group col-md-6" id="option">
                          <label for="inputName">Option<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="option" maxlength="100" value="" placeholder="">
                          @error('option')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                      <!--   <div class="form-group col-md-6" id="photo-option">
                            <label>Photo Options<span class="mandatory-field">*</span></label>
                            <input type="radio" name="photo_option" value="yes"> Yes<br>
                            <input type="radio" name="photo_option" value="no"> No<br>
                            @error('photo_option')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                             @enderror
                         </div>  -->
                       </div>
                       <div class="row">
                        <div class="form-group col-md-6" id="evidence-option">
                          <label for="inputName">Evidence Option<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="evidence_option" maxlength="100" value="" placeholder="">
                          @error('evidence_option')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                         <div class="form-group col-md-6" id="evidence-type">
                            <label>Evidence Type<span class="mandatory-field">*</span></label>
                            <select name="evidence_type" class="form-control" onchange="">
                               <option value="">Select Type</option>
                               <option value="0">Photo</option>
                               <option value="1">Video</option>
                               <option value="2">Text</option>
                            </select>
                            @error('evidence_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                             @enderror
                         </div>
                       </div>
                     <button id="submitForm" type="submit" class="btn btn-primary">Save</button>
                     <a href="{{url('/admin/inspection/step/steps-list/{id}')}}"> <button type="button" class="btn btn-danger">Cancel</button></a>
                  </div>
               </form>
            </div>
            <!-- Form Element sizes -->
         </div>
      </div>
      <!-- /.box-body -->
   </div>
   <!-- /.box -->
</section>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
<script>
 function fetchTags(val){
    if(val==1){
      $('#is_numerical').show();
      $('#option').hide();
      $('#photo-option').hide();
      $('#evidence-option').hide();
      $('#evidence-type').hide();
    }else{
      $('#is_numerical').hide();
    }
    if(val==0){
      $('#option').show();
      $('#photo-option').show();
      $('#evidence-option').show();
      $('#evidence-type').show();
    }
    if(val==2){
      $('#option').hide();
      $('#photo-option').hide();
      $('#evidence-option').hide();
      $('#evidence-type').hide();
    }
  }
</script>
<script>
$(document).ready(function () {
   $("#addStepForm").validate({
      ignore: ":hidden",
      rules: {
         type: {
               required: true
         },
         sequence: {
               required: true,
               number: true
         },
         category: {
               required: true
         },
         sub_category: {
               required: true
         },
         option: {
               required: true
         },
         evidence_option: {
               required: true
         },
         evidence_type: {
               required: true
         }
      },
      messages: {
         type: {
               required: "Please select type"
         },
         sequence: {
               required: "Please enter sequence step",
               number: "Only digits are acceptable",
         },
         category: {
               required: "Please enter category"
         },
         sub_category: {
               required: "Please enter sub category"
         },
         option: {
               required: "Please enter option"
         },
         evidence_option: {
               required: "Please enter evidence option"
         },
         evidence_type: {
               required: "Please select evidence type"
         }
      }
   });
});
</script>
<script>
//seqMsg
function checkSequence(sequence){
   $('#seqMsg').html('');
   var inspection_id = $(location).attr("href").split('/').pop();
   $.ajax({
      type: "GET",
      url: "check-sequence/"+sequence+"/"+inspection_id,
      // data: "sequence="+sequence+"&_token={{ csrf_token() }}",
      success: function () {
         $('#seqMsg').html('This sequence already exist.');
      }
   });
}
</script>
@endsection