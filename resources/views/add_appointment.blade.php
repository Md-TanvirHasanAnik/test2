
@extends('layouts.app')

@push('styles')
@endpush

@push('scripts')
@endpush

@section('content')

    {{--Air Date--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="{{ asset('airdate/css/datepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('airdate/js/datepicker.js') }}" defer></script>

        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="col-md-6 " style="float:right;">
                    <label>Search Faculty</label>
                    <input name="search" autocomplete="off" type="text" class="form-control " id="search" placeholder="Faculty Name" value="">
                    <div id="facultyList">
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Add Appointment</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div id="form" class="form-area" style="clear:right;">
                            <form action="#" id="appointmentForm" method="post" accept-charset="utf-8">
                                <input type="hidden" name="csrf_stream_token" value="447a6832bb22061e6b48ae857b7bf5c8" />

                                <div class="form-padding" >
                                    <div class="form-group">
                                        <label>Department Name <i class="text-danger">*</i></label>
                                        <select name="department" class="form-control" id="department" >
                                            <option value="" selected="selected" disabled>Select Department</option>
                                            <option value="cse">CSE</option>
                                            <option value="swe">SWE</option>
                                            <option value="eee">EEE</option>
                                            <option value="bba">BBA</option>
                                            <option value="textile">Textile</option>
                                            <option value="llb">LLB</option>
                                            <option value="pharmacy">Pharmacy</option>
                                            <option value="nfe">NFE</option>
                                        </select>
                                        <span class="doctor_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Faculty Name<i class="text-danger">*</i></label>

                                        <select  name="faculty" class="form-control" id="faculty">

                                            <option value="0" disabled="true" selected="true">Select Faculty</option>
                                            {{--@foreach($prod as $cat)--}}
                                            {{--<option value="{{$cat->id}}">{{$cat->product_cat_name}}</option>--}}
                                            {{--@endforeach--}}

                                        </select>


                                        <p class="help-block" id="available_days"></p>
                                    </div>

                                    <div class="form-group">
                                        <label>Appointment Date <i class="text-danger">*</i></label>
                                        <div  class="input-group" >
                                            <input  type="text" id="datepicker" name="date" class="form-control"   placeholder="dd/mm/yyyy">
                                            {{--<input  type="text" id="datepicker" data-provide="datepicker" name="date" class="form-control datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" value=""  placeholder="dd-mm-yyyy">--}}
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Time Slot<i class="text-danger">*</i></label>
                                        <select  name="slot" class="form-control" id="slot">
                                            <option value="0" disabled="true" selected="true">Select Slot</option>
                                        </select>
                                        <p class="help-block" id="available_days"></p>
                                    </div>

                                    <div class="form-group">
                                        <label>Select Time<i class="text-danger">*</i></label>
                                        <input name="time_id" autocomplete="off" type="text" class="form-control" id="patient_id" placeholder="Time" value="">
                                        <span></span>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="schedule_id" id="schedule_id"/>
                                        <input type="hidden" name="serial_no" id="serial_no"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Problem </label>
                                        <textarea name="problem" class="form-control" placeholder="Problem"  rows="7"></textarea>
                                    </div>

                                </div>

                                <div class="form-footer">
                                    <div class="checkbox">
                                        <label></label>
                                    </div>
                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{--finding faculty for dept--}}
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','#department',function(){
                var dept=$(this).val();
                console.log(dept);
                var parent=$(this).parent().parent();

                //   var op=" ";

                $.ajax({
                    type:'get',
                    url:'{{route('faculty.find')}}',
                    data:{'dept':dept},
                    success:function(data){
                        console.log(data);
                        console.log(data.length);

                        // Add the empty option with the empty message
                        var  op='<option value="0" selected disabled>Select Faculty</option>';

                        // Loop through each of the results and append the option to the dropdown
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].f_id+'">'+data[i].name+'</option>';
                        }
                        //// Remove current options
                        parent.find('#faculty').html(" ");

                        //append all options
                        parent.find('#faculty').append(op);
                    },
                    error:function(){

                    }
                });
            });
        });
    </script>


    {{--get selected faculty--}}
    <script type="text/javascript">
        var facultyId="";

        $(document).ready(function(){
            $("select#faculty").change(function(){
                facultyId = $(this).children("option:selected").val();

               // alert("You have selected the faculty - " + facultyId);

                console.log(facultyId)
            });
        });
    </script>

    {{--finding slots for date--}}
    <script type="text/javascript">
        $(document).ready(function(){

            //air datepicker
            $( '#datepicker' ).datepicker({
                dateFormat: 'yyyy/mm/dd',
                autoClose:'true',
                onSelect: function() {
                    var date=$('#datepicker').val();
                    console.log(date);



                    $.ajax({
                        type:'get',
                        url:'{{route('faculty.slots')}}',
                        data:{'f_id':facultyId,'date':date},
                        success:function(data){
                            console.log(data);
                            console.log(data.length);

                            // Add the empty option with the empty message
                            var  op='<option value="0" selected disabled>Select Time</option>';

                            // Loop through each of the results and append the option to the dropdown
                            for(var i=0;i<data.length;i++){
                                op+='<option value="'+data[i].slot+'">'+data[i].slot+'</option>';
                            }
                            //// Remove current options
                            $('#slot').html(" ");

                            //append all options
                            $('#slot').append(op);
                        },
                        error:function(){

                        }
                    });
                }
            });
        });
    </script>

    {{--searching faculty--}}
    <script>
        $(document).ready(function(){

            $('#search').keyup(function(){
                var query = $(this).val().trim();
                if(query!='')
                {
                    // var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('faculty.search') }}",
                        type:'get',
                        data:{query:query},
                        // data:{query:query, _token:_token},
                        success:function(data){

                            console.log(data.length+" "+query+" "+data)

                            if (data.length>0) {
                                $('#facultyList').fadeIn();
                                $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                                for (var i = 0; i < data.length; i++) {
                                    $output += '<li style="cursor: pointer;padding:4px 8px 4px 8px;"> ' + data[i].name + '</li>';
                                }
                                $output += '</ul>'

                                $('#facultyList').html($output);
                            }
                            else {
                                $('#facultyList').fadeOut();
                            }
                        }
                    });
                }
                else{
                    $('#facultyList').fadeOut();
                }
            });

            $(document).on('click', 'li', function(){
                $('#search').val($(this).text());
                $('#facultyList').fadeOut();
            });

        });
    </script>


@endsection

