<?php
$paths = [
    "plugins/jquery/jquery.min.js",
    "plugins/jquery-ui/jquery-ui.min.js",
    "plugins/jquery-nestable/jquery.nestable.js",
    "plugins/jquery-repeatable/jquery.repeatable.js",
    "plugins/bootstrap/js/bootstrap.bundle.min.js",
    "plugins/chart.js/Chart.min.js",
    "plugins/sparklines/sparkline.js",
    "plugins/jqvmap/jquery.vmap.min.js",
    "plugins/jqvmap/maps/jquery.vmap.usa.js",
    "plugins/jquery-knob/jquery.knob.min.js",
    "plugins/jquery-mask/jquery.mask.min.js",
    // "plugins/sweetalert2/sweetalert2.min.js",
    "plugins/toastr/toastr.min.js",
    "plugins/moment/moment.min.js",
    "plugins/daterangepicker/daterangepicker.js",
    "plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js",
    "plugins/summernote/summernote-bs4.min.js",
    "plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
    "plugins/bootstrap-toggle/js/bootstrap-toggle.min.js",

    "dist/js/adminlte.js",
    "dist/js/demo.js",
    "dist/js/pages/dashboard.js",
];
?>

@foreach($paths as $path)
<link rel="preload" href="{{asset('adminlte/'.$path)}}" as="script">
  <script src="{{asset('adminlte/'.$path)}}"></script>
@endforeach

<link rel="preload" href="{{asset('velho/js/modules.js')}}" as="script">
<script src="{{asset('velho/js/modules.js')}}" type="module"></script>

<script>
$.widget.bridge('uibutton', $.ui.button)
</script>

{{-- para uso no data tables --}}
<?php
$paths = [
    'plugins/datatables/jquery.dataTables.min.js',
    'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
    'plugins/datatables-responsive/js/dataTables.responsive.min.js',
    'plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
    'plugins/datatables-buttons/js/dataTables.buttons.min.js',
    'plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
    'plugins/jszip/jszip.min.js',
    'plugins/pdfmake/pdfmake.min.js',
    'plugins/pdfmake/vfs_fonts.js',
    'plugins/datatables-buttons/js/buttons.html5.min.js',
    'plugins/datatables-buttons/js/buttons.print.min.js',   
    
];
?>
<!-- DataTables  & Plugins -->
@foreach($paths as $path)
<link rel="preload" href="{{asset('adminlte/'.$path)}}" as="script">
<script src="{{asset('adminlte/'.$path)}}"></script>
@endforeach

<link rel="preload" href="{{asset('dataTables/dataTablesPTBR.js')}}" as="script">
<script src="{{asset('dataTables/dataTablesPTBR.js')}}"></script>

<link rel="preload" href="{{asset('dataTables/functions_exec.js')}}" as="script">
<script src="{{asset('dataTables/functions_exec.js')}}"></script>

<link rel="preload" href="{{asset('fetch.js')}}" as="script">
<script src="{{asset('fetch.js')}}"></script>

<link rel="preload" href="{{asset('functions.js')}}" as="script">
<script src="{{asset('functions.js')}}"></script>

<script>
$(document).ready(function() {
  $('.summernote').summernote();
});
</script>