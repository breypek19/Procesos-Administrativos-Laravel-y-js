<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-16x16.png')}}"> {{-- uso logo ipuc y lo convierto a favicon para mostrar la imagen en la pestaña  --}}

    <title>Gestion Ipuc (Tesoreria, Ingresos-Egresos, Reportes)</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.js') }}" defer></script>
    <script src="{{ asset('js/tesor/generalTeso.js') }}" defer></script>
    <script src="{{ asset('js/alertify.min.js') }}" defer></script>
    @yield('datatablesjs')
    @yield('datatablesEgresosjs')
    
  @yield('ingreso')
    @yield('report')
    @yield('reporteEgreso')
    @yield('diezmo')
    @yield('egreso')
  

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alertify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tesor.css') }}" rel="stylesheet">
    @yield('datatablescss')

</head>
<body>
    <div id="app" >
        <nav 
        class="navbar navbar-expand-md navbar-dark  shadow-sm " >
            <div class="container">
                <a class="navbar-brand text-light" href="{{ url('/') }}">
                    <span class="usuari"> <strong class="text-black ">{{ Auth::user()->nom_usuario }}</strong></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto text-light">
                   
                    
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ">
                       
                        
                           
                                <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle text-white ag" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ingresos</a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item " href="{{route('ingresos.create')}}">Crear Ingresos</a>
                                 <a class="dropdown-item" href="{{route('mostrarMov')}}">Listar</a>
                                  <a class="dropdown-item" href="{{route('mostrarRepor')}}">Reportes</a>
                                  <div class="dropdown-divider"></div>
                                  
                                  <a class="dropdown-item " href="{{route('diezmo')}}">Liquidador de diezmos</a>
                                   </div>
                                </li>

                                

                                <li class="nav-item dropdown mr-3 ">
                                <a class="nav-link dropdown-toggle text-white ag" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Egresos</a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('egresos.create')}}">Crear Egresos</a>
                                 <a class="dropdown-item" href="{{route('vista.Egresos')}}">Listar Movimientos</a>
                                <a class="dropdown-item" href="{{route('reportes.egresos')}}">Reportes</a>
                                  <div class="dropdown-divider"></div>
                                   </div>
                                </li>
                                
                          
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ strtoupper(Auth::user()->role->nombre) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
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

        <main class="py-5 ">
            @yield('content')
        </main>
    </div>
</body>
</html>
