@extends('layouts.admin-layout')

@section('styles')
<link rel="stylesheet" href="{{url('/plugins/imageareaselect/css/imgareaselect-default.css')}}">
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
               <form role="form" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">
                    <div class="row">
                       <div class="form-group col-md-12">
                          <label for="inputName">Inspection Name<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="name" maxlength="100" value="" placeholder="Enter Inspection Name " required>
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-md-6">
                          <label for="inputName">Type<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="name" maxlength="100" value="" placeholder="Enter Inspection Name " required>
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                     </div>
                     <div class="row">
                       <div class="form-group col-md-6">
                          <label>Category<span class="mandatory-field">*</span></label>
                          <select name="" class="form-control" onchange="fetchTags(this.value)">
                               <option value="">Select Category</option>
                               <option value="" ></option>
                          </select>
                          @error('')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                       <div class="form-group col-md-6">
                          <label>Sub Category<span class="mandatory-field">*</span></label>
                          <select name="" class="form-control" onchange="fetchTags(this.value)">
                               <option value="">Select Sub Category</option>
                               <option value="" ></option>
                          </select>
                          @error('')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Save</button>
                     <a href="{{url('/admin/inspection')}}"> <button type="button" class="btn btn-danger">Cancel</button></a>
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
