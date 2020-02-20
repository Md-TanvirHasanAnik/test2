@extends('student.app')

@section('content')

    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

    <link href="{{ asset('airdate/css/datepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('airdate/js/datepicker.js') }}" defer></script>

    {{--<link href="{{ asset('fengyuanchen/datepicker.min.css') }}" rel="stylesheet">--}}
    {{--<script src="{{ asset('fengyuanchen/datepicker.js') }}" defer></script>--}}

    <link href="{{ asset('mdtime/mdtimepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('mdtime/mdtimepicker.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

 {{--for time format--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>



    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="card col-md-12">
                <br><br>

               

                    
                    <!-- <div class="row justify-content-between">
                    <div class=" col-md-3">
                        <select class="form-control" id="semester">
                            <option value="spring 2019">Spring 2019</option>
                            <option value="fall 2018">Fall 2018</option>
                            <option value="summer 2018">Summer 2018</option>
                            <option value="spring 2018">Spring 2018</option>
                        </select>
                    </div> -->

                   <!--  search by date  -->
                   <!--  <div class="col-md-4 text-center">
                        <div class=" float-left" style="margin-right: 8px;">
                            <input type="text" class="form-control" id="searchByDate" placeholder="By Date">
                            <ul style="list-style: none;"><li id="facultyList"></li></ul>
                        </div>
                       
                        <div class=" float-left" >
                            <input type="text" class="form-control" id="byFacultyMember" placeholder="By Faculty Member">
                        </div>
                    </div> -->
                <!-- </div>  -->

                
                <br>


            <div class="row">

                <div class="col-md-2">                       
                  <div class="info-box">
                      <div class="media align-items-center">
                          <span class="info-box-icon bg-dodger align-items-center"><i class="fa fa-calendar"></i></span>
                        <div class="media-body overflow-hidden">
                          <p class="info-box-content">
                           <span class="info-box-text">Total</span>
                            <span class="info-box-number" id="completed-booking">{{$counts['all']}}</span>
                          </p>
                        </div>
                      </div>
                      <!-- <a href="#" class="tile-link"></a> -->
                  </div>
                </div>

                <div class="col-md-2">                       
                  <div class="info-box">
                      <div class="media align-items-center">
                          <span class="info-box-icon bg-orange align-items-center"><i class="fa fa-calendar"></i></span>
                        <div class="media-body overflow-hidden">
                          <p class="info-box-content">
                           <span class="info-box-text">Pending</span>
                            <span class="info-box-number" id="completed-booking">{{$counts['pending']}}</span>
                          </p>
                        </div>
                      </div>
                      <a href="#" class="tile-link"></a>
                  </div>
                </div>

                 <div class="col-md-2">                       
                  <div class="info-box">
                      <div class="media align-items-center">
                          <span class="info-box-icon bg-green align-items-center"><i class="fa fa-calendar"></i></span>
                        <div class="media-body overflow-hidden">
                          <p class="info-box-content">
                           <span class="info-box-text">Approved</span>
                          <span class="info-box-number" id="completed-booking">{{$counts['approved']}}</span>
                          </p>
                        </div>
                      </div>
                      <!-- <a href="#" class="tile-link"></a> -->
                  </div>
                </div>

                 <div class="col-md-2">                       
                  <div class="info-box">
                      <div class="media align-items-center">
                          <span class="info-box-icon bg-primary align-items-center"><i class="fa fa-calendar"></i></span>
                        <div class="media-body overflow-hidden">
                          <p class="info-box-content">
                           <span class="info-box-text">Completed</span>
                            <span class="info-box-number" id="completed-booking">{{$counts['completed']}}</span>
                          </p>
                        </div>
                      </div>
                      <!-- <a href="#" class="tile-link"></a> -->
                  </div>
                </div>

               <div class="col-md-2">                       
                  <div class="info-box">
                      <div class="media align-items-center">
                          <span class="info-box-icon bg-gray align-items-center"><i class="fa fa-calendar"></i></span>
                        <div class="media-body overflow-hidden">
                          <p class="info-box-content">
                           <span class="info-box-text">Incomplete</span>
                            <span class="info-box-number" id="completed-booking">{{$counts['incomplete']}}</span>
                          </p>
                        </div>
                      </div>
                    <!-- <a href="#" class="tile-link"></a> -->
                  </div>
                </div>

                 <div class="col-md-2">                       
                  <div class="info-box">
                      <div class="media align-items-center">
                          <span class="info-box-icon bg-danger align-items-center"><i class="fa fa-calendar"></i></span>
                        <div class="media-body overflow-hidden">
                          <p class="info-box-content">
                           <span class="info-box-text">Cancelled</span>
                            <span class="info-box-number" id="completed-booking">{{$counts['cancelled']}}</span>
                          </p>
                        </div>
                      </div>
                      <!-- <a href="#" class="tile-link"></a> -->
                  </div>
                </div>
            </div>
            <br>

       <!--  <div class="col-md">
            <div class="d-flex border">
                <div class="bg-primary text-light p-4">
                    <div class="d-flex align-items-center h-100">
                       <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Completed Bookings</p>
                    <h3 class="font-weight-bold mb-0">5</h3>
                </div>
            </div>
        </div> -->

                <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Appointments<button id="add-appointment" type="button" class="btn btn-primary float-md-right">Request Appointment</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table">

                            @foreach($appointments as $appointment)
                                <tr id="row-{{$appointment->id}}">

                                    <td class="td-image">
                                        <a href="{{url("/faculties/$appointment->f_id")}}" data-toggle="tooltip" data-original-title="{{$appointment->name}}"><img src="{{$appointment->photo}}" class="border img-bordered-sm img-size-50 img-circle"  ></a>
                                    </td>
                                    <td>
                                        <a class="text-uppercase" href="{{url("/faculties/$appointment->f_id")}}">{{$appointment->name}}</a><br>
                                        <i class="far fa-envelope"></i>{{$appointment->email}}<br>
                                        <i class="fas fa-mobile-alt"></i>{{$appointment->phone}}
                                    </td>
                                    <td class="text-muted">
                                        <i class="far fa-calendar"></i>{{$appointment->date}}<br>
                                        <i class="far fa-clock"></i>{{date("h:i A",strtotime($appointment->starts_at))}} - {{date("h:i A",strtotime($appointment->ends_at))}}
                                    </td>
                                    <td class="td-message ">
                                        <p>{{$appointment->message}}</p>
                                    </td>
                                    <td class="td-status" id="status-{{$appointment->id}}">
                                        @if($appointment->status=='completed')
                                            <span class="text-uppercase small border border-success text-success badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='incomplete')
                                        <span class="text-uppercase small border border-gray text-gray badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='cancelled')
                                            <span class="text-uppercase small border border-danger text-danger badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='pending')
                                            <span class="text-uppercase small border border-warning text-warning badge-pill">{{$appointment->status}}</span>
                                         @elseif($appointment->status=='approved')
                                            <span class="text-uppercase small border border-primary text-primary badge-pill">{{$appointment->status}}</span>
                                            <br><br>
                                        @endif
                                    </td>
                                    <td class="text-md-center">

                                        <input type="hidden" value="{{$appointment->f_id}}" id="fidField-{{$appointment->id}}" class="fid-hidden">

                                        
                                        @if($appointment->status=='cancelled')
                                          <!--   <button id="cancel-{{$appointment->id}}" value="{{$appointment->id}}" class="cancel btn btn-rounded btn-outline-dark btn-sm disabled" disabled><i class="fa fa-times"></i>Cancel</button> -->
                                        @elseif($appointment->status=='approved'||$appointment->status=='pending')
                                        <button  id="edit-{{$appointment->id}}" value="{{$appointment->id}}" data-toggle="modal" data-target="#editModal"  class="edit btn btn-rounded btn-outline-dark btn-sm "><i class="fa fa-edit"></i>Edit</button>
                                        <br><br>

                                            <button id="cancel-{{$appointment->id}}" value="{{$appointment->id}}" class="cancel btn btn-rounded btn-outline-dark btn-sm"><i class="fa fa-times"></i>Cancel</button>
                                        @endif
                                        {{--<br><br><button id="delete-{{$appointment->id}}" value="{{$appointment->id}}" class="delete btn btn-rounded btn-outline-dark btn-sm "><i class="fa fa-trash"></i>Delete</button>--}}
                                        <br>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{$appointments->links()}}
                        <br>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                    <br><br>
            </div>
                </div>
            </div>
        </div><!-- /.row -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <form  id="editForm" method="post" autocomplete="off" accept-charset="utf-8">
                        @csrf
                    <input type="hidden" name="id" value="" id="id">
                     <input type="hidden" name="f_id" value="" id="f_id">

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

    <script type="text/javascript">

        var id="";
        var f_id="";
        var date="";
        var slot="";
        var slotTo="";
        var starts="";
        var ends="";

        $(document).ready(function(){

        $("#add-appointment").click(function(){
            window.location.href = "{{route('appointment.add')}}";
        });

            {{--$('.table').DataTable({--}}
                {{--"processing": true,--}}
                {{--"serverSide": true,--}}
                {{--"ajax": "{{ route('ajax.studentAppointments') }}",--}}
                {{--"columns":[--}}
                    {{--{ "data": "first_name" },--}}
                    {{--{ "data": "last_name" },--}}
                    {{--{ "data": "action", orderable:false, searchable: false}--}}
                {{--]--}}
            {{--});--}}

        //crud action
            $(".cancel").click(function(){

                swal({
                    title: "Are you sure?",
                    text: "Your appointment will be cancelled!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willCancel) => {
                        if (willCancel) {

                            var id=$(this).val();
                            console.log("id "+id);

                            $.ajax({
                                method:'get',
                                url:'{{route('appointment.cancel')}}',
                                data:{id:id},
                                success:function(data){
                                    console.log(id+" "+data);
                                    console.log(data.length);

                                    if (data.type==="success"){

                                        // toastr.success(data.message);

                                        swal(data.message, {
                                            icon: "success",
                                        });

                                        $("#status-"+id).html("");
                                        $("#status-"+id).html("<span class='text-uppercase small border border-danger text-danger badge-pill'>CANCELLED</span>");
                                        $("#cancel-"+id).attr('disabled','disabled');
                                        $("#edit-"+id).attr('disabled','disabled');

                                    }
                                    if (data.type==="error"){
                                        toastr.error(data.message);
                                    }


                                },
                                error:function(){

                                }
                            });
                        }
                    });
            });


            $(".delete").click(function(){

                swal({
                    title: "Are you sure?",
                    text: "Your appointment will be deleted!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willCancel) => {
                        if (willCancel) {

                            var id=$(this).val();
                            var f_id=$(".fidField-"+id).val();
                            console.log("f_id "+f_id);

                            $.ajax({
                                method:'get',
                                url:'{{route('appointment.delete')}}',
                                data:{id:id,f_id:f_id},
                                success:function(data){
                                    console.log(id+" "+data);
                                    console.log(data.length);

                                    if (data.type==="success"){

                                        // toastr.success(data.message);

                                        swal(data.message, {
                                            icon: "success",
                                        });

                                        //delete the row from table
                                        $("#row-"+id).html("");

                                    }
                                    if (data.type==="error"){
                                        toastr.error(data.message);
                                    }


                                },
                                error:function(){

                                }
                            });
                        }
                    });

            });


            $(".edit").click(function(){
                id=$(this).val();
                f_id= $("#fidField-"+id).val();
                $('#id').val(id);
                $('#f_id').val(f_id);

                $.ajax({
                    type:'get',
                    url:'{{route('appointment.edit')}}',
                    data:{'id':id},
                    success:function(data){
                        console.log(data);
                        console.log(data.length);

                        date=data.date;
                        starts=data.starts_at;
                        ends=data.ends_at;
                        slot=data.slot;

                        var slotInMillis=moment(data.slot,'hh:mm A').add(90,'m');
                        slotTo=moment(slotInMillis).format('hh:mm A');

                        //reset form
                        $('#editForm')[0].reset();

                        $('#datepicker').val(data.date);

                        $('#starts_at').val(data.starts_at);

                        // $('#starts_at').remove("#starts_at");
                        // $('#start-icon-div').prepend("  <input name='starts_at' value='"+data[0].starts_at+"' placeholder='"+data[0].starts_at+"' autocomplete='off' type='text' class='form-control' id='starts_at'  >");
                        //

                        $('#ends_at').val(data.ends_at);
                        $('#message').val(data.message);

                       //  // Add the empty option with the empty message
                       //  var  op='<option value="0" disabled>Select Slot</option>';
                       //      op+='<option value="'+data[0].slot+' selected">'+data[0].slot+'</option>';
                       //  //// Remove current options
                       // $('#slot').html("");
                       //  //append all options
                       // $('#slot').append(op);

                        $.ajax({
                            type:'get',
                            url:'{{route('ajax.findSlots')}}',
                            data:{'f_id':f_id,'date':data.date},
                            success:function(slotData){
                                console.log(slotData);
                                console.log(slotData.length);
                                console.log(slotData.date+" "+slotData.slot);

                                if (slotData.length>0) {
                                    $('#available_slots').html(slotData.length + " Slots available");
                                }
                                else
                                    $('#available_slots').html("");

                                var op="";
                               

                            // Loop through each of the results and append the option to the dropdown
                            for(var i=0;i<slotData.length;i++){
                                //get the minutes to add from class/slot duration
                                var slotInMillis=moment(slotData[i].slot,'hh:mm A').add(90,'m');
                                var slotTo=moment(slotInMillis).format('hh:mm A');
                                console.log(slotTo);

                                op+='<option value="'+slotData[i].slot+'">'+slotData[i].slot+' - '+slotTo+'</option>';
                            }

                                //// Remove current options
                                $('#slot').html("");

                                //append all options
                                $('#slot').append(op);
                            },
                            error:function(){

                            }
                        });

                    },
                    error:function(){

                    }
                });

                $('#editModal').modal();

            });


            // get appointments for slot
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


            $('#editForm').on('submit',function(event){

            
                event.preventDefault();
                var data=$(this).serialize();



                 console.log(data);

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
                        url:'{{route('appointment.update')}}',
                        data:data,
                        success:function(data){
                            console.log(data);
                            console.log(data.length);

                            if (data.type==="success"){
                                toastr.success(data.message);

                                $('#editModal').modal('toggle'); 

                                location.reload();
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

    <script type="text/javascript">
    $(document).ready(function(){

        var date="";
        var slotTo="";

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

                            var op="";

                            if (data.length>0) {
                                $('#available_slots').html(data.length + " Slots available");
                            }
                            else {
                                $('#available_slots').html("");
                                op+='<option value="0" selected disabled>Select Slot</option>';

                            }

                            

                            // Loop through each of the results and append the option to the dropdown
                            for(var i=0;i<data.length;i++){

                                //get the minutes to add from class/slot duration
                            var slotInMillis=moment(data[i].slot,'hh:mm A').add(90,'m');
                            slotTo=moment(slotInMillis).format('hh:mm A');
                            console.log(slotTo);

                                if(data[i].slot!==data[0].slot)
                                    op+='<option value="'+data[i].slot+'">'+data[i].slot+' - '+slotTo+'</option>';
                                else
                                    op+='<option value="'+data[i].slot+' selected">'+data[i].slot+' - '+slotTo+'</option>';
                            }
                            //// Remove current options
                            $('#slot').html("");

                            //append all options
                            $('#slot').append(op);
                        },
                        error:function(){

                        }
                    });
                }
        });

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

@endsection

