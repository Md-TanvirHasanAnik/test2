@extends('student.app')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                <section class="our-webcoderskull padding-lg">
                    <div class="container">

                        @foreach($faculties as $faculty)

                        @endforeach
                    </div>
                </section>
                <br><br>
            </div>
        </div><!-- /.row -->
    </div>
@endsection

