@extends ('faculty.app')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="{{ URL::asset('css/profile.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img  src="{{$faculty->photo}}" alt=""/>
                    {{--<div class="file-btn btn btn-lg btn-primary">--}}
                    {{--Change Photo--}}
                    {{--<input type="file" name="file"/>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">

                    <h3>
                        {{$faculty->name}}
                    </h3>

                </div>
            </div>
            @if(Session::get('visitor')!='guest')
                <div class="col-md-2">
                    <button id="edit-btn" class="profile-edit-btn" >Edit Profile</button>
                </div>
            @endif
        </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        
                        <p>Research Interests</p>
                         <ul>
                        <?php $research_areas=explode(',',$faculty->research_area) ?>

                        @foreach($research_areas as $research_area)
                        <li>{{$research_area}}</li>
                        @endforeach
                        </ul>
                        <p>Portfolio</p>
                        <a href="{{$faculty->portfolio}}">Portfolio Website</a><br/>

                    </div>
                </div>
                <div class="col-md-8 profile-info">
                    <h4>Personal Information</h4>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Employee ID</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$faculty->f_id}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$faculty->name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Department</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$faculty->department}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Faculty</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$faculty->faculty}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Designation</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$faculty->designation}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$faculty->email}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$faculty->phone}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label>Bio</label><br/>
                            <p>{{$faculty->bio}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">

        $(document).ready(function(){

            $("#edit-btn").click(function(){
                window.location.href = "{{route('faculty.editProfileForm')}}";
            });
        });

    </script>
@endsection
