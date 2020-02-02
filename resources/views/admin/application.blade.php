@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
   <h1>
      {{$msg}}
   </h1>
   <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">{{$msg}}</li>
   </ol>
</section>

<section class="content"  style="min-height: 0;">
   <!-- Default box -->
   <div class="box">
      <div class="box-body">
         <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
               <!-- /.box-header -->
               <div class="box-body table-responsive no-padding">
                  <table class="table table-striped users-table">
                     <thead>
                        <tr>
                          <th>USER ID</th>
                          <th>LOAN ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Eligible Amount</th>
                          <th>Loan Amount</th>
                          <th>Applied On</th>
                          <th class="no-sort">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     @if(count($loan))
                       @foreach($loan as $loans)
                          <tr>
                            <td>SF{{$loans->user_id}}</td>
                            <td>SF{{$loans->loan_id}}</td>
                            <td>{{$loans->first_name.' '.$loans->last_name}}</td>
                            <td>{{$loans->email}}</td>
                            <td>{{$loans->phone}}</td>
                            <td>{{$loans->eligible_amount}}</td>
                            <td>{{$loans->loan_amount}}</td>
                            <td>{{$loans->applied_on}}</td>
                            <td>
                            <a href="{{url('/admin/users/view',$loans->user_id)}}/{{$loans->loan_id}}" class="icon-gap"><i class="fa fa-eye"></i></a>
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="6">No data found</td>
                        </tr>
                      @endif
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.table').DataTable();
} );

</script>
@endsection