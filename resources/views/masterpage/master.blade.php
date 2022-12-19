<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema</title>
        <link rel="preload" href="{{ asset('img/icons/favicon.ico')}}" as="image">
        <link rel="shortcut icon" href="{{ asset('img/icons/favicon.ico')}}">
        
        @include('parts.head')
        @stack('head')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            {{-- @include('parts.preloader') --}}
            @include('parts.menu_horizontal')
            @include('parts.menu_main')

            
            <div class="content-wrapper pb-4">
                @include('parts.breadcrumb')
                @include('parts.error')
                @yield('content')
                
            </div>
            @include('parts.footer')
        </div>
       


        @include('parts.scripts')
        @include('parts.modalmessage')        

        @stack('script')
    </body>
</html>