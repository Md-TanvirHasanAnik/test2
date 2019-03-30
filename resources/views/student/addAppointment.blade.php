
    @extends('student.app')

    @push('styles')
    @endpush

    @push('scripts')
    @endpush

    @section('content')
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
    {{--Air Date--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="{{ asset('airdate/css/datepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('airdate/js/datepicker.js') }}" defer></script>

    <link href="{{ asset('clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('clockpicker/bootstrap-clockpicker.min.js') }}" defer></script>
    <script src="http://www.htmldrive.net/edit_media/2014/201405/clockpicker-master/dist/jquery-clockpicker.min.js" defer></script>



    <link href="{{ asset('mdtime/mdtimepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('mdtime/mdtimepicker.js') }}" defer></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{--for time format--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>


<div class="container">

    <div class="card col-md-12">

        <div class="row">
            <div class="col-md-6">
                <br>
                <br>

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
                                            <option value="llb">LAW</option>
                                            <option value="pharmacy">Pharmacy</option>
                                            <option value="nfe">NFE</option>
                                        </select>
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
                                            <input  type="text" id="datepicker" name="date" class="form-control"   placeholder="yyyy-mm-dd">
                                            {{--<input  type="text" id="datepicker" data-provide="datepicker" name="date" class="form-control datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" value=""  placeholder="dd-mm-yyyy">--}}
                                            <div class="input-group-append">
                                                <i class="input-group-text far fa-calendar-alt"></i>
                                                {{--<span class="input-group-text glyphicon glyphicon-calendar" aria-hidden="true"></span>--}}
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


                                    <div style="margin:0 -15px 0 -15px">
                                    <div class="col-md-6" style="float: left">
                                    <div class="form-group">
                                        <label>Starting Time<i class="text-danger">*</i></label>
                                       <div class="input-group" id="start_time_div">
                                        <input name="starts_at" autocomplete="off" type="text" class="form-control" id="starts_at" placeholder="Time" >
                                               <div class="input-group-append">
                                                   <i class="input-group-text far fa-clock"></i>
                                               </div>
                                       </div>
                                    </div>
                                    </div>

                                    <div class="col-md-6"  style="float: right">
                                    <div class="form-group">
                                        <label>Ending Time<i class="text-danger">*</i></label>
                                        <div class="input-group" id="end_time_div">
                                            <input name="ends_at" autocomplete="off" type="text" class="form-control" id="ends_at" placeholder="Time" >
                                            <div class="input-group-append">
                                                <i class="input-group-text far fa-clock"></i>
                                            </div>
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
                {{--end div col-6--}}


            <div class="col-md-6">
                    <br>
                    <br>

                <div class="text-center"><h4>Have a good day!</h4></div>

                <div class="card" id="scheduleTable">
                    <div id="scheduleTableHeader">Have a good day!</div>
                    <div class="card-body table-responsive-md p-0">
                        <table class="table table-striped schedule-info-table">
                            <thead>
                                <tr class="well">
                                    <th scope="col">Time</th>
                                    <th scope="col">SAT</th>
                                    <th scope="col">SUN</th>
                                    <th scope="col">MON</th>
                                    <th scope="col">TUE</th>
                                    <th scope="col">WED</th>
                                    <th scope="col">THU</th>
                                    <th scope="col">FRI</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">

                            {{--schedule table goes here--}}

                            </tbody>
                        </table>
                    </div>
                </div>

                <br>

                <div id="appointments-taken"></div>

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
                    url:'{{route('ajax.findFaculty')}}',
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


    {{--get schedule for selected faculty--}}
    <script type="text/javascript">

        $('#scheduleTable').hide();

        var facultyId="";
        var facultyName="";

        $(document).ready(function(){
            $("select#faculty").change(function(){
                facultyId = $(this).children("option:selected").val();
                facultyName = $(this).children("option:selected").text();
               // alert("You have selected the faculty - " + facultyId);
                console.log(facultyId);

                $.ajax({
                    type:'get',
                    url:'{{route('ajax.findSchedule')}}',
                    data:{'f_id':facultyId},
                    success:function(schedules){
                        console.log(schedules);
                        console.log(schedules.length);

                        var tr= "";

                        if (schedules.length>0) {
                            for(var i=0;i<schedules.length;i++){
                                var slotInMillis=moment(schedules[i].slot,'hh:mm A').add(90,'m');
                                var slotTo=moment(slotInMillis).format('hh:mm A');

                                tr+= "<tr>";
                                tr+="<td>"+schedules[i].slot+"-"+slotTo+"</td>";

                                if (schedules[i].sat==='on'){
                                    tr+="<td><i class='fas fa-check color-green'></td>";
                                }
                                else{
                                    tr+="<td><i class='fa fa-times color-red'></td>";
                                }
                                if (schedules[i].sun==='on'){
                                    tr+="<td><i class='fas fa-check color-green'></td>";
                                }
                                else{
                                    tr+="<td><i class='fa fa-times color-red'></td>";
                                }
                                if (schedules[i].mon==='on'){
                                    tr+="<td><i class='fas fa-check color-green'></td>";
                                }
                                else{
                                    tr+="<td><i class='fa fa-times color-red'></td>";
                                }
                                if (schedules[i].tue==='on'){
                                    tr+="<td><i class='fas fa-check color-green'></td>";
                                }
                                else{
                                    tr+="<td><i class='fa fa-times color-red'></td>";
                                }
                                if (schedules[i].wed==='on'){
                                    tr+="<td><i class='fas fa-check color-green'></td>";
                                }
                                else{
                                    tr+="<td><i class='fa fa-times color-red'></td>";
                                }
                                if (schedules[i].thu==='on'){
                                    tr+="<td><i class='fas fa-check color-green'></td>";
                                }
                                else{
                                    tr+="<td><i class='fa fa-times color-red'></td>";
                                }
                                if (schedules[i].fri==='on'){
                                    tr+="<td><i class='fas fa-check color-green'></td>";
                                }
                                else{
                                    tr+="<td><i class='fa fa-times color-red'></td>";
                                }

                                 tr+= "</tr>";

                            }

                            $('#scheduleTable').show();
                            $('#scheduleTableHeader').html("");
                            $('#scheduleTableHeader').append("<p style='margin: 8px;'>Counselling hour of "+facultyName+"</p>");

                            $('#tableBody').html(" ");
                            $('#tableBody').append(tr);

                        }
                        else {
                            $('#scheduleTable').hide();
                        }

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

    {{--finding slots for date--}}
    <script type="text/javascript">

        var date="";

        $(document).ready(function(){
            //air datepicker
            $( '#datepicker' ).datepicker({
                dateFormat: 'yyyy-mm-dd',
                autoClose:'true',
                minDate: new Date(),
                onSelect: function() {
                     date=$('#datepicker').val();
                    console.log(date);

                    $.ajax({
                        type:'get',
                        url:'{{route('ajax.findSlots')}}',
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
                            var  op='<option value="0" selected disabled>Select Slot</option>';

                            // Loop through each of the results and append the option to the dropdown
                            for(var i=0;i<data.length;i++){
                                //get the minutes to add from class/slot duration
                                var slotInMillis=moment(data[i].slot,'hh:mm A').add(90,'m');
                                var slotTo=moment(slotInMillis).format('hh:mm A');
                                console.log(slotTo);

                                op+='<option value="'+data[i].slot+'">'+data[i].slot+' - '+slotTo+'</option>';
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
            var slotTo="";

            $(document).ready(function(){
                $("select#slot").change(function(){
                    slot = $(this).children("option:selected").val();
                    // alert("You have selected the faculty - " + facultyId);
                    console.log(slot);

                    $.ajax({
                        type:'get',
                        url:'{{route('ajax.findAppointments')}}',
                        data:{'f_id':facultyId,'date':date,'slot':slot},
                        success:function(data){
                            console.log(data);
                            console.log(data.length);

                            //get the minutes to add from class/slot duration
                            var slotInMillis=moment(slot,'hh:mm A').add(90,'m');
                            slotTo=moment(slotInMillis).format('hh:mm A');
                            console.log(slotTo);

                            if (data.length>0) {
                                // Add the empty option with the empty message

                                // var hour=slot.split(":")[0];
                                // var minuteWithAmPm=slot.split(":")[1];
                                // var minute=minuteWithAmPm.split(" ")[0];
                                // var tempDate = new Date();
                                // tempDate.setHours(hour,minute,0);
                                // tempDate.setMinutes(tempDate.getMinutes() + 90);
                                // var slotTo=tempDate.getHours()+":"+tempDate.getMinutes();

                                var  p='<p >Appointments taken at slot '+slot+' - '+slotTo+'</p>';

                                // Loop through each of the results and append the option to the dropdown
                                for(var i=0;i<data.length;i++){
                                    p+='<li class="color-red" style="margin-left: 16px;">'+moment(data[i].starts_at,'hh:m:ss').format('hh:mm A')+' - '+moment(data[i].ends_at,'hh:m:ss').format('hh:mm A')+'</li>';
                                }

                                $('#appointments-taken').html(" ");
                                $('#appointments-taken').append('<hr><ul>');
                                //append all options
                                $('#appointments-taken').append(p);
                                $('#appointments-taken').append('</ul><hr>');
                            }
                            else {

                                var  EmptyP='<p>No Appointments taken at slot '+slot+' - '+slotTo+'</p>';

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

        var starts="";
        var ends="";

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
                hourPadding: true,
            }).on('timechanged', function (e) {
                console.log(e.value);
                console.log(e.time);

                starts=e.value;
            });

            $('#ends_at').mdtimepicker({
                readOnly: false,
                hourPadding: true,
            }).on('timechanged', function (e) {
                console.log(e.value);
                console.log(e.time);

                ends=e.value;
            });
        });
    </script>

    {{--submit--}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#appointmentForm').on('submit',function(event){

                event.preventDefault();
                var data=$(this).serialize();

                console.log("times"+slot+" "+slotTo+" "+starts+" "+ends);

                var format = 'hh:mm A';
                var slotTime = moment(slot,format);
                var slotToTime = moment(slotTo,format);
                var startTime = moment(starts, format);
                var endTime = moment(ends, format);

                console.log("moment times"+slotTime+slotToTime+startTime+endTime);

                if ((startTime.isSameOrAfter(slotTime)&&startTime.isSameOrBefore(slotToTime))&&(endTime.isSameOrAfter(slotTime)&&endTime.isSameOrBefore(slotToTime))) {
                    console.log("time in slot");

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
                }
                else {
                    console.log("time is not in slot");

                    toastr.warning("Please select valid time from selected slot");
                }
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
                        url:"{{ route('ajax.searchFaculty') }}",
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

                                     
