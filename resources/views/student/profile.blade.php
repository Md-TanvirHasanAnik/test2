@extends ('student.app')

@section('content')

<link href="{{ URL::asset('css/profile.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                    {{--<div class="file-btn btn btn-lg btn-primary">--}}
                        {{--Change Photo--}}
                        {{--<input type="file" name="file"/>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">

                    <h3>
                        Kshiti Ghelani
                    </h3>

                </div>
            </div>
            <div class="col-md-2">
                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <p>SKILLS</p>
                    <a href="">Web Designer</a><br/>
                    <a href="">Web Developer</a><br/>
                    <a href="">WordPress</a><br/>
                    <a href="">WooCommerce</a><br/>
                    <a href="">PHP, .Net</a><br/>
                    <p>Portfolio</p>
                    <a href="">Website Link</a><br/>
                    <a href="">Bootsnipp Profile</a><br/>
                    <a href="">Bootply Profile</a>
                </div>
            </div>
            <div class="col-md-8 profile-info">
                <h4>Personal Information</h4>
                <hr>
                   <div class="row">
                        <div class="col-md-6">
                            <label>User Id</label>
                        </div>
                        <div class="col-md-6">
                            <p>Kshiti123</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                        </div>
                        <div class="col-md-6">
                            <p>Kshiti Ghelani</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Department</label>
                        </div>
                        <div class="col-md-6">
                            <p>CSE</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p>kshitighelani@gmail.com</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p>123 456 7890</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label>Your Bio</label><br/>
                            <p>Your detail description</p>
                    </div>
                    </div>
            </div>
        </div>
    </form>
</div>
@endsection
