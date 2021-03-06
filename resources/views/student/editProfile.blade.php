@extends ('student.app')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="{{ URL::asset('css/profile.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <div class="container emp-profile">
    <hr>

        @if (Session::get('success'))

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>
                {{ Session::get('success') }}
            </div>

        @elseif (Session::get('error'))

            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>
                {{ Session::get('error') }}
            </div>

        @endif

    <form action="{{route('student.editProfile')}}" method="post" id="editForm" enctype="multipart/form-data">
            @csrf
    <div class="row">
        <!-- left column -->
        <div class="col-md-4">
            <br>
            <div class="form-group">
            <div class="profile-img">
                <img id="photo"  src="{{$student->photo}}" alt=""/>
                <div class="file-btn btn btn-lg btn-primary">
                    Change Photo
                    <input type="file" name="image" class="form-control"/>
                </div>
            </div>
            </div>
        </div>

        <!-- edit form column -->
        <div class="col-md-4 personal-info">
            {{--<div class="alert alert-info alert-dismissable">--}}
                {{--<a class="panel-close close" data-dismiss="alert">×</a>--}}
                {{--<i class="fa fa-coffee"></i><strong></strong>--}}
            {{--</div>--}}
            <h4>Update Personal Information</h4>
            <hr>

                <div class="form-group">
                    <label class="col control-label">Student ID</label>
                    <div class="col">
                        <input class="form-control" type="text" name="s_id" value="{{$student->s_id}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col control-label">Name</label>
                    <div class="col">
                        <input class="form-control" type="text" name="name" value="{{$student->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label">Department</label>
                    <div class="col">
                        <input class="form-control" type="text" name="department" value="{{$student->department}}">
                    </div>
                </div>

            <div class="form-group">
                <label class="col control-label">Level-Term</label>
                <div class="col">
                    <input class="form-control" type="text" name="level_term" value="{{$student->level_term}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col control-label">Campus</label>
                <div class="col">
                    <input class="form-control" type="text" name="campus" value="{{$student->campus}}">
                </div>
            </div>

                <div class="form-group">
                    <label class="col control-label">Email</label>
                    <div class="col">
                        <input class="form-control" type="text" name="email" value="{{$student->email}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col control-label">Phone</label>
                    <div class="col">
                        <input class="form-control" type="text" name="phone" value="{{$student->phone}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label">Bio</label>
                    <div class="col">
                        <textarea class="form-control" type="text" name="bio" rows="5">{{$student->bio}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label"></label>
                    <div class="col">
                        <input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
                        <span></span>
                        {{--<input type="reset" class="btn btn-default" value="Clear">--}}
                    </div>
                </div>

        </div>
        
         <!-- edit form column -->
        <div class="col-md-4">
            <br><hr>
              <div class="form-group">
                    <label class="col control-label">Skills ( seperate with comma ',' )</label>
                    <div class="col">
                        <input class="form-control" type="text" name="skills" value="{{$student->skills}}">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col control-label">Portfolio Site ( with https:// )</label>
                    <div class="col">
                        <input class="form-control" type="text" name="portfolio" value="{{$student->portfolio}}">
                    </div>
                </div>
        </div>


    </div>
    </form>
</div>
<hr>


    {{--submit--}}
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function(){--}}
            {{--$('#editForm').on('submit',function(event){--}}

                {{--event.preventDefault();--}}
                {{--var data=$(this).serialize();--}}
                {{--console.log(data);--}}

                {{--$.ajax({--}}
                    {{--method:'POST',--}}
                    {{--url:'{{route('student.editProfile')}}',--}}
                    {{--data:data,--}}

                    {{--success:function(data){--}}
                        {{--console.log(data);--}}
                        {{--console.log(data.length);--}}

                        {{--if (data.type==="success"){--}}
                            {{--toastr.success(data.message);--}}

                            {{--$('#photo').attr("src",data.image_src);--}}

                        {{--}--}}
                        {{--if (data.type==="error"){--}}
                            {{--toastr.error(data.message);--}}
                        {{--}--}}


                    {{--},--}}
                    {{--error:function(){--}}

                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}


@endsection
