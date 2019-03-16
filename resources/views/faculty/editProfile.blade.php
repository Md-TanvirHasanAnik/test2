@extends ('faculty.app')

@section('content')

    <link href="{{ URL::asset('css/profile.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

    <div class="container emp-profile">
    <hr>
    <div class="row">
        <!-- left column -->
        <div class="col-md-4">
            <br>
            <div class="profile-img">
                <img  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                <div class="file-btn btn btn-lg btn-primary">
                    Change Photo
                    <input type="file" name="file"/>
                </div>
            </div>
        </div>

        <!-- edit form column -->
        <div class="col-md-8 personal-info">
            {{--<div class="alert alert-info alert-dismissable">--}}
                {{--<a class="panel-close close" data-dismiss="alert">×</a>--}}
                {{--<i class="fa fa-coffee"></i><strong></strong>--}}
            {{--</div>--}}

            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Employee ID</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="Jane">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">First name</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="Jane">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Last name</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="Bishop">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Faculty</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Department</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Designation</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="janesemail@gmail.com">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Phone</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="123456">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Bio</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" type="text" rows="7"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="button" class="btn btn-primary" value="Save Changes">
                        <span></span>
                        <input type="reset" class="btn btn-default" value="Cancel">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>

    @endsection
