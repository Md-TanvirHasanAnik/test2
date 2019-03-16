@extends('faculty.app')

@section('content')

    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
    {{--Air Date--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="{{ asset('airdate/css/datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mdtime/mdtimepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('airdate/js/datepicker.js') }}" defer></script>
    <script src="{{ asset('mdtime/mdtimepicker.js') }}" defer></script>

    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/magic-input/dist/magic-input.min.css">

<div class="container card">
    <div class="col-md-12 ">


        <br>
        <form action="{{ route('faculty.schedule.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="row">
                <div  align="center">
                    <label>Semester:</label> Spring 2019
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-body table-responsive-md p-0">
                    <table class="table table-striped">
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
                                <td>{{$slot->slot}}-<?php echo date("h:i", $ends) ?></td>

                                @for($i=0;$i<count($schedules);$i++)
                                    @if($slot->slot==$schedules[$i]->slot)
                                        @if($schedules[$i]->sat=='on')
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sat]" checked></td>
                                        @else
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sat]"></td>
                                        @endif
                                        @if($schedules[$i]->sun=='on')
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sun]" checked></td>
                                        @else
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sun]"></td>
                                        @endif
                                        @if($schedules[$i]->mon=='on')
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][mon]" checked></td>
                                        @else
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][mon]"></td>
                                        @endif
                                        @if($schedules[$i]->tue=='on')
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][tue]" checked></td>
                                        @else
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][tue]"></td>
                                        @endif
                                        @if($schedules[$i]->wed=='on')
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][wed]" checked></td>
                                        @else
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][wed]"></td>
                                        @endif
                                        @if($schedules[$i]->thu=='on')
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][thu]" checked></td>
                                        @else
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][thu]"></td>
                                        @endif
                                        @if($schedules[$i]->fri=='on')
                                            <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][fri]" checked></td>
                                        @else
                                                <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][fri]"></td>
                                        @endif
                                    @else
                                    @endif
                                @endfor
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <br>

            <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit">
            </div>
        </form>
    </div>
</div>
        <script type="text/javascript">

            $('.date').datepicker({

                format: 'dd-mm-yyyy',
                todayHighlight: true

            });
        </script>

    @endsection



