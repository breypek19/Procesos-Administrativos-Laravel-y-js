<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-16x16.png')}}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('js/tesor/generalTeso.js') }}" defer></script>
    <script src="{{ asset('js/alertify.min.js') }}" defer></script>
    <script src="{{ asset('js/secre/general.js') }}" defer></script>
    @yield('datatable')
    @yield('personas')
    @yield('SecreReportes')
    @yield('asistenciaJs')
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alertify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/default.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/secretaria.css')}}" rel="stylesheet">
    @yield('CssReportes')
    @yield('datataCss')
    @yield('asistenciaCss')
    @yield('cssdiseño')
</head>
<body>
    <div id="app" class="">
        <nav class="navbar  navbar-expand-md navbar-dark   shadow-sm" >
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="usuari"><strong class="text-info ">{{ Auth::user()->nom_usuario }}</strong></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('MovSecretaria.index')}}">{{ __('Registrar') }}</a>
                            </li>

                        <li class="nav-item text-white dropdown ">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reportes</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('vista.reportes')}}">{{ __('Busqueda') }}</a>
                             <a class="dropdown-item" href=""></a>
                              <a class="dropdown-item" href="{{route('vista.ReporteGeneral')}}">Lista General</a>
                            
                            </li>
                    

                                <li class="nav-item">
                                <a class="nav-link" href="{{route('Asistencias.index')}}">{{ __('Asistencias') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('inventario.index')}}">{{ __('Inventario') }}</a>
                                    </li>
    

                    
                          
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-info" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ strtoupper(Auth::user()->role->nombre ) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                       
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 ">
            @yield('content')
        </main>
    </div>
</body>
</html>
