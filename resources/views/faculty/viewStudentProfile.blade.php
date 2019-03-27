@extends ('faculty.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="{{ URL::asset('css/profile.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

<div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img  src="{{$student->photo}}" alt=""/>
                    {{--<div class="file-btn btn btn-lg btn-primary">--}}
                        {{--Change Photo--}}
                        {{--<input type="file" name="file"/>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">

                    <h3>
                        {{$student->name}}
                    </h3>

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <p>SKILLS</p>
                    <ul>
                        <li>Web Designer</li>
                        <li>Web Developer</li>
                        <li>WordPress</li>
                        <li>WooCommerce</li>
                        <li>PHP, .Net</li>
                    </ul>
                    <p>Portfolio</p>
                    <a href="">Website Link</a><br/>
                </div>
            </div>
            <div class="col-md-8 profile-info">
                <h4>Personal Information</h4>
                <hr>
                   <div class="row">
                        <div class="col-md-6">
                            <label>Student Id</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$student->s_id}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$student->name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Department</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$student->department}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$student->email}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{$student->phone}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label>Bio</label><br/>
                            <p>{{$student->bio}}</p>
                    </div>
                    </div>
            </div>
        </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){

        $("#edit-btn").click(function(){
            window.location.href = "{{route('student.editProfileForm')}}";
        });
        });

        </script>
@endsection
