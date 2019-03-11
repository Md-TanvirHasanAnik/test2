<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Schedule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       // $this->middleware('auth:faculty');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculty=Faculty::all();//get data from table
        return view('add_appointment')->with('faculty',$faculty);
    }

    public function findFaculty(Request $request){

        //$request->id here is the id of our chosen option id
        $data=Faculty::select('name','f_id')->where('dept',$request->dept)->get();

        return response()->json($data);//then sent this data to ajax success
    }

    public function findSlots(Request $request){
        $f_id=$request->f_id;
        $date=$request->date;
//        $date=date("Y-m-d", strtotime($request->get('date')));
        $day=date("D", strtotime($date));
        $day=strtolower($day);

        $schedule=null;
        $schedule=Schedule::select('starts_at','ends_at')->distinct()->
        where('f_id',$f_id)->where('starts_at','<=',$date)->where('ends_at','>=',$date)->first();

        $starts=$schedule['starts_at'];
        $ends=$schedule['ends_at'];
//      return $f_id." ".$date." ".$day." ".$schedule." ".$starts." ".$ends."\n";

        //$request->id here is the id of our chosen option id
        $data = Schedule::select('slot', 'f_id')->
        where('f_id', $f_id)->where('starts_at','<=',$date)->
        where('ends_at','>=',$date)->where($day, '=', 'on')->get();


           // $data["msg"]="No slots available";

        return response()->json($data);//then sent this data to ajax success
    }

    public function searchFaculty(Request $request){
        //$request->id here is the id of our chosen option id
        $data = Faculty::select('name','f_id','dept')->where("name","LIKE","%{$request->get('query')}%")->get();
        return response()->json($data);//then sent this data to ajax success

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
