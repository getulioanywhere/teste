{{-- https://adminlte.io/themes/v3/pages/UI/modals.html --}}

@if (session()->get('flash'))
    <script>
        $(function(){
            toastr.options = {
                "closeButton": true,
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
            }
            toastr.{{session()->get('flash')['type']}}('{{session()->get('flash')['message']}}')
        });
    </script>
@endif

{{-- @if (session()->get('flash'))
    <script>
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
           icon: "{{session()->get('flash')['type']}}",
           title: "{{session()->get('flash')['message']}}"
        })
    </script>
@endif --}}