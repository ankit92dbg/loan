@extends('layouts.admin-layout')

@section('styles')
<link rel="stylesheet" href="{{url('/plugins/imageareaselect/css/imgareaselect-default.css')}}">
@endsection

@section('content')
<section class="content-header">
   <h1>
      Edit Inspection Schedule
   </h1>
<!--<ol class="breadcrumb">
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
                      <!-- @php //echo "<pre>";print_r($inspection_schedules->user_id);die;@endphp -->
                       <div class="form-group col-md-6">
                          <label>Assign User<span class="mandatory-field">*</span></label>

                          <select class="form-control" name="user_id">
                               <option value="">Select User</option>
                               @forelse($users as $user)
                               <option value="{{$user->id}}" 
                                {{
                                  ($inspection_schedules->user_id == $user->id)? 'selected': ''
                                }}>{{$user->first_name}}</option>
                               @empty
                               <option value="">No user found</option>
                               @endforelse
                          </select>
                          @error('user_id')
                              <span class="invalid-feedback" role="alert">
                                  <strong></strong>
                              </span>
                          @enderror
                        </div>
                    </div>
                     <div class="row">
                       <div class="form-group col-md-6">
                          <label>Ispection Date<span class="mandatory-field">*</span></label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" name="inspection_date" value="{{ old('inspection_date', $inspection_schedules->inspection_date) }}">
                          </div>
                          @error('inspection_date')
                              <span class="invalid-feedback" role="alert">
                                  <strong></strong>
                              </span>
                          @enderror
                        </div>
                       <div class="form-group col-md-6">
                          <label for="inputEntity">Status</label>
                          <select class="form-control" name="status">
                               <option value="">Select Status</option>
                               <option value="0" {{($inspection_schedules->status == '0')? 'selected': ''}}>Scheduled</option>
                               <option value="1" {{($inspection_schedules->status == '1')? 'selected': ''}}>Inprogress</option>
                               <option value="2" {{($inspection_schedules->status == '2')? 'selected': ''}}>Completed</option>
                          </select>
                          <!-- <select class="form-control" name="status">
                               <option value="">Select Status</option>
                               <option value="{{ old('status', $inspection_schedules->status) }}" {{($inspection_schedules->status=='0')?'selected="selected"':''}}>Scheduled</option>
                               <option value="{{ old('status', $inspection_schedules->status) }}" {{($inspection_schedules->status=='1')?'selected="selected"':''}}>Inprogress</option>
                               <option value="{{ old('status', $inspection_schedules->status) }}" {{($inspection_schedules->status=='2')?'selected="selected"':''}}>Completed</option>
                          </select> -->

                          @error('status')
                              <span class="invalid-feedback" role="alert">
                                  <strong></strong>
                              </span>
                          @enderror
                       </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Save</button>
                     <a href="{{url('/admin/inspection/schedule/add/')}}"> <button type="button" class="btn btn-danger">Cancel</button></a>
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
//Date picker
    $('.datepicker').datepicker({
      autoclose: true
    })
</script>
@endsection

