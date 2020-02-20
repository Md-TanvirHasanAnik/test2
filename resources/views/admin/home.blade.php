@extends('admin.app')

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
                                Admin Dashboard
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive-md p-0">


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <br><br>
                    </div>
                </div>
                </div><!-- /.row -->
            </div>
@endsection

