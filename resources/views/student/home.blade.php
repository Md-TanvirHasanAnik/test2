@extends('student.app')

@section('content')

    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">

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
                        <h5 class="card-title">Upcoming Appointments</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive-md p-0">
                        <table class="table">

                            @foreach($appointments as $appointment)
                                <tr>
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
                                        <i class="far fa-clock"></i>{{date("h:i A",strtotime($appointment->starts_at))}} - {{date("h:i A",strtotime($appointment->ends_at))}}
                                    </td>
                                    <td class="td-message">
                                        <p>{{$appointment->message}}</p>
                                    </td>
                                    <td class="td-status">
                                        @if($appointment->status=='completed')
                                            <span class="text-uppercase small border border-success text-success badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='cancelled')
                                            <span class="text-uppercase small border border-danger text-danger badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='deleted')
                                            <span class="text-uppercase small border border-danger text-danger badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='pending')
                                            <span class="text-uppercase small border border-warning text-warning badge-pill">{{$appointment->status}}</span>
                                        @elseif($appointment->status=='inprogress')
                                            <span class="text-uppercase small border border-primary text-primary  badge-pill">{{$appointment->status}}</span>
                                        @endif
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
                <br><br>
            </div>
        </div><!-- /.row -->
    </div>
@endsection

