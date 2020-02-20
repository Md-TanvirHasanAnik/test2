@extends('admin.app')

@section('content')

    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

      <link href="{{ asset('mdtime/mdtimepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('mdtime/mdtimepicker.js') }}" defer></script>

    <div class="container" >

        <div class="card col-md-12 ">

            <div class="row d-flex justify-content-center" >
                <div class="col-md-8">
                    <br>
                    <br>


                    <div class="card">
                        <div class="card-header">Update Time Slots</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <div id="form" class="form-area" >
                                <form  id="appointmentForm" method="post" autocomplete="off" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-padding" >
                                        <div class="form-group row">
                                            <label for="type" class="col-sm-4 col-form-label">Schedule Type<i class="text-danger">*</i></label>
                                            <div class="input-group col-sm-8 d-flex flex-row-reverse" >
                                            <div class=" col-sm-6">
                                            <select name="type" class="form-control" id="type" >
                                                <option value="" selected="selected">Regular</option>
                                                <option value="cse">Ramadan</option>
                                        
                                            </select>
                                        </div>
                                        </div>
                                        </div>


                                        
                                            
                                                <div class="form-group row">
                                                    <label for="slot_1" class="col-sm-2 col-form-label">Slot 1<i class="text-danger">*</i></label>
                                                    <div class="input-group col-sm-10" id="start_time_div">
                                                        <input name="starts_at" autocomplete="off" type="text" class="form-control" id="slot_1" placeholder="Time" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class=" far fa-clock"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="slot_2" class="col-sm-2 col-form-label">Slot 2<i class="text-danger">*</i></label>
                                                    <div class="input-group col-sm-10" id="start_time_div">
                                                        <input name="starts_at" autocomplete="off" type="text" class="form-control" id="slot_2" placeholder="Time" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class=" far fa-clock"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="slot_3" class="col-sm-2 col-form-label">Slot 3<i class="text-danger">*</i></label>
                                                    <div class="input-group col-sm-10" id="start_time_div">
                                                        <input name="starts_at" autocomplete="off" type="text" class="form-control" id="slot_3" placeholder="Time" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class=" far fa-clock"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="slot_4" class="col-sm-2 col-form-label">Slot 4<i class="text-danger">*</i></label>
                                                    <div class="input-group col-sm-10" id="start_time_div">
                                                        <input name="starts_at" autocomplete="off" type="text" class="form-control" id="slot_4" placeholder="Time" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class=" far fa-clock"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="slot_5" class="col-sm-2 col-form-label">Slot 5<i class="text-danger">*</i></label>
                                                    <div class="input-group col-sm-10" id="start_time_div">
                                                        <input name="starts_at" autocomplete="off" type="text" class="form-control" id="slot_5" placeholder="Time" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class=" far fa-clock"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            

                                           
                                                <div class="form-group row">
                                                    <label for="slot_6" class="col-sm-2 col-form-label">Slot 6<i class="text-danger">*</i></label>
                                                    <div class="input-group col-sm-10" id="start_time_div">
                                                        <input name="ends_at" autocomplete="off" type="text" class="form-control" id="slot_6" placeholder="Time" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class=" far fa-clock"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            
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
                    <br>
                </div>
                {{--end div col-6--}}
                <br>
                <br>
            </div>
        </div>
    </div>


    {{--time picker--}}
    <script type="text/javascript">

        var starts="";
        var ends="";

        $(document).ready(function() {


            $('#slot_1').mdtimepicker({
                readOnly: false,
                hourPadding: true,
            }).on('timechanged', function (e) {
                console.log(e.value);
                console.log(e.time);

                starts=e.value;
            });

            $('#slot_2').mdtimepicker({
                readOnly: false,
                hourPadding: true,
            }).on('timechanged', function (e) {
                console.log(e.value);
                console.log(e.time);

                ends=e.value;
            });

            $('#slot_3').mdtimepicker({
                readOnly: false,
                hourPadding: true,
            }).on('timechanged', function (e) {
                console.log(e.value);
                console.log(e.time);

                starts=e.value;
            });

            $('#slot_4').mdtimepicker({
                readOnly: false,
                hourPadding: true,
            }).on('timechanged', function (e) {
                console.log(e.value);
                console.log(e.time);

                starts=e.value;
            });

            $('#slot_5').mdtimepicker({
                readOnly: false,
                hourPadding: true,
            }).on('timechanged', function (e) {
                console.log(e.value);
                console.log(e.time);

                starts=e.value;
            });

            $('#slot_6').mdtimepicker({
                readOnly: false,
                hourPadding: true,
            }).on('timechanged', function (e) {
                console.log(e.value);
                console.log(e.time);

                starts=e.value;
            });



        });
    </script>
@endsection

