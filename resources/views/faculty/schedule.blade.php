@extends('faculty.app')

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

    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/magic-input/dist/magic-input.min.css">

<div class="container card">
    <div class="col-md-12 ">


        <br>
        <form id="scheduleForm"  method="POST" autocomplete="off">
            @csrf

            <div class="row">
                <div  align="center">
                    <label>Semester:</label> {{$semester->semester}}
                </div>
            </div>
            <br>

            <input  type="hidden" id="starts_at" name="starts_at" value="{{$semester->starts_at}}" >
            <input  type="hidden" id="starts_at" name="ends_at" value="{{$semester->ends_at}}" >


            <div class="card">
                <div class="card-body table-responsive-md p-0">
                    <table id="scheduleTable" class="table table-striped">
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
                        <tbody>

                        @foreach($slots as $slot)

                            <?php $ends = strtotime($slot->slot)+(90*60); ?>
                            <tr>
                                <td>
                                    {{$slot->slot}}-<?php echo date("h:i", $ends) ?>
                                    <input type="hidden" name="type" value="regular" id="type">
                                </td>

                                {{--check if have schedule--}}
                                @if(count($schedules)>0)
                                    @foreach($schedules as $schedule)
                                        @if($slot->slot==$schedule->slot)

                                            {{--if have schedule for the slot--}}
                                            @if($schedule->sat=='on')
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sat]" checked></td>
                                            @else
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sat]"></td>
                                            @endif
                                            @if($schedule->sun=='on')
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sun]" checked></td>
                                            @else
                                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sun]"></td>
                                            @endif
                                            @if($schedule->mon=='on')
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][mon]" checked></td>
                                            @else
                                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][mon]"></td>
                                            @endif
                                            @if($schedule->tue=='on')
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][tue]" checked></td>
                                            @else
                                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][tue]"></td>
                                            @endif
                                            @if($schedule->wed=='on')
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][wed]" checked></td>
                                            @else
                                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][wed]"></td>
                                            @endif
                                            @if($schedule->thu=='on')
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][thu]" checked></td>
                                            @else
                                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][thu]"></td>
                                            @endif
                                            @if($schedule->fri=='on')
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][fri]" checked></td>
                                            @else
                                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][fri]"></td>
                                            @endif


                                            {{--and break the loop--}}
                                            @break
                                        @endif

                                    @endforeach
                                        {{--if doesn't have schedule for the slot--}}
                                        @if(!in_array($slot->slot,(array)$schedule))
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sat]"></td>
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sun]"></td>
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][mon]"></td>
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][tue]"></td>
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][wed]"></td>
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][thu]"></td>
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][fri]"></td>
                                        @endif


                                    {{--if have no schedule--}}
                                @else
                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sat]"></td>
                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sun]"></td>
                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][mon]"></td>
                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][tue]"></td>
                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][wed]"></td>
                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][thu]"></td>
                                    <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][fri]"></td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <br>

            <div class="form-group">
            <input id="submit" class="btn btn-primary" type="submit" name="submit">
            </div>
        </form>
    </div>
</div>
        {{--<script type="text/javascript">--}}

            {{--$('.date').datepicker({--}}

                {{--format: 'dd-mm-yyyy',--}}
                {{--todayHighlight: true--}}

            {{--});--}}
        {{--</script>--}}

    {{--submit--}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#scheduleForm').on('submit',function(event){

                event.preventDefault();
                var data=$(this).serialize();


                $.ajax({
                    method:'POST',
                    url:'{{ route('faculty.schedule.store') }}',
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

    @endsection



