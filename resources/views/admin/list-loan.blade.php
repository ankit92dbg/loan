@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
   <h1>
      {{$users->first_name}} {{$users->last_name}}(Loan List)
   </h1>
   <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Users</li>
   </ol>
</section>

<section class="content"  style="min-height: 0;">
   <!-- Default box -->
   <div class="box">
      <div class="box-header with-border">
         <i class="fa fa-flag" style="color:pink"></i> Requested,&nbsp <i class="fa fa-flag" style="color:orange"></i> Pending,&nbsp <i class="fa fa-flag" style="color:green"></i> Acceped,&nbsp <i class="fa fa-flag" style="color:red"></i> Rejected
      </div>
      <div class="box-body">
         <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
               <!-- /.box-header -->
               <div class="box-body table-responsive no-padding">
                  <table class="table table-hover users-table">
                     <thead>
                        <tr>
                          <th>ID</th>
                          <th>Requested Amount (Rs)</th>
                          <th>Eligible Amount (Rs)</th>
                          <th>Loan Amount (Rs)</th>
                          <th>Flag</th>
                          <th>Loan Status</th>
                          <th class="no-sort">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     @if(count($loan))
                       @foreach($loan as $user)
                          <tr>
                            <td>{{$user->id}}</td>
                            <td>
                              @if($user->requested_amount==null)
                                 N/A
                               @else
                                 {{$user->requested_amount}}
                               @endif 
                            </td>
                            <td>
                               @if($user->eligible_amount==null)
                               N/A
                               @else
                               {{$user->eligible_amount}}
                               @endif
                            </td>
                            <td>
                               @if($user->loan_amount==null)
                               N/A
                               @else
                               {{$user->loan_amount}}
                               @endif
                            </td>
                            <td>
                              @if($user->loan_status==-1)
                               <i class="fa fa-flag" style="color:pink"></i>
                               @elseif($user->loan_status==0)
                               <i class="fa fa-flag" style="color:orange"></i>
                               @elseif($user->loan_status==1)
                               <i class="fa fa-flag" style="color:green"></i>
                               @elseif($user->loan_status==2) 
                               <i class="fa fa-flag" style="color:red"></i>
                               @endif
                            </td>
                            <td>
                              @if($user->loan_status==-1)
                              Requested
                              @elseif($user->loan_status==0)
                              Pending
                              @elseif($user->loan_status==1)
                              Approved
                              @elseif($user->loan_status==2)
                              Rejected
                              @else
                              N/A
                              @endif
                            </td>
                            <td>
                            <a href="{{url('/admin/users/view',$users->id)}}/{{$user->id}}" class="icon-gap"><i class="fa fa-eye"></i></a>
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
<script>
  $('.users-table').DataTable({
    "aaSorting": [],
     "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
      } ]
  });
</script>
@endsection