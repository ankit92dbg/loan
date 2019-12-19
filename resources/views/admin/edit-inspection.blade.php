@extends('layouts.admin-layout')

@section('styles')
<link rel="stylesheet" href="{{url('/plugins/imageareaselect/css/imgareaselect-default.css')}}">
@endsection

@section('content')
<section class="content-header">
   <h1>
      Edit Inspection
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
                          <label for="inputName">Name<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="name" maxlength="100" value="{{ old('name', $inspections->name) }}" placeholder="Enter Inspection Name " required>
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-md-6">
                          <label for="inputDescription">Description</label>
                          <textarea name="description" class="form-control" rows="3" maxlength="5000" placeholder="Enter Description" style="resize: vertical;">{{ old('description', $inspections->description)}}</textarea>
                          @error('description')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                     </div>
                     <div class="row">
                       <div class="form-group col-md-6">
                          <label for="identificationNumber">Identification Number</label>
                          <input type="text" class="form-control" name="identification_number" maxlength="100" value="{{ old('identification_number', $inspections->identification_number) }}" placeholder="Enter Inspection Number " required>
                          @error('number')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                       <div class="form-group col-md-6">
                          <label for="inputEntity">Entity</label>
                          <input type="text" class="form-control" name="entity" maxlength="100" value="{{ old('entity', $inspections->entity) }}" placeholder="Enter Entity" required>
                          @error('entity')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                     </div>
                     <div class="row">
                       <div class="form-group col-md-6">
                          <label for="inputName">Reference<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="reference" maxlength="100" value="{{ old('reference', $inspections->reference) }}" placeholder="Enter Inspection Name " required>
                          @error('reference')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
                       <div class="form-group col-md-6">
                          <label for="inputName">Classification<span class="mandatory-field">*</span></label>
                          <input type="text" class="form-control" name="classification" maxlength="100" value="{{ old('classification', $inspections->classification) }}" placeholder="Enter Inspection Name " required>
                          @error('classification')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                       </div>
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
