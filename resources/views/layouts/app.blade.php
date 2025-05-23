<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md   " style="background-color: #4764A3; ">
            <div class="container" >
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
                    
                    SeriesApp
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    

                    <ul class="navbar-nav ms-auto " >
                        <li class="nav-item">
                           <a class="nav-link" href="/" style="color:white;">Home</a>
                        </li>
                        <li class="nav-item">
                        @if (auth()->check() && auth()->user()->id)
                        <a class="nav-link" href="/my-series/{{ auth()->user()->id }}" style="color:white;">My series</a>
                        @else
                        <a class="nav-link" href="/login" style="color:white;">My series</a>
                        @endif
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="/series/create" style="color:white;">Add series</a>
                        </li>
                        <li class="nav-item">
                            @if (auth()->check())
                            <a class="nav-link" href="/saved-series" style="color:white;">Saved series</a>
                            @else
                            <a class="nav-link" href="/login" style="color:white;">Saved series</a>
                            @endif
                       </li>
                    </ul>

                  
                    <ul class="navbar-nav ms-auto">
                        
                   
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown" >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background-color: #4764A3;" >
                                    <a class="dropdown-item" href="{{ route('logout') }}" 
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" >
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
</body>
</html>
