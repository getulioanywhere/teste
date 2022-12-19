<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div  class="brand-link align-content-center">
        <link rel="preload" href="{{ asset('img/system/logoAppAnywhereFacebook.gif')}}" as="image">
                    <img src="{{ asset('img/system/logoAppAnywhereFacebook.gif')}}"              
                         class="brand-image img-circle elevation-3 bg-white" 
                         style="opacity: .8">
        
        <span class="brand-text font-weight-light">
            Sistema 
        </span>
    </div>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->avatar)
                @php $avatar = asset('storage/'.Auth::user()->path_avatar); @endphp
                @else
                @php $avatar = asset('img/system/no-avatar.png'); @endphp                     
                @endif

                <link rel="preload" href="{{ $avatar }}" as="image">
                <img src="{{ $avatar }}" 
                     class="img-circle elevation-2" 
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{Auth::user()->name}}
                </a>
            </div>
        </div>        


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">                

                {{--Abaixo monta menu main --}}
                @menu_main

            </ul>
        </nav>

    </div>

</aside>

@push('script')
    <script>
        $('.nav-pills > .nav-item').addClass('menu-is-opening menu-open')
    </script>
@endpush