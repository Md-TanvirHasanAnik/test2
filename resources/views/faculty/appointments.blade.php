

@extends('faculty.app')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Appointments<input type="button"  id="add-appointment" class="btn btn-primary float-md-right" value="Create Appointment"/>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive-md p-0">
                        <table class="table">

                            @foreach($appointments as $appointment)
                                <tr id="row-{{$appointment->id}}">
                                    <td class="td-image">
                                        <a href="{{url("/students/$appointment->s_id")}}" data-toggle="tooltip" data-original-title="{{$appointment->name}}"><img src="https://appointo.froid.works/img/default-avatar-user.png" class="border img-bordered-sm img-size-50 img-circle"  ></a>
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
                                        @elseif($appointment->status=='cancelled')
                                            <span class="text-uppercase small border border-danger text-danger badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='pending')
                                            <span class="text-uppercase small border border-warning text-warning badge-pill">{{$appointment->status}}</span>
                                            <br><br><button id="reminder-{{$appointment->id}}" value="{{$appointment->id}}" class="btn btn-rounded btn-outline-dark btn-sm send-reminder"><i class="fa fa-send"></i>Send Reminder</button>
                                        @elseif($appointment->status=='deleted')
                                            <span class="text-uppercase small border border-danger text-danger badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='inprogress')
                                            <span class="text-uppercase small border border-primary text-primary  badge-pill">{{$appointment->status}}</span>
                                        @endif
                                    </td>
                                    <td class="text-md-center">

                                        <input type="hidden" value="{{$appointment->f_id}}" id="fidField-{{$appointment->id}}" class="sid-hidden">

                                        <button  id="edit-{{$appointment->id}}" value="{{$appointment->id}}" {{--data-toggle="modal" data-target="#editModal"--}}  class="edit btn btn-rounded btn-outline-dark btn-sm "><i class="fa fa-edit"></i>Edit</button>
                                        <br><br>
                                        @if($appointment->status=='cancelled')
                                            <button id="cancel-{{$appointment->id}}" value="{{$appointment->id}}" class="cancel btn btn-rounded btn-outline-dark btn-sm disabled" disabled><i class="fa fa-times"></i>Cancel</button>
                                        @else
                                            <button id="cancel-{{$appointment->id}}" value="{{$appointment->id}}" class="cancel btn btn-rounded btn-outline-dark btn-sm"><i class="fa fa-times"></i>Cancel</button>
                                        @endif
                                        <br><br><button id="delete-{{$appointment->id}}" value="{{$appointment->id}}" class="delete btn btn-rounded btn-outline-dark btn-sm "><i class="fa fa-trash"></i>Delete</button>
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

        $(document).ready(function(){

            $("#add-appointment").click(function(){
                window.location.href = "{{route('facultyAppointment.add')}}";
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
                                url:'{{route('facultyAppointment.cancel')}}',
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
                                url:'{{route('facultyAppointment.delete')}}',
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

                $.ajax({
                    type:'get',
                    url:'{{route('facultyAppointment.edit')}}',
                    data:{'id':id},
                    success:function(data){
                        console.log(data);
                        console.log(data.length);

                        //reset form
                        $('#editForm')[0].reset();

                        $('#datepicker').val(data[0].date);

                        $('#starts_at').val(data[0].starts_at);

                        // $('#starts_at').remove("#starts_at");
                        // $('#start-icon-div').prepend("  <input name='starts_at' value='"+data[0].starts_at+"' placeholder='"+data[0].starts_at+"' autocomplete='off' type='text' class='form-control' id='starts_at'  >");
                        //

                        $('#ends_at').val(data[0].ends_at);
                        $('#message').val(data[0].message);

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
                            data:{'f_id':f_id,'date':data[0].date},
                            success:function(slotData){
                                console.log(slotData);
                                console.log(slotData.length);
                                console.log(data[0].date+" "+data[0].slot);

                                if (data.length>0) {
                                    $('#available_slots').html(slotData.length + " Slots available");
                                }
                                else
                                    $('#available_slots').html("");

                                var op="";
                                // Loop through each of the results and append the option to the dropdown
                                for(var i=0;i<slotData.length;i++){
                                    if(slotData[i].slot!==data[0].slot)
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


