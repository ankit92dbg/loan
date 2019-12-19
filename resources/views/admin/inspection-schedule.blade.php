@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
   <h1>
      Inspection Schedule 
   </h1>
   <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Inspection Schedule</li>
   </ol>
</section>

<section class="content"  style="min-height: 0;">
   <!-- Default box -->
   <div class="box">
      <div class="box-header with-border">
         <a href="{{url('/admin/inspection/schedule/add',$inspection_id)}}"> <button type="button" class="btn btn-primary">Add Inspection Schedule</button></a>
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
               <div class="box-body table-responsive no-padding">
                  <table class="table table-hover listings-table">
                     <thead>
                        <tr>
                          <th>ID</th>
                          <th>Inspection Name</th>
                          <th>Assigned User</th>
                          <th>Inspection Date</th>
                          <th class="no-sort" style="width:80px;">Status</th>
                        </tr>
                     </thead>
                     @forelse($inspection_schedules as $inspection_schedule)
                     <tbody>
                        <tr>
                          <td>{{$inspection_schedule->id}}</td>
                          <td>{{$inspection_schedule->inspection->name}}</td>
                          <td>{{$inspection_schedule->user->first_name}}</td>
                          <td>{{$inspection_schedule->inspection_date}}</td>
                          <td><a href="{{URL('/admin/inspection/schedule/edit/'.$inspection_schedule->id)}}" class="icon-gap"><i class="fa fa-edit"></i></a><a href="{{url('/admin/inspection/schedule/permanent-delete/'.$inspection_schedule->id)}}" class="icon-gap"><i class="fa fa-trash delete-listing"></i></a></td>
                        </tr>
                        @empty
                        <tr>
                          <td colspan="7">No data found!</td>
                        </tr>
                      @endforelse  
                     </tbody>
                  </table>
               </div>
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
  $('.listings-table').DataTable({
     "aaSorting": [],
     "columnDefs": [{
          "targets": 'no-sort',
          "orderable": false,
      }]
  });
</script>
@endsection