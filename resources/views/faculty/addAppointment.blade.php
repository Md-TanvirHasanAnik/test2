
@extends('faculty.app')

@push('styles')
@endpush

@push('scripts')
@endpush

@section('content')
<link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
{{--Air Date--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="{{ asset('airdate/css/datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('mdtime/mdtimepicker.css') }}" rel="stylesheet">
<script src="{{ asset('airdate/js/datepicker.js') }}" defer></script>
<script src="{{ asset('mdtime/mdtimepicker.js') }}" defer></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <div class="container ">
    <div class="row ">
        <div class="col-md-10">

            {{--<div class="col-md-6 " style="float:right;">--}}
                {{--<label>Search Faculty</label>--}}
                {{--<input name="search" autocomplete="off" type="text" class="form-control " id="search" placeholder="Faculty Name" value="">--}}
                {{--<div id="facultyList">--}}
                {{--</div>--}}
            {{--</div>--}}

            @if(count($errors)>0)
                @foreach($errors as $error)
                    toastr.error('{{$error}}');
                @endforeach
            @endif

            <div class="card">
                <div class="card-header">Add Appointment</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div id="form" class="form-area" style="clear:right;">
                        <form  id="appointmentForm" method="post" autocomplete="off" accept-charset="utf-8">
                            @csrf
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
                                            <i class="far fa-calendar-alt"></i>
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Time Slot<i class="text-danger">*</i></label>
                                    <select  name="slot" class="form-control" id="slot">
                                        <option value="0" disabled="true" selected="true">Select Slot</option>
                                    </select>
                                    <p style="padding-left: 8px" class="help-block" id="available_slots"></p>
                                </div>

                                <div id="appointments-taken"></div>

                                <div class=" col-md-6" style="float: left">
                                <div class="form-group">
                                    <label>Starting Time<i class="text-danger">*</i></label>
                                   <div class="input-group">
                                       <div id="start_time_div">
                                    <input name="starts_at" autocomplete="off" type="text" class="form-control" id="starts_at" placeholder="Time" >
                                       </div>
                                    <div class="input-group-addon">
                                        <span><i class="far fa-clock"></i></span>
                                    </div>
                                   </div>
                                </div>
                                </div>

                                <div class=" col-md-6 " style="float: right">
                                <div class="form-group">
                                    <label>Ending Time<i class="text-danger">*</i></label>
                                    <div class="input-group">
                                        <div id="end_time_div">
                                        <input name="ends_at" autocomplete="off" type="text" class="form-control" id="ends_at" placeholder="Time" >
                                        </div>
                                            <div class="input-group-addon">
                                            <span><i class="far fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                                </div>


                                <div class="form-group">
                                    <label>Problem </label>
                                    <textarea name="message" class="form-control" placeholder="message"  rows="7"></textarea>
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
                url:'{{route('appointment.findFaculty')}}',
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

    var date="";

    $(document).ready(function(){
        //air datepicker
        $( '#datepicker' ).datepicker({
            dateFormat: 'yyyy/mm/dd',
            autoClose:'true',
            onSelect: function() {
                 date=$('#datepicker').val();
                console.log(date);

                $.ajax({
                    type:'get',
                    url:'{{route('appointment.findSlots')}}',
                    data:{'f_id':facultyId,'date':date},
                    success:function(data){
                        console.log(data);
                        console.log(data.length);

                        if (data.length>0) {
                            $('#available_slots').html(data.length + " Slots available");
                        }
                        else
                            $('#available_slots').html("");


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

    {{--get appointments--}}
    <script type="text/javascript">
        var slot="";

        $(document).ready(function(){
            $("select#slot").change(function(){
                slot = $(this).children("option:selected").val();
                // alert("You have selected the faculty - " + facultyId);
                console.log(slot);

                $.ajax({
                    type:'get',
                    url:'{{route('appointment.findAppointments')}}',
                    data:{'f_id':facultyId,'date':date,'slot':slot},
                    success:function(data){
                        console.log(data);
                        console.log(data.length);

                        if (data.length>0) {
                            // Add the empty option with the empty message
                            var  p='<p>Appointments taken at '+slot+'</p>';

                            // Loop through each of the results and append the option to the dropdown
                            for(var i=0;i<data.length;i++){
                                p+='<li>'+data[i].starts_at+' - '+data[i].ends_at+'</li>';
                            }

                            $('#appointments-taken').html(" ");
                            $('#appointments-taken').append('<hr><ul>');
                            //append all options
                            $('#appointments-taken').append(p);
                            $('#appointments-taken').append('</ul><hr>');
                        }
                        else {
                            var  EmptyP='<p>No Appointments taken at '+slot+'</p>';

                            $('#appointments-taken').html(" ");
                            $('#appointments-taken').append('<hr>');
                            //append all options
                            $('#appointments-taken').append(EmptyP);
                            $('#appointments-taken').append('<hr>');

                        }

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

    {{--time picker--}}
<script type="text/javascript">
    $(document).ready(function() {

     /*   $('#slot').change(function() {
            //   $('#starts_at').val($('#slot option:selected').val());
            //  $('#ends_at').val($('#slot option:selected').val());
            var time=$('#slot option:selected').val();
            var input='<input name="ends_at" autocomplete="off" type="text" class="form-control" id="ends_at"  value="'+time+'">';
            $('#end_time_div').html(" ");
            $('#end_time_div').html(input);
        });
        */


    $('#starts_at').mdtimepicker({
            readOnly: false,
        }).on('timechanged', function (e) {
            console.log(e.value);
            console.log(e.time);
        });

        $('#ends_at').mdtimepicker({
            readOnly: false,
        }).on('timechanged', function (e) {
            console.log(e.value);
            console.log(e.time);
        });
    });
</script>

{{--submit--}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#appointmentForm').on('submit',function(event){

            event.preventDefault();
            var data=$(this).serialize();


            $.ajax({
                method:'POST',
                url:'{{route('appointment.store')}}',
                data:data,
                success:function(data){
                    console.log(data);
                    console.log(data.length);

                    if (data.type==="success"){
                        toastr.success(data.message);

                        $('#appointmentForm')[0].reset();

                        $('#appointments-taken').html("");
                        $('#available_slots').html("");

                        $('#starts_at').val("");
                        $('#ends_at').val("");
                    }
                    if (data.type==="error"){
                        toastr.error(data.message);
                    }
                    if (data.type==="warning"){
                        toastr.warning(data.message);
                    }


                },
                error:function(){

                }
            });
        });
    });
</script>


{{--searching faculty--}}
<script type="text/javascript">
    $(document).ready(function(){

        $('#search').keyup(function(){
            var query = $(this).val().trim();
            if(query!='')
            {
                // var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('appointment.searchFaculty') }}",
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

