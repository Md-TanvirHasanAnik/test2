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

                <div class="row justify-content-between">
                    <div class=" col-md-3">
                        <select class="form-control" id="department">
                            <option value="all">All Department</option>

                            @foreach($departments as $dept)
                                <option value="{{strtolower($dept->short_name)}}">{{$dept->short_name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <!-- search by faculty (draft) -->
                    <div class="col-md-4 text-center">
                        <div class=" float-left" style="margin-right: 8px;">
                            <input type="text" class="form-control" id="searchByName" placeholder="Search by Name">
                            <ul style="list-style: none;"><li id="facultyList"></li></ul>
                        </div>
                       
                        <div class=" float-left" >
                            <input type="text" class="form-control" id="searchByResearchArea" placeholder="Search by research area">
                        </div>
                    </div>

                </div>
                <br>

                <section class="our-webcoderskull padding-lg">
                    <div class="container">

                        <div class="row col-md-12" id="faculty-row">
                        @foreach($faculties as $faculty)
                      
                           <div id="faculty-col" class="col-md-3 text-center " >
                                <div class="card text-center" id="faculty-card">
                                    <a class="text-dark profile-link" href="{{url("/faculties/$faculty->f_id")}}">
                                   <img class="card-img-top" src="{{$faculty->photo}}" alt="{{$faculty->name}}" >
                                   <div class="card-body text-center">
                                     <h5 class="card-title">{{$faculty->name}}</h5>
                                     <p class="card-text">{{$faculty->designation}}</p>
                                       <!-- <p class="card-text">{{$faculty->department}}</p> -->
                                  </div>
                                   </a>
                                </div>
                           </div>
                        @endforeach
                    </div>
                    </div>
                </section>
                <br><br>
            </div>
        </div><!-- /.row -->
    </div>

{{--finding faculty for dept--}}
    <script type="text/javascript">

         var currentDept="all";

        $(document).ready(function(){
            $(document).on('change','#department',function(){

                var dept=$(this).val();
                currentDept=dept;

                console.log(dept);
                var parent=$(this).parent().parent();

                //   var op=" ";

                $.ajax({
                    type:'get',
                    url:'{{route('ajax.findFaculty')}}',
                    data:{'department':dept},
                    success:function(faculty){
                        console.log(faculty);
                        console.log(faculty.length);

                        currentData=faculty;

                        var dom="";
                        $('#faculty-row').html("");

                        for(var i=0;i<faculty.length;i++){
                      
                           dom+="<div id='faculty-col' class='col-md-3 text-center ' >";
                                    dom+="<div class='card text-center' id='faculty-card'>";
                                         dom+="<a class='text-dark profile-link' href='/faculties/"+faculty[i].f_id+"'>";
                                            dom+="<img class='card-img-top' src='"+faculty[i].photo+"' alt='' >";
                                            dom+="<div class='card-body text-center'>";
                                                dom+="<h5 class='card-title'>"+faculty[i].name+"</h5>";
                                                dom+="<p class='card-text'>"+faculty[i].designation+"</p>";
                                             dom+="</div></a></div></div>";
                        }

                        $('#faculty-row').append(dom);

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

     {{--searching faculty--}}
    <script type="text/javascript">



        $(document).ready(function(){


            {{--searching faculty by name--}}
            $('#searchByName').keyup(function(){
                var query = $(this).val().trim();
                if(query!='')
                {
                    // var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('ajax.searchFaculty') }}",
                        type:'get',
                        data:{query:query,department:currentDept},
                        // data:{query:query, _token:_token},
                        success:function(faculty){

                            console.log(faculty.length+" "+query+" "+faculty)

                            if (faculty.length>0) {

                                var dom="";
                                $('#faculty-row').html("");

                                for(var i=0;i<faculty.length;i++){
                              
                                   dom+="<div id='faculty-col' class='col-md-3 text-center ' >";
                                            dom+="<div class='card text-center' id='faculty-card'>";
                                                 dom+="<a class='text-dark profile-link' href='/faculties/"+faculty[i].f_id+"'>";
                                                    dom+="<img class='card-img-top' src='"+faculty[i].photo+"' alt='' >";
                                                    dom+="<div class='card-body text-center'>";
                                                        dom+="<h5 class='card-title'>"+faculty[i].name+"</h5>";
                                                        dom+="<p class='card-text'>"+faculty[i].designation+"</p>";
                                                     dom+="</div></a></div></div>";
                                }

                                $('#faculty-row').append(dom);
                            }
                            else{
                                $('#faculty-row').html("");
                            }
                        }
                    });
                }
                else{
                    allFaculty();
                }
            });


            {{--faculty searchByResearchArea--}}
            $('#searchByResearchArea').keyup(function(){
                var query = $(this).val().trim();
                if(query!='')
                {
                    // var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('ajax.searchByResearchArea') }}",
                        type:'get',
                        data:{query:query,department:currentDept},
                        // data:{query:query, _token:_token},
                        success:function(faculty){

                            console.log(faculty.length+" "+query+" "+faculty)

                            if (faculty.length>0) {

                                var dom="";
                                $('#faculty-row').html("");

                                for(var i=0;i<faculty.length;i++){
                              
                                   dom+="<div id='faculty-col' class='col-md-3 text-center ' >";
                                            dom+="<div class='card text-center' id='faculty-card'>";
                                                 dom+="<a class='text-dark profile-link' href='/faculties/"+faculty[i].f_id+"'>";
                                                    dom+="<img class='card-img-top' src='"+faculty[i].photo+"' alt='' >";
                                                    dom+="<div class='card-body text-center'>";
                                                        dom+="<h5 class='card-title'>"+faculty[i].name+"</h5>";
                                                        dom+="<p class='card-text'>"+faculty[i].designation+"</p>";
                                                     dom+="</div></a></div></div>";
                                }

                                $('#faculty-row').append(dom);
                            }
                            else{
                                $('#faculty-row').html("");
                            }
                        }
                    });
                }
                else{
                    allFaculty();
                }
            });




            function allFaculty(){

                     console.log("all faculty called");
                    
                        $.ajax({
                            url:"{{ route('ajax.allFaculty') }}",
                            type:'get',
                             data:{department:currentDept},
                            // data:{query:query, _token:_token},
                            success:function(faculty){

                                console.log(faculty.length+" "+faculty);

                                if (faculty.length>0) {

                                    var dom="";
                                    $('#faculty-row').html("");

                                    for(var i=0;i<faculty.length;i++){
                                  
                                       dom+="<div id='faculty-col' class='col-md-3 text-center ' >";
                                                dom+="<div class='card text-center' id='faculty-card'>";
                                                     dom+="<a class='text-dark profile-link' href='/faculties/"+faculty[i].f_id+"'>";
                                                        dom+="<img class='card-img-top' src='"+faculty[i].photo+"' alt='' >";
                                                        dom+="<div class='card-body text-center'>";
                                                            dom+="<h5 class='card-title'>"+faculty[i].name+"</h5>";
                                                            dom+="<p class='card-text'>"+faculty[i].designation+"</p>";
                                                         dom+="</div></a></div></div>";
                                    }

                                    $('#faculty-row').append(dom);
                                }
                            }
                        });
            }

        });
    </script>


@endsection

