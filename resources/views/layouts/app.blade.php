<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts 
    <script src="{{ asset('js/app.js') }}" defer></script>
    -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin') }}">
                    {{ config('app.name', 'Laravel') }} - Panel Administrativo
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <!--    <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Regist') }}</a>
                                </li>-->
                            @endif
                        @else
                            <li>
                                <a class="btn btn-sucess" href="{{ route('usuario.index') }}">Usuarios</a>
                            </li>
                            <li>
                                <a class="btn btn-sucess" href="{{ route('pedido.index') }}">Pedidos</a>
                            </li>
                            <li>
                                <a class="btn btn-sucess" href="{{ route('categoria.index') }}">Categorias</a>
                            </li>
                            <li>
                                <a class="btn btn-sucess" href="{{ route('subcategoria.index') }}">Subcategorias</a>
                            </li>
                             <li>
                                <a class="btn btn-sucess" href="{{ route('tag.index') }}">Tags</a>
                            </li>
                            <li>
                                <a class="btn btn-sucess" href="{{ route('editorial.index') }}">Editoriales</a>
                            </li>
                            <li>
                                <a class="btn btn-sucess" href="{{ route('autor.index') }}">Autores</a>
                            </li>
                            <li>
                                <a class="btn btn-sucess" href="{{ route('blog.index') }}">Blogs</a>
                            </li>
                            <li>
                                <a class="btn btn-sucess" href="{{ route('producto.index') }}">Productos</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->full_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/popper.min.js/') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js/') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert2.min.js') }}"></script>
    
    <!-- SCRIPT PARA LAS NOTIFICACIONES BONIS uwu -->
    <script>
       
       @if(Session::has('toastr') && Session::has('msg'))

            var type = "{{ Session::get('toastr') }}";
            var msg =  "{{ Session::get('msg') }}";

            switch(type)
            {
                case 'success':
                    toastr.success(msg);
                    break;
                case 'warning':
                    toastr.warning(msg);
                    break;
                case 'info':
                    toastr.info(msg);
                    break;
                case 'error':
                    toastr.error(msg);
                    break;
            }

       @endif
       
    </script>
    @yield('script')

</body>
</html>
