@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
   <h1>
      Steps 
   </h1>
   <!--<ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Inspection</li>
   </ol> -->
</section>

<section class="content"  style="min-height: 0;">
   <!-- Default box -->
   <div class="box">
      <div class="box-header with-border">
         <a href="{{url('/admin/inspection/step/steps-add',$inspection_id)}}"><button type="button" class="btn btn-primary">Add Steps</button></a> 
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
                          <!-- <th>No.</th> -->
                          <th>ID</th>
                          <th>Inspection Name</th>
                          <!-- <th>Type</th> -->
                          <th>Category</th>
                          <th>Sub Category</th>
                          <th class="no-sort" style="width:55px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                      @forelse($inspection_steps as $inspection_step)
                        <tr>
                          <!-- <td>{{ $loop->iteration }}</td> -->
                          <td>{{$inspection_step->id}}</td>
                          <td>{{$inspection_step->inspection->name}}</td>
                          <!-- <td>{{$inspection_step->type}}</td> -->
                          <td>{{$inspection_step->category}}</td>
                          <td>{{$inspection_step->sub_category}}</td>
                          <td><a href="{{URL('/admin/inspection/step/steps-edit/'.$inspection_id.'/'.$inspection_step->id)}}" class="icon-gap"><i class="fa fa-edit"></i></a><a href="{{url('/admin/inspection/step/permanent-delete/'.$inspection_step->id)}}" class="icon-gap"><i class="fa fa-trash delete-listing"></i></a></td>
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