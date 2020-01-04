@extends('layouts.admin-layout')

@section('content')
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

<section class="content"  style="min-height: 0;">
   <!-- Default box -->
   <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                @if($total_user)
                  {{$total_user}}
                @else 
                  0 
                @endif  
              </h3>
              <p>Total User</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
              @if($approved_loan)
                {{$approved_loan}}
              @else 
                  0 
              @endif   
              </h3>
              <p>Approved Application</p>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
              @if($pending_loan)
                {{$pending_loan}}
              @else 
                  0 
              @endif                 
              </h3>
              <p>Pending Application</p>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
              @if($rejected_loan)    
              {{$rejected_loan}}
              @else 
                  0 
              @endif
            </h3>
              <p>Rejected Application</p>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
      </div>
   <!-- /.box -->
</section>
@endsection
@section('scripts')
<script>
  //
</script>
@endsection