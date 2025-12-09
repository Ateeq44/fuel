<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        .btn-check:focus+.btn-secondary, .btn-secondary:focus {
            color: #fff;
            background-color: #5c636a;
            border-color: #565e64;
            box-shadow: unset !important;
        }
        .navbar-light .navbar-nav .nav-link {
            color: rgb(0 0 0);
            font-size: 20px;
            margin-left: 15px;
        }
        nav.navbar.navbar-expand-lg.navbar-light.bg-light {
        box-shadow: 0px 0px 4px 0px black;
        }
    </style>
</head>
<body>
    {{-- NAVBAR START --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container">
            @if(auth()->check() && auth()->user()->role === 'admin')
            <a class="navbar-brand" href="{{ url('admin/dashboard') }}">
                <img style="width: 100px;" src="{{asset('images/logo.png')}}" alt="">
            </a>
            @endif
            @if(auth()->check() && auth()->user()->role === 'user')
            <a class="navbar-brand" href="{{ route('user_fuel_entries.index') }}">
                <img style="width: 100px;" src="{{asset('images/logo.png')}}" alt="">
            </a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto">

                    <!-- Dashboard -->
                     @if(auth()->check() && auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/dashboard') }}">Panel</a>
                    </li>
                    
                    <!-- Vehicles -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicles.index') }}">Vehículos</a>
                    </li>

                    <!-- Drivers -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('drivers.index') }}">Conductores</a>
                    </li>

                    <!-- Fuel Entries -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('fuel_entries.index') }}">Entradas de Combustible</a>                   
                    </li>
                     
                    <!-- Entries Reports -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.reports') }}">Informes</a>                   
                    </li>    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('department.index') }}">Departamento</a>                   
                    </li>    
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gas_station.index') }}">Estaciones</a>                   
                    </li>    
                    @endif
                    @if(auth()->check() && auth()->user()->role === 'user')
                    <!-- user Fuel Entries -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user_fuel_entries.index') }}">Entradas de Combustible</a>                   
                    </li>
                    @endif
                </ul>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle bg-dark border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{route('profile.edit')}}">{{ __('Perfil') }}</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <li><a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">{{ __('Cerrar Sesión') }}</a></li>
                        </form>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    {{-- NAVBAR END --}}

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f5eb8f10bc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            var today = new Date().toISOString().split('T')[0];
            $('#dateField').val(today);   // Default value = today
            // $('#dateField').attr('max', today); // Max date = today
        });

    </script>
</body>
</html>
