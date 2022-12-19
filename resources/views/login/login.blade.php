<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="preload" href="{{ asset('img/icons/favicon.ico')}}" as="image">
        <link rel="shortcut icon" href="{{ asset('img/icons/favicon.ico')}}">
        <!-- Google Font: Source Sans Pro -->
        <link rel="preload" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" as="style">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <?php
        $paths = [
            "plugins/fontawesome-free/css/all.min.css",
            "plugins/icheck-bootstrap/icheck-bootstrap.min.css",
            "dist/css/adminlte.min.css"
        ];
        ?>
        @foreach($paths as $path)
        <link rel="preload" href="{{asset('adminlte/'.$path)}}" as="style">
        <link rel="stylesheet" href="{{asset('adminlte/'.$path)}}">
        @endforeach
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">           
            <div class="card card-outline card-primary">
                <div class="card-header text-center">  
                    <link rel="preload" href="{{ asset('img/system/logoAppAnywhereFacebook.gif')}}" as="image">
                    <img src="{{ asset('img/system/logoAppAnywhereFacebook.gif')}}"              
                         class="img-fluid bg-white" 
                         style="opacity: .8">                    
                </div>
                <div class="card-body">
                    <p class="login-box-msg">
                        Login de acesso ao sistema
                    </p>
                    
                    @include('parts.error')
                    <form action="{{route('access')}}" method="post">
                        @csrf
                        <div class="input-group mb-3">

                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                        </div>

                        <div class="input-group mb-3">

                            <input type="password" name="password" class="form-control" placeholder="Senha">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>

                        </div>

                        <div class="row">


                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Acessar
                                </button>
                            </div>

                        </div>
                    </form>

                    <p class="mb-1">
                        <i>Recuperar senha ou cadastrar novo usuário,</i>
                    </p>
                    <p class="mb-0">
                        <i>procure o administrador do site</i>
                    </p>
                </div>

            </div>

        </div>


        <?php
        $paths = [
            'plugins/jquery/jquery.min.js',
            'plugins/bootstrap/js/bootstrap.bundle.min.js',
            'dist/js/adminlte.min.js'
        ];
        ?>

        @foreach($paths as $path)
        <link rel="preload" href="{{asset('adminlte/'.$path)}}" as="script">
        <script src="{{asset('adminlte/'.$path)}}"></script>
        @endforeach
    </body>
</html>
