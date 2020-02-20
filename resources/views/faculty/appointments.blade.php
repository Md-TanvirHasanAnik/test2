

@extends('faculty.app')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
     <link href="{{ URL::asset('css/chat-style.css') }}" rel="stylesheet" type="text/css" >

    <link href="{{ asset('airdate/css/datepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('airdate/js/datepicker.js') }}" defer></script>

    {{--<link href="{{ asset('fengyuanchen/datepicker.min.css') }}" rel="stylesheet">--}}
    {{--<script src="{{ asset('fengyuanchen/datepicker.js') }}" defer></script>--}}

    <link href="{{ asset('mdtime/mdtimepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('mdtime/mdtimepicker.js') }}" defer></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="card col-md-12">
                <br><br>

            <!-- <div class="row">
            <div class="card col-md-12">
                <br><br> -->
<!-- 
                 <div class="row justify-content-between">
                    <div class=" col-md-3">
                        <select class="form-control" id="semester">
                            <option value="spring 2019">Spring 2019</option>
                            <option value="fall 2018">Fall 2018</option>
                            <option value="summer 2018">Summer 2018</option>
                            <option value="spring 2018">Spring 2018</option>
                        </select>
                    </div> -->

                    <!-- search by date  -->
                   <!--  <div class="col-md-4 text-center">
                        <div class=" float-left" style="margin-right: 8px;">
                            <input type="text" class="form-control" id="searchByDate" placeholder="By Date">
                        </div>
                       
                        <div class=" float-left" >
                            <input type="text" class="form-control" id="byStudent" placeholder="By Student">
                        </div>
                    </div> -->


             <!-- </div> -->


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
                      <!-- <a href="#" class="tile-link"></a> -->
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


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Appointments
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive-md p-0">
                        <table class="table">

                            @foreach($appointments as $appointment)
                                <tr id="row-{{$appointment->id}}">
                                    <td class="td-image">
                                        <a href="{{url("/students/$appointment->s_id")}}" data-toggle="tooltip" data-original-title="{{$appointment->name}}"><img src="{{$appointment->photo}}" class="border img-bordered-sm img-size-50 img-circle"  ></a>
                                    </td>
                                    <td>
                                        <a class="text-uppercase" href="{{url("/students/$appointment->s_id")}}">{{$appointment->name}}</a><br>
                                        <i class="far fa-envelope"></i>{{$appointment->email}}<br>
                                        <i class="fas fa-mobile-alt"></i>{{$appointment->phone}}
                                    </td>
                                    <td class="text-muted">
                                        <i class="far fa-calendar"></i>{{$appointment->date}}<br>
                                        <i class="far fa-clock"></i>{{date("h:i A",strtotime($appointment->starts_at))}} - {{date("h:i A",strtotime($appointment->ends_at))}}
                                    </td>
                                    <td class="td-message">
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
                                            <br><br><button id="reminder-{{$appointment->id}}" value="{{$appointment->id}}" class="btn btn-rounded btn-outline-dark btn-sm send-reminder"><i class="fa fa-send"></i>Send Reminder</button>
                                        @endif
                                    </td>
                                    <td class="text-md-center" id="action-{{$appointment->id}}">

                                        <input type="hidden" value="{{$appointment->f_id}}" id="fidField-{{$appointment->id}}" class="sid-hidden">

                                        {{--<button  id="edit-{{$appointment->id}}" value="{{$appointment->id}}" --}}{{--data-toggle="modal" data-target="#editModal"--}}{{--  class="edit btn btn-rounded btn-outline-dark btn-sm "><i class="fa fa-edit"></i>Edit</button>--}}
                                        {{--<br><br>--}}
                                        @if($appointment->status=='pending')
                                            <button id="accept-{{$appointment->id}}" value="{{$appointment->id}}" class="accept btn btn-rounded btn-outline-dark btn-sm" ><i class="fas fa-check"></i>Accept</button>
                                            <button id="deny-{{$appointment->id}}" value="{{$appointment->id}}" class="deny btn btn-rounded btn-outline-dark btn-sm" ><i class="fa fa-times"></i>Deny</button>
                                        @endif
                                        @if($appointment->status=='cancelled')
                                            
                                        @elseif($appointment->status=='approved')
                                        
                                        <button id="chat-{{$appointment->id}}" value="{{$appointment->id}}+{{$appointment->s_id}}+{{$appointment->photo}}+{{Auth::user()->photo}}" class="chat-btn btn btn-rounded btn-outline-dark btn-sm"><i class="fa fa-send"></i>Chat</button>
                                        <br><br>

                                        <button class=" btn btn-rounded btn-outline-dark btn-sm" data-toggle="dropdown"><i class="fas fa-pen"></i>Status</button>
                                        <ul class="dropdown-menu text-center">
                                          <li><button id="status-{{$appointment->id}}" class="btn btn-primary status" value="{{$appointment->id}}">completed</button></li>
                                          <br>
                                         <li><button id="status-{{$appointment->id}}" class="btn btn-primary status" value="{{$appointment->id}}">incomplete</button></li>
                                        </ul>
                                        <br><br>
                                            <button id="cancel-{{$appointment->id}}" value="{{$appointment->id}}" class="cancel btn btn-rounded btn-outline-dark btn-sm"><i class="fa fa-times"></i>Cancel</button>


                                        @endif

                                        {{--<br><br><button id="delete-{{$appointment->id}}" value="{{$appointment->id}}" class="delete btn btn-rounded btn-outline-dark btn-sm "><i class="fa fa-trash"></i>Delete</button>--}}
                                        <br>
                                    </td>
                                </tr>
                            @endforeach

                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <br>
                {{$appointments->links()}}
            </div>
                <br><br>
            </div>
        </div><!-- /.row -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="chatModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                   <div class="container bootstrap snippets">
                      <div class="col-md-12">
                        <!-- Panel Chat -->
                        <div class="panel" id="chat">
                          
                          <div class="panel-body">
                            <div class="chats">
                              <div class="chat">
                                <div class="chat-avatar">
                                  <a class="avatar avatar-online" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="June Lane">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="...">
                                    <i></i>
                                  </a>
                                </div>
                                <div class="chat-body">
                                  <div class="chat-content">
                                    <p>
                                      Good morning, sir.
                                      <br>What can I do for you?
                                    </p>
                                    <time class="chat-time" datetime="2015-07-01T11:37">11:37:08 am</time>
                                  </div>
                                </div>
                              </div>
                              <div class="chat chat-left">
                                <div class="chat-avatar">
                                  <a class="avatar avatar-online" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="Edward Fletcher">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="...">
                                    <i></i>
                                  </a>
                                </div>
                                <div class="chat-body">
                                  <div class="chat-content">
                                    <p>Well, I am just looking around.</p>
                                    <time class="chat-time" datetime="2015-07-01T11:39">11:39:57 am</time>
                                  </div>
                                </div>
                              </div>
                              <div class="chat">
                                <div class="chat-avatar">
                                  <a class="avatar avatar-online" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="June Lane">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="...">
                                    <i></i>
                                  </a>
                                </div>
                                <div class="chat-body">
                                  <div class="chat-content">
                                    <p>
                                      If necessary, please ask me.
                                    </p>
                                    <time class="chat-time" datetime="2015-07-01T11:40">11:40:10 am</time>
                                  </div>
                                </div>
                              </div>
                              <div class="chat">
                                <div class="chat-avatar">
                                  <a class="avatar avatar-online" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="June Lane">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="...">
                                    <i></i>
                                  </a>
                                </div>
                                <div class="chat-body">
                                  <div class="chat-content">
                                    <p>
                                      Good morning, sir.
                                      <br>What can I do for you?
                                    </p>
                                    <time class="chat-time" datetime="2015-07-01T11:37">11:37:08 am</time>
                                  </div>
                                </div>
                              </div>
                              <div class="chat chat-left">
                                <div class="chat-avatar">
                                  <a class="avatar avatar-online" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="Edward Fletcher">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="...">
                                    <i></i>
                                  </a>
                                </div>
                                <div class="chat-body">
                                  <div class="chat-content">
                                    <p>Well, I am just looking around.</p>
                                    <time class="chat-time" datetime="2015-07-01T11:39">11:39:57 am</time>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <!-- End Panel Chat -->
                      </div>
                      </div>
                </div>
                <!-- <div class="modal-footer"> -->
                  <div class="panel-footer">
                    
                      <div class="input-group">
                        <input id="message" type="text" class="form-control" placeholder="Say something">
                        <!-- <div class="input-group-append" id="date-btn">
                                    <i class="input-group-text far fa-file"></i>
                                </div> -->
                        <span class="input-group-append">
                          <button id="send" name="Send" class="btn btn-primary form-control">Send</button>
                        </span>
                      </div>
                    
                  </div>
                <!-- </div> -->
            </div>
        </div>
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
        var s_id="";
        var a_id="";
        var ids="";

        $(document).ready(function(){

            // $("#add-appointment").click(function(){
            //     window.location.href = "{{route('facultyAppointment.add')}}";
            // });

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
            

             $('.chats').html("");

            $(".chat-btn").click(function(){

              var ids=$(this).val();
                console.log(ids);
                var parts=ids.split('+');
                a_id=parts[0];
                s_id=parts[1];
                s_image=parts[2];
                f_image=parts[3];



                 $('#chatModal').modal();
                 $('.modal-body').animate({ scrollTop: $('.modal-body').height() }, 'slow');


            });

            $("#send").click(function(){

                event.preventDefault();
                // var data=$(this).serialize();
                var message=$('#message').val();
                    console.log(message+a_id+s_id);

                    $('.chats').html("");
                    $('.chats').html(" <div class='chat'><div class='chat-avatar'><a class='avatar avatar-online' data-toggle='tooltip' href='#' data-placement='right'><img src='"+f_image+"'><i></i></a></div><div class='chat-body'><div class='chat-content'><p>"+message+"</p></div> </div> </div> ");


                $.ajax({
                    method:'get',
                    url:'{{ route('appointment.sendMessage') }}',
                    data:{message:message,a_id:a_id,s_id:s_id},
                    success:function(data){
                        console.log(data);
                        console.log(data.length);

                        if (data.type==="success"){
                            toastr.success(data.message);



                        }
                        if (data.type==="error"){
                            
                        }

                    },
                    error:function(){

                    }
                });
            });

            $(".send-reminder").click(function(){

              toastr.success("A reminder message has been sent!");

            });


            //crud action

            $(".accept").click(function(){

                swal({
                    title: "Are you sure?",
                    text: "This appointment will be accepted!",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willAccept) => {
                        if (willAccept) {

                            var id=$(this).val();
                            console.log("id "+id);

                            $.ajax({
                                method:'get',
                                url:'{{route('facultyAppointment.changeStatus')}}',
                                data:{id:id,status:'approved'},
                                success:function(data){
                                    console.log(id+" "+data);
                                    console.log(data.length);

                                    if (data.type==="success"){

                                        // toastr.success(data.message);

                                        swal('Appointment Accepted', {
                                            icon: "success",
                                        });

                                        $("#status-"+id).html("");
                                        $("#status-"+id).html("<span class='text-uppercase small border border-primary text-primary badge-pill'>APPROVED</span>");
                                        $("#action-"+id).html("");
                                        // $("#action-"+id).html("<button id='cancel-"+id+"' value='"+id+"' class='cancel btn btn-rounded btn-outline-dark btn-sm'><i class='fa fa-times'></i>Cancel</button>");

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

            $(".deny").click(function(){

                swal({
                    title: "Are you sure?",
                    text: "This appointment will be cancelled!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willAccept) => {
                        if (willAccept) {

                            var id=$(this).val();
                            console.log("id "+id);

                            $.ajax({
                                method:'get',
                                url:'{{route('facultyAppointment.changeStatus')}}',
                                data:{id:id,status:'cancelled'},
                                success:function(data){
                                    console.log(id+" "+data);
                                    console.log(data.length);

                                    if (data.type==="success"){

                                        // toastr.success(data.message);

                                        swal('Appointment Cancelled', {
                                            icon: "success",
                                        });

                                        $("#status-"+id).html("");
                                        $("#status-"+id).html("<span class='text-uppercase small border border-danger text-danger badge-pill'>CANCELLED</span>");
                                        $("#action-"+id).html("");
                                        $("#action-"+id).html("<button id='cancel-"+id+"' value='"+id+"' class='cancel btn btn-rounded btn-outline-dark btn-sm' disabled><i class='fa fa-times'></i>Cancel</button>");

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
                                url:'{{route('facultyAppointment.changeStatus')}}',
                                data:{id:id,status:'cancelled'},
                                success:function(data){
                                    console.log(id+" "+data);
                                    console.log(data.length);

                                    if (data.type==="success"){

                                        // toastr.success(data.message);

                                        swal("Appointment Cancelled Successfully!", {
                                            icon: "success",
                                        });

                                        $("#status-"+id).html("");
                                        $("#status-"+id).html("<span class='text-uppercase small border border-danger text-danger badge-pill'>CANCELLED</span>");
                                        $("#cancel-"+id).attr('disabled','disabled');

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

                            console.log("f_id "+f_id);

                            $.ajax({
                                method:'get',
                                url:'{{route('facultyAppointment.changeStatus')}}',
                                data:{id:id,status:'deleted'},
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

            // change status
            $(".status").click(function(){

                swal({
                    title: "Are you sure?",
                    text: "Your appointment status will be changed!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willCancel) => {
                        if (willCancel) {

                            var id=$(this).val();
                            var status=$(this).text();

                            console.log("f_id "+f_id);

                            $.ajax({
                                method:'get',
                                url:'{{route('facultyAppointment.changeStatus')}}',
                                data:{id:id,status:status},
                                success:function(data){
                                    console.log(id+" "+data);
                                    console.log(data.length);

                                    if (data.type==="success"){

                                        // toastr.success(data.message);

                                        swal("Status changed!", {
                                            icon: "success",
                                        });

                                        $("#status-"+id).html("");
                                        if (status=='completed') {
                                            $("#status-"+id).html("<span class='text-uppercase small border border-success text-success badge-pill'>completed</span>");
                                            }
                                        else{
                                             $("#status-"+id).html("<span class='text-uppercase small border border-gray text-gray badge-pill'>incomplete</span>");
                                        }

                                        $("#action-"+id).html("");
                                       



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

                $('#id').val(id);

                $.ajax({
                    type:'get',
                    url:'{{route('facultyAppointment.edit')}}',
                    data:{'id':id},
                    success:function(data){
                        console.log(data);
                        console.log(data.length);
                        f_id= data.f_id;

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
                                console.log(data[0].date+" "+data.slot);

                                if (data.length>0) {
                                    $('#available_slots').html(slotData.length + " Slots available");
                                }
                                else
                                    $('#available_slots').html("");

                                var op="";
                                // Loop through each of the results and append the option to the dropdown
                                for(var i=0;i<slotData.length;i++){
                                    if(slotData[i].slot!==data.slot)
                                        op+='<option value="'+slotData[i].slot+'">'+slotData[i].slot+'</option>';
                                    else
                                        op+='<option value="'+slotData[i].slot+' selected">'+slotData[i].slot+'</option>';
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


            $('#editForm').on('submit',function(event){

                event.preventDefault();
                var data=$(this).serialize();


                $.ajax({
                    method:'POST',
                    url:'{{ route('facultyAppointment.update') }}',
                    data:data,
                    success:function(data){
                        console.log(data);
                        console.log(data.length);

                        if (data.type==="success"){
                            toastr.success(data.message);



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

    <script type="text/javascript">
        $(document).ready(function(){

            var date="";

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
                                if(data[i].slot!==data[0].slot)
                                    op+='<option value="'+data[i].slot+'">'+data[i].slot+'</option>';
                                else
                                    op+='<option value="'+data[i].slot+' selected">'+data[i].slot+'</option>';
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

@endsection


