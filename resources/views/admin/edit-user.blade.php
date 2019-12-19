@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
   <h1>
      Edit User
   </h1>
   <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('admin/users')}}"> Users</a></li>
      <li class="active">Edit User</li>
   </ol>
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
               <form role="form" method="POST">
               @csrf
                  <div class="box-body">
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label for="inputTitle">First Name<span class="mandatory-field">*</span></label>
                           <input type="text" maxlength="50" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="Enter Your First Name" required>
                           @error('first_name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                        <div class="form-group col-md-6">
                           <label for="inputTitle">Last Name<span class="mandatory-field">*</span></label>
                           <input type="text" maxlength="50" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Enter Your Last Name" required>
                           @error('last_name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label for="inputTitle">Email ID<span class="mandatory-field">*</span></label>
                           <input type="text" maxlength="100" class="form-control" name="email" value="{{ old('email', $user->email)}}" placeholder="Enter Your Email ID" autocomplete="off" required>
                           @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label for="inputTitle">Password</label>
                           <input type="password" class="form-control" name="password" value="" placeholder="Enter Your Password" autocomplete="off">
                           @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                        <div class="form-group col-md-6">
                           <label for="inputTitle">Role<span class="mandatory-field">*</span></label>
                           <select class="form-control" name="role_id">
                              <option value="">Select Role</option>
                              <option value="1" {{(old('role_id', $user->role_id) == 1 ? "selected":"")}} >Admin</option>
                              <option value="2" {{(old('role_id', $user->role_id) == 2 ? "selected":"")}} >Inspector</option>
                           </select>
                           @error('role_id')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label for="inputTitle">Organization<span class="mandatory-field">*</span></label>
                           <input type="text" maxlength="50" class="form-control" name="organization" value="{{ old('organization', $user->organization) }}" placeholder="Enter Your Organization" required>
                           @error('organization')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                        <div class="form-group col-md-6">
                           <label for="inputTitle">Location<span class="mandatory-field">*</span></label>
                           <input type="text" maxlength="50" class="form-control" name="location" value="{{ old('location', $user->location) }}" placeholder="Enter Your Location" required>
                           @error('location')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Save</button>
                     <a href="{{url('/admin/users')}}"> <button type="button" class="btn btn-danger">Cancel</button></a>
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
