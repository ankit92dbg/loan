@extends('layouts.admin-layout')

@section('styles')
<link rel="stylesheet" href="{{url('/plugins/imageareaselect/css/imgareaselect-default.css')}}">
@endsection

@section('content')
<section class="content-header">
   <h1>
      Edit Steps
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
               <form role="form" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">
                    <div class="row">
                       <div class="form-group col-md-6">
                          <label for="inputName">Type<span class="mandatory-field">*</span></label>
                          <select name="type" class="form-control" onchange="fetchTags(this.value)">
                               <option value="">Select Type</option>
                               <option value="{{ old('type', $inspection_steps->type) }}" {{($inspection_steps->type=='0')?'selected="selected"':''}}>Options</option>
                               <option value="{{ old('type', $inspection_steps->type) }}" {{($inspection_steps->type=='1')?'selected="selected"':''}}>DataEntry</option>
                               <option value="{{ old('type', $inspection_steps->type) }}" {{($inspection_steps->type=='2')?'selected="selected"':''}}>QR</option>
                          </select>
                          @error('type')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-md-6">
                          <label for="inputName">Category<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="category" maxlength="100" value="{{ old('category', $inspection_steps->category) }}" placeholder="Enter Type Category" required>
                          @error('category')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                       <div class="form-group col-md-6">
                          <label for="inputName">Sub Category<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="sub_category" maxlength="100" value="{{ old('sub_category', $inspection_steps->sub_category) }}" placeholder="Enter Sub Category" required>
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
                          <textarea name="description" class="form-control" rows="3" maxlength="5000" placeholder="Enter Description" style="resize: vertical;">{{ old('description', $inspection_steps->description)}}</textarea>
                          @error('description')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                       <div class="form-group">
                          <label for="exampleInputFile">File input</label>
                          <input type="file" id="exampleInputFile">

                          <p class="help-block">Example block-level help text here.</p>
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-md-6" id="is_numerical" style="display: none;">
                          <label for="inputName">Is Numerical<span class="mandatory-field">*</span></label>
                          <input type="checkbox" name="is_numerical" value="{{ old('is_numerical', $inspection_steps->is_numerical) }}" {{($inspection_steps->is_numerical=='1')?'checked':''}}>
                          @error('is_numerical')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-md-6" id="option">
                          <label for="inputName">Option<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="option" maxlength="100" value="{{ old('option', $inspection_steps->option) }}" placeholder="">
                          @error('option')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                        <!-- <div class="form-group col-md-6" id="photo-option">
                            <label>Photo Options<span class="mandatory-field">*</span></label>
                            <input type="radio" name="photo_option" value="{{ old('photo_option', $inspection_steps->photo_option) }}" {{($inspection_steps->photo_option=='yes')?'checked':''}}> Yes<br>
                            <input type="radio" name="photo_option" value="{{ old('photo_option', $inspection_steps->photo_option) }}" {{($inspection_steps->photo_option=='no')?'checked':''}}> No<br>
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
                          <input type="text" class="form-control" name="evidence_option" maxlength="100" value="{{ old('evidence_option', $inspection_steps->evidence_option) }}" placeholder="">
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
                               <option value="{{ old('evidence_type', $inspection_steps->evidence_type) }}" {{($inspection_steps->evidence_type=='0')?'selected="selected"':''}}>Photo</option>
                               <option value="{{ old('evidence_type', $inspection_steps->evidence_type) }}" {{($inspection_steps->evidence_type=='1')?'selected="selected"':''}}>Video</option>
                               <option value="{{ old('evidence_type', $inspection_steps->evidence_type) }}" {{($inspection_steps->evidence_type=='2')?'selected="selected"':''}}>Text</option>
                            </select>
                            @error('evidence_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                             @enderror
                         </div>
                       </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Save</button>
                     <a href="{{url('/admin//admin/inspection/step/steps-list/'.$inspection_steps->id)}}"> <button type="button" class="btn btn-danger">Cancel</button></a>
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
@endsection
