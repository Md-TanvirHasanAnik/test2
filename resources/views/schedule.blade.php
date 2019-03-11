
@extends('layouts.app_faculty')

@section('content')

    @push('styles')
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/magic-input/dist/magic-input.min.css">
      <link rel="stylesheet" type="text/css" href="bower_components/magic-check/css/magic-check.css">
      <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    @endpush
    @push('scripts')
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    @endpush

    <body class="container col-md-12 ">

        <div class="container well col-md-12 ">

        <form action="{{ route('store') }}" method="POST">
      @csrf

            <div class="left col-md-6 " align="center">

                <h3>From</h3>
                <div class="input-group date col-md-4" data-provide="datepicker">
                    <input type="text" name="starts_at" class="form-control" placeholder="dd-mm-yyyy">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>

            <div class="left col-md-6 " align="center">

                <h3>To</h3>
                <div class="input-group date col-md-4" data-provide="datepicker">
                    <input type="text" name="ends_at" class="form-control" placeholder="dd-mm-yyyy">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
    </div>


    <div class="container well">


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
          <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sat]"></td>
          <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][sun]"></td>
          <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][mon]"></td>
          <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][tue]"></td>
          <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][wed]"></td>
          <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][thu]"></td>
          <td><input type="checkbox" class="mgc mgc-success"  name="slots[{{$slot->slot}}][fri]"></td>
        </tr>
     @endforeach


      </tbody>
    </table>
        </div>
      <input class="btn btn-primary" type="submit" name="submit">
    </form>
        </div>

        <script type="text/javascript">

            $('.date').datepicker({

                format: 'dd-mm-yyyy',
                todayHighlight: true

            });
        </script>
    </body>

    @endsection



