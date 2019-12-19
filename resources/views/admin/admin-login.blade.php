<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin | Loan</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="{{url('/admin/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/ionicons.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/animate.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/AdminLTE.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/_all-skins.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/admin-custom.css')}}">
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
<!-- start show flash message -->
    @include('admin.flash-message')
<!-- end show flash message -->
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}"><b>Loan</b>Application</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>

    <form method="POST" action="">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="Email">
        <i class="fa fa-envelope form-control-feedback"></i>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name=password id="password" class="form-control" placeholder="Password">
        <i class="fa fa-lock form-control-feedback"></i>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{url('/admin/js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('/admin/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{url('/admin/js/icheck.min.js')}}"></script>
</body>
</html>
