<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf_token" content="{{ csrf_token() }}" />
      <title>Admin | Loan Application </title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="{{url('/admin/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{url('/plugins/datatables/datatables.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/ionicons.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/animate.css')}}">
      <link rel="stylesheet" href="{{url('/plugins/select2/css/select2.min.css')}}">
      <link rel="stylesheet" href="{{url('/plugins/datepicker/bootstrap-datepicker.min.css')}}">
      @yield('styles')
      <link rel="stylesheet" href="{{url('/admin/css/AdminLTE.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/_all-skins.min.css')}}">
      <link rel="stylesheet" href="{{url('/admin/css/admin-custom.css')}}">
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   </head>
   <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
   <!-- the fixed layout is not compatible with sidebar-mini -->
   <body class="hold-transition skin-blue fixed sidebar-mini">
      <!-- start show flash message -->
           @include('admin.flash-message')
      <!-- end show flash message -->
      <!-- Site wrapper -->
      <div class="wrapper">
         @include('layouts.admin-header')
         @include('layouts.admin-sidebar')
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            @yield('content')
         </div>
         <!-- /.content-wrapper -->
         @include('layouts.admin-footer')
         <div class="control-sidebar-bg"></div>
      </div>
      <script src="{{url('/admin/js/jquery.min.js')}}"></script>
      <script src="{{url('/admin/js/bootstrap.min.js')}}"></script>
      <script src="{{url('/admin/js/jquery.slimscroll.min.js')}}"></script>
      <script src="{{url('/plugins/datatables/datatables.min.js')}}"></script>
      <script src="{{url('/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
      <script src="{{url('/plugins/select2/js/select2.full.min.js')}}"></script>
      <script src="{{url('/admin/js/fastclick.js')}}"></script>
      <script src="{{url('/admin/js/adminlte.min.js')}}"></script>
      <script src="{{url('/admin/js/demo.js')}}"></script>
      @yield('scripts')
   </body>
</html>