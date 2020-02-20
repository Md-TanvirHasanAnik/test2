@extends('admin.app')

@section('content')

    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="{{ asset('airdate/css/datepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('airdate/js/datepicker.js') }}" defer></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <body>

        <div class="card full-height">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <br><br>

                <div class="row col-md-12">
                        <br><br>
                    <div class="col-md-6 float-left">
                        <div class="card">
                            <div class="card-header">
                                Add Semester
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <form  id="addSemesterForm" {{--action="{{ route('admin.addSemester')}}"--}} method="post" autocomplete="off" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-padding" >

                                        <div class="form-group">
                                            <label>Semester <i class="text-danger">*</i></label>
                                            <div  class="input-group" >
                                                <input  type="text" id="semester" name="semester" class="form-control"   placeholder="Semester">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Starts From <i class="text-danger">*</i></label>
                                            <div  class="input-group" >
                                                <input  type="text"  name="starts_at" class="starts_at form-control"   placeholder="yyyy-mm-dd">
                                                {{--<input  type="text" id="datepicker" data-provide="datepicker" name="date" class="form-control datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" value=""  placeholder="dd-mm-yyyy">--}}
                                                <div class="input-group-append">
                                                    <i class="input-group-text far fa-calendar-alt"></i>
                                                    {{--<span class="input-group-text glyphicon glyphicon-calendar" aria-hidden="true"></span>--}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Ends At <i class="text-danger">*</i></label>
                                            <div  class="input-group" >
                                                <input  type="text"  name="ends_at" class="ends_at form-control"   placeholder="yyyy-mm-dd">
                                                {{--<input  type="text" id="datepicker" data-provide="datepicker" name="date" class="form-control datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" value=""  placeholder="dd-mm-yyyy">--}}
                                                <div class="input-group-append">
                                                    <i class="input-group-text far fa-calendar-alt"></i>
                                                    {{--<span class="input-group-text glyphicon glyphicon-calendar" aria-hidden="true"></span>--}}
                                                </div>
                                            </div>
                                        </div>

                                        <br><br>

                                        <div class="form-footer">
                                            <button type="submit" id="submit" class="btn btn-primary">ADD</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                        <br><br>
                    </div>


                    <div class="col-md-6 float-right">
                        <div class="card">
                            <div class="card-header">
                                Update Current Semester
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <p>Current Semester: {{$current_semester->current_semester}}</p>

                                <form  id="updateSemesterForm" {{--action="{{ route('admin.updateSemester') }}"--}} method="post" autocomplete="off" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-padding" >

                                        <div class="form-group">

                                            <label>Semester <i class="text-danger">*</i></label>
                                            <div  class="input-group" >
                                                <select  name="current_semester" class="form-control" id="current_semester">
                                                    <option value="0" disabled="true" selected="true">Select Current Semester</option>
                                                @foreach($semesters as $semester)
                                                    {{--@if($semester->semester==$current_semester->current_semester)--}}
                                                    {{--<option value="{{$semester->semester}}" selected="selected">{{$semester->semester}}</option>--}}
                                                    {{--@else--}}
                                                            <option value="{{$semester->id}}" >{{$semester->semester}}</option>

                                                    {{--@endif--}}
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Starts From <i class="text-danger">*</i></label>
                                            <div  class="input-group" >
                                                <input  type="text" id="starts_at_update"  name="starts_at" class="starts_at form-control"   placeholder="yyyy-mm-dd">
                                                {{--<input  type="text" id="datepicker" data-provide="datepicker" name="date" class="form-control datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" value=""  placeholder="dd-mm-yyyy">--}}
                                                <div class="input-group-append">
                                                    <i class="input-group-text far fa-calendar-alt"></i>
                                                    {{--<span class="input-group-text glyphicon glyphicon-calendar" aria-hidden="true"></span>--}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Ends At <i class="text-danger">*</i></label>
                                            <div  class="input-group" >
                                                <input  type="text" id="ends_at_update"  name="ends_at" class="ends_at form-control"   placeholder="yyyy-mm-dd">
                                                {{--<input  type="text" id="datepicker" data-provide="datepicker" name="date" class="form-control datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" value=""  placeholder="dd-mm-yyyy">--}}
                                                <div class="input-group-append">
                                                    <i class="input-group-text far fa-calendar-alt"></i>
                                                    {{--<span class="input-group-text glyphicon glyphicon-calendar" aria-hidden="true"></span>--}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" id="submit" class="btn btn-primary">UPDATE</button>
                                        </div>

                                    </div>
                                </form>


                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->

                    </div>
                    <br><br>
                </div><!-- /.row -->
            </div>
    <br><br>
    </body>

    {{--finding slots for date--}}
    <script type="text/javascript">


        $(document).ready(function(){
            //air datepicker
            $( '.starts_at' ).datepicker({
                dateFormat: 'yyyy-mm-dd',
                autoClose:'true',
                minDate: new Date(),
                onSelect: function() {
                    date=$('.starts_at').val();
                    console.log(date);

                }
            });

            $( '.ends_at' ).datepicker({
                dateFormat: 'yyyy-mm-dd',
                autoClose:'true',
                minDate: new Date(),
                onSelect: function() {
                    date=$('.ends_at').val();
                    console.log(date);

                }
            });
        });
    </script>

    {{--get appointments--}}
    <script type="text/javascript">
        var current_semester="";
        var id="";

        $(document).ready(function(){
            $("select#current_semester").change(function(){
                id = $(this).children("option:selected").val();
                current_semester = $(this).children("option:selected").text();
                // alert("You have selected the faculty - " + facultyId);
                console.log(current_semester);

                $.ajax({
                    type:'get',
                    url:'{{route('admin.getDates')}}',
                    data:{'id':id},
                    success:function(data){
                        console.log(data);
                        console.log(data.length);



                            $('#starts_at_update').val(data.starts_at);

                            //append all options
                            $('#ends_at_update').val(data.ends_at);



                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

    {{--submit--}}
    <script type="text/javascript">
        $(document).ready(function(){

            $('#addSemesterForm').on('submit',function(event){

                event.preventDefault();
                toastr.success("Semester Added Successfully");



            });

            $('#updateSemesterForm').on('submit',function(event){

                event.preventDefault();
                toastr.success("Semester Updated Successfully");

            });
        });
    </script>

@endsection

