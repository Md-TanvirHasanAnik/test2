@extends ('student.app')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('css/profile.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
   

     {{--Air Date--}}
    <link href="{{ asset('airdate/css/datepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('airdate/js/datepicker.js') }}" defer></script>

     <link href="{{ asset('mdtime/mdtimepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('mdtime/mdtimepicker.js') }}" defer></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


     {{--for time format--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>


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
            <div class="col-md-5 text-center">
                <div class="profile-head">

                    <h3>
                        {{$faculty->name}}
                    </h3>

                </div>
            </div>

            <div class="col-md-3 text-center">
                    <button id="createAppointment" value="{{$faculty->f_id}}" class="profile-edit-btn" >Request Appointment</button>
            </div>

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

     <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <form  id="appointmentForm" method="post" autocomplete="off" accept-charset="utf-8">
                        @csrf


                     <input type="hidden" name="f_id" value="{{$faculty->f_id}}" id="f_id">

                    <div class="form-group">
                        <label>Appointment Date <i class="text-danger">*</i></label>
                        <div  class="input-group" >
                            <input  type="text" id="datepicker" name="date" class="form-control"   placeholder="yyyy-mm-dd">
                            {{--<input  type="text" id="datepicker" data-provide="datepicker" name="date" class="form-control datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" value=""  placeholder="dd-mm-yyyy">--}}
                            <div class="input-group-append" id="date-btn">
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
                    <div id="appointments-taken"></div>

                    <div style="margin:0 -15px 0 -15px">
                        <div class="col-md-6" style="float: left">
                            <div class="form-group">
                                <label>Starting Time<i class="text-danger">*</i></label>
                                <div class="input-group" id="start_time_div">
                                    <input name="starts_at" autocomplete="off" type="text" class="form-control" id="starts_at" placeholder="Time" >
                                    <div id="start-icon-div" class="input-group-append">
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
                                    <div id="end-icon-div" class="input-group-append">
                                        <i class="input-group-text far fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Problem </label>
                        <textarea id="message" name="message" class="form-control" placeholder="message"  rows="5"></textarea>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" id="submit" name="Save Changes" class="btn btn-primary">
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Notice: Respected Faculty Member is not currently available for counseling!
                
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        var f_id=$(this).val;
        console.log(f_id);

        $(document).ready(function(){

            $("#createAppointment").click(function(){

                $.ajax({
                    method:'get',
                    url:'{{ route('ajax.checkAvailability') }}',
                    data:{'f_id':f_id},
                    success:function(data){
                        console.log(data);
                        console.log(data.length);

                        if (data.available==="yes"){

                            $('#editModal').modal();

                        }
                        if (data.available==="no"){
                            $('#noticeModal').modal();
                        }
                        


                    },
                    error:function(){

                    }
                });

                 // $('#editModal').modal();

            });
        });

    </script>


 {{--finding slots for date--}}
    <script type="text/javascript">

        var date="";
        f_id=$('#f_id').val();

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
                        data:{'f_id':f_id,'date':date},
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
                        data:{'f_id':f_id,'date':date,'slot':slot},
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

@endsection
