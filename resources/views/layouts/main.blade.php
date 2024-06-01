<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-PL-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>@yield('title')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-dark">
    <header class="d-flex flex-wrap align-items-center justify-content-between justify-content-md-between py-3 mb-4 border-bottom bg-dark">
    <ul class="nav col-12 col-md-auto mb-2 justify-content-start mb-md-0">
        <li> <a href="{{route('home.index')}}" class="nav-link px-2 link-secondary text-white">Strona główna</a></li>
        <li><a href="{{route('menu.index')}}" class="nav-link px-2 link-secondary text-white">Menu</a></li>
        <li><a href="{{route('contact.index')}}" class="nav-link px-2 link-secondary text-white">Kontakt</a></li>
    </ul>

    <div class="d-flex align-items-center ms-auto">
        <div class="me-3 d-flex align-items-center ms-auto">
            <a href="{{route('cart.index')}}" class="nav-link px-2 link-dark text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-cart" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                <span class="badge rounded-pill bg-light text-dark" id="cartCount">{{$cartCount}}</span>
            </a>
        </div>
        <div class="dropdown" width="100px">
            @guest
                @if (Route::has('login'))
                    <button class="btn btn-warning btn-as-link" onclick="window.location.href='{{ route('login') }}'">{{ __('Login') }}</button>
                @endif
                @if (Route::has('register'))
                    <button onclick="window.location.href='{{ route('register') }}'" class="btn btn-primary btn-as-link">{{ __('Register') }}</button>
                @endif
            @else
                <a id="navbarDropdown" class="btn btn-warning rounded-3 mr-3 px-3 d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                    <span class="dropdown-toggle-icon"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->hasRole(['admin']))
                        <a href="{{ route('admin.index') }}" class="dropdown-item">Admin panel</a>
                    @endif
                    @if (Auth::user()->hasRole(['worker']))
                        <a href="{{ route('worker.index') }}" class="dropdown-item">Worker panel</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    
                </div>
            @endguest
        </div>
    </div>
</header>


    <div class="container">
        @yield('main_content')
        <br>
    </div>

    @if ($errors->any())
    <div class="container alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


</body>
</html>