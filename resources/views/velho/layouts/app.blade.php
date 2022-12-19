<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Dashboard</title>
        <link rel="shortcut icon" href="{{asset('adminlte/dist/img/AdminLTELogo.png')}}">
        
        @include('parts.head')

        <link rel="stylesheet" href="{{asset('velho/css/app.css')}}">
        
        @stack('head')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            {{--@include('parts.preloader')--}}
            @include('parts.menu_horizontal')
            @include('parts.menu_main')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                
                @yield('content')
                
            </div>
            @include('parts.footer')
        </div>
        <!-- ./wrapper -->

        @include('parts.scripts')
        
        <script src="{{ asset('velho/js/app.js') }}"></script>

        @stack('script')

        @include('components.flash.session')
        @include('parts.modalmessage')
    </body>
</html>