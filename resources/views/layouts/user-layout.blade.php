<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Fabweddings</title>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&display=swap" rel="stylesheet">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="{{url('/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('/plugins/datepicker/bootstrap-datepicker.min.css')}}">
    @yield('styles')
    <link rel="stylesheet" href="{{url('/css/swiper.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('/css/slick-theme.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('/admin/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('/plugins/select2/css/select2.min.css')}}">
    @stack('custom-css')
    <link rel="stylesheet" href="{{url('/css/slick.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('/css/custom.css')}}" type="text/css">
</head>
<body>
    @include('layouts.user-header')
    @yield('content')
    @include('layouts.user-footer')
    {{--@include('layouts.login-sinup-modal')--}}
    <!-- start show flash message -->
    <div class="flash-message animated delay-3s" style="display: none;">
        <p></p>
    </div>
    <!-- end show flash message -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{url('/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> 
    <script src="{{url('/js/swiper.min.js')}}"></script>
    <script src="{{url('/js/slick.min.js')}}"></script>
    <script src="{{url('/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{url('/plugins/select2/js/select2.full.min.js')}}"></script>
    @stack('custom-scripts')
    <script src="{{url('/js/custom.js')}}"></script>
    <script>
        function submitNewsletter(){
            let data = {
                '_token' : $('meta[name="csrf_token"]').attr('content'),
                'email_id' : $('input[name=newsletter]').val()
              }
            $.ajax({
                'url':"{{ url('/newsletter') }}",
                'type':'POST',
                'data':data
            }).done(function(res){
                if(res.ststus == 1){
                    $('input[name=newsletter]').val('');
                    alert(res.message);
                }
                else{
                    alert(res.message);
                }
            })
        }
    </script>
    @yield('scripts')
</body>
</html>