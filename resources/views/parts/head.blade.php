<!-- Google Font: Source Sans Pro -->
<link rel="preload" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" as="style">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Ionicons -->
<link rel="preload" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" as="style">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<?php
$paths = [
    "plugins/fontawesome-free/css/all.min.css",
    "plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css",
    "plugins/icheck-bootstrap/icheck-bootstrap.min.css",
    "plugins/jqvmap/jqvmap.min.css",
    "dist/css/adminlte.min.css",
    "plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
    "plugins/daterangepicker/daterangepicker.css",
    "plugins/summernote/summernote-bs4.min.css",
    // "plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css",
    "plugins/toastr/toastr.min.css",
    "plugins/bootstrap-toggle/css/bootstrap-toggle.min.css",
];
?>
@foreach($paths as $path)
<link rel="preload" href="{{asset('adminlte/'.$path)}}" as="style">
<link rel="stylesheet" href="{{asset('adminlte/'.$path)}}">
@endforeach

{{-- para uso data tables --}}
<?php
$paths = [
    'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
    'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
    'plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
];
?>
@foreach($paths as $path)
<link rel="preload" href="{{asset('adminlte/'.$path)}}" as="style">
<link rel="stylesheet" href="{{asset('adminlte/'.$path)}}">
@endforeach