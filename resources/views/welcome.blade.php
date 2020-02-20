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

 <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
    <!-- Scripts -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('js/slippry.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slippry.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <img src="images/app/logo.svg" style="width:72px; margin-right: 8px; ">
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
                        @if(Auth::guard()->guest())

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
                            @if(Auth::guard('student')->check()&&!Auth::guard('faculty')->check())

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
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="{{ Auth::user()->photo }}" style="width:30px; height:30px;  border-radius:50%">
                                        {{ Auth::user()->name }} 
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endif
                            @if(Auth::guard('faculty')->check()&&!Auth::guard('student')->check())

                                <li class="nav-item ">
                                <a class="nav-link " href="{{ route('faculty.home') }}">
                                     <i class="fas fa-home"></i>
                                {{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('faculty.appointments') }}">{{ __('Appointments') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('faculty.schedule') }}">{{ __('Counselling Hour') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('faculty.profile') }}">{{ __('Profile') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     <img src="{{ Auth::user()->photo }}" style="width:30px; height:30px;  border-radius:50%">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout.faculty') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout.faculty') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div>
            <ul id="slippry-demo">
             <li>
                <a href="#slide2"><img src="/images/slider/map.png"  alt="Country is in heart <span class='color-red'>♥</span>"></a>
              </li>
              <li>
                <a href="#slide1"><img src="/images/slider/students.png" alt="Learning with enjoyments!"></a>
              </li>
              <li>
                <a href="#slide2"><img src="/images/slider/landscape.png"  alt="Piece of green World"></a>
              </li>
              <li>
                <a href="#slide3"><img src="/images/slider/transport.png" alt="DIU Green Buses <span class='color-red'>♥</span>"></a>
              </li>
            </ul>
        </div>

    <section class="section">
    <div class="container">
        <div class="title">
            <h2>Useful Links</h2>
            <hr align="center" width="10%">
        </div>
       
        <div class="row">
            <div class="col-md-12">
                <div class="">
                  <ul class="links">
                    <li><a href="http://studentportal.diu.edu.bd/#/login" target="_blank"><img src="images/app/portal.png" alt="img"></a>
                    <p>Student Portal</p></li>
                    <li><a href="https://elearn.daffodil.university/" target="_blank"><img src="images/app/learning.png" alt="img"></a>
                    <p>Learning Portal</p></li>
                    <li><a href="https://daffodilvarsity.edu.bd/noticeboard" target="_blank"><img src="images/app/notification.png" alt="img"></a>
                    <p>Notice Board</p></li>
                    <li><a href="https://daffodilvarsity.edu.bd/academic_calendar/" target="_blank"><img src="images/app/calendar.png" alt="img"></a>
                    <p>Academic Calender</p></li>
                    <li><a href="http://library.daffodilvarsity.edu.bd/" target="_blank"><img src="images/app/library.png" alt="img"></a>
                    <p>Library</p></li>
                    <li><a href="https://daffodilvarsity.edu.bd/article/coordination-offices"><img src="images/app/coordinator.png" alt="img"></a>
                    <p>Coordination Officer</p></li>
                    <li><a href="https://daffodilvarsity.edu.bd/scholarship/diu-scholarship"><img src="images/app/scholarship.png" alt="img"></a>
                    <p>Scholarship</p></li>
                    <li><a href="http://talenthunt.daffodilvarsity.edu.bd/?app=home" target="_blank"><img src="images/app/user.png" alt="img"></a>
                    <p>Talent hunt</p></li>
                    </ul>
                </div>
            
            </div>
        </div>
        <!--   end row   -->
    </div>
    <!--   end container   -->
</section>



        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('footer')
</body>

<script type="text/javascript">
    $(document).ready(function(){
    $('#slippry-demo').slippry();
});
</script>

</html>
