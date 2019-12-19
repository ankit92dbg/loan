@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
   <h1>
      Inspection 
   </h1>
   <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Inspection</li>
   </ol>
</section>

<section class="content"  style="min-height: 0;">
   <!-- Default box -->
   <div class="box">
      <div class="box-header with-border">
         <a href="{{url('/admin/inspection/add')}}"> <button type="button" class="btn btn-primary">Add Inspection</button></a>
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
                          <th>Name</th>
                          <th>Description</th>
                          <th>Identification Number</th>
                          <th>Entity</th>
                          <th>Qr Code</th>
                          <th class="no-sort" style="width:80px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                      @forelse($inspections as $inspection)
                        <tr>
                          <td>{{$inspection->id}}</td>
                          <td>{{$inspection->name}}</td>
                          <td>{{$inspection->description}}</td>
                          <td>{{$inspection->identification_number}}</td>
                          <td>{{$inspection->entity}}</td>
                          <td></td>
                          <td><a href="{{URL('/admin/inspection/edit/'.$inspection->id)}}" class="icon-gap"><i class="fa fa-edit"></i></a><a href="{{URL('/admin/inspection/step/steps-list/'.$inspection->id)}}" class="icon-gap assign-tag"><i class="fa fa-share"></i></a><a href="{{URL('/admin/inspection/inspection-schedule/'.$inspection->id)}}" class="icon-gap assign-tag"><i class="fa fa-calendar-check-o"></i></a><a href="{{url('/admin/inspection/permanent-delete',$inspection->id)}}" class="icon-gap"><i class="fa fa-trash delete-listing"></i></a></td>
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