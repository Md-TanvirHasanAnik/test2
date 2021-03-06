<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('styles')
    @stack('scripts')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DIU Advising') }}</title>

    <!-- Scripts -->
    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
     <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
            <div class="container">
                 <img src="/../images/app/logo.svg" style="width:72px; margin-right: 8px; ">
               
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'DIU Advising') }}
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
                        @if(Auth::guard()->guest()||!Auth::guard('student')->check())
                
                                
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Login <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                         <i class="fas fa-sign-in-alt"></i>
                                        {{ __('Login As Student') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('login.faculty') }}">
                                        <i class="fas fa-sign-in-alt"></i>
                                        {{ __('Login As Faculty Member') }}
                                    </a>
                                </div>

                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item dropdown">
                                    

                                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Register <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                         <a class="dropdown-item" href="{{ route('register') }}">
                                           <i class="fas fa-user-edit"></i>
                                            {{ __('Register As Student') }}
                                        </a>
                                         <a class="dropdown-item" href="{{ route('register.faculty') }}">
                                           <i class="fas fa-user-edit"></i>
                                            {{ __('Register As Faculty Member') }}
                                        </a>
                                    </div>

                                </li>
                            @endif
                        @else

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.home') }}">
                                     <i class="fas fa-home"></i>
                                {{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.appointments') }}">{{ __('Appointments') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.faculties') }}">{{ __('Faculty Member') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.profile') }}">{{ __('Profile') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} 
                                    <img src="{{ Auth::user()->photo }}" style="width:24px; height:24px;  border-radius:50%">
                                    
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                         <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
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
</body>
@include('footer')

</html>
