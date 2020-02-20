@if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Login<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Login as Student') }}
                                    </a>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Login as Teacher') }}
                                    </a>
                                </div>
                            </li>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif




{{--<div class="row justify-content-between">--}}
<!-- search by faculty (draft) -->
<div class="col-md-4 ">
    <p>Current Semester: {{$current_semester->current_semester}}</p>
</div>
<br>
<div class=" col-md-4">
    <select class="form-control" id="type">
        <option value="all" selected>Select Schedule Type</option>
        <option value="cse">Regular</option>
        <option value="cse">Ramadan</option>
    </select>
</div>
<br>
{{--</div>--}}

<div class="col-md-4 align-items-center" >
    @for($i=0;$i<count($slots);$i++)

        <span>Slot {{$i+1}}: </span><input class="form-control" value="{{$slots[$i]->slot}}">
        <br>
    @endfor
</div>
