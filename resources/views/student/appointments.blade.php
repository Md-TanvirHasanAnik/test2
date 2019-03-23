@extends('student.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

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
                <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Recent Appointments<button id="add-appointment" type="button" class="btn btn-primary float-md-right">Create Appointment</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table">

                            @foreach($appointments as $appointment)
                                <tr id="row-{{$appointment->id}}">

                                    <td class="td-image">
                                        <a href="{{url("/faculty/$appointment->s_id")}}" data-toggle="tooltip" data-original-title="{{$appointment->name}}"><img src="https://appointo.froid.works/img/default-avatar-user.png" class="border img-bordered-sm img-size-50 img-circle"  ></a>
                                    </td>
                                    <td>
                                        <a class="text-uppercase" href="{{url("/student/$appointment->f_id")}}">{{$appointment->name}}</a><br>
                                        <i class="far fa-envelope"></i>{{$appointment->email}}<br>
                                        <i class="fas fa-mobile-alt"></i>{{$appointment->phone}}
                                    </td>
                                    <td class="text-muted">
                                        <i class="far fa-calendar"></i>{{$appointment->date}}<br>
                                        <i class="far fa-clock"></i>{{$appointment->starts_at}} - {{$appointment->ends_at}}
                                    </td>
                                    <td class="td-message ">
                                        <p>{{$appointment->message}}</p>
                                    </td>
                                    <td class="td-status" id="status-{{$appointment->id}}">
                                        @if($appointment->status=='completed')
                                            <span class="text-uppercase small border border-success text-success badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='cancelled')
                                            <span class="text-uppercase small border border-danger text-danger badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='pending')
                                            <span class="text-uppercase small border border-warning text-warning badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='inprogress')
                                            <span class="text-uppercase small border border-primary text-primary  badge-pill">{{$appointment->status}}</span>
                                        @endif
                                    </td>
                                    <td class="text-md-center">

                                        <input type="hidden" value="{{$appointment->f_id}}" id="fidField-{{$appointment->id}}" class="fid-hidden">

                                        <button  id="edit-{{$appointment->id}}" value="{{$appointment->id}}" data-toggle="modal" data-target="#editModal"  class="edit btn btn-rounded btn-outline-dark btn-sm "><i class="fa fa-edit"></i>Edit</button>
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
                        {{$appointments->links()}}
                        <br>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

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
        });
    </script>

@endsection

