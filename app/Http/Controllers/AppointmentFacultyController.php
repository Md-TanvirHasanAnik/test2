<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Schedule;
use App\Appointment;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AppointmentFacultyController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth:faculty');
        $this->middleware('auth:faculty');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $faculty=Faculty::all();//get data from table
//        return view('faculty.appointments')->with('faculty',$faculty);

        $appointments = DB::table('appointments')
            ->join('students', 'appointments.s_id', '=', 'students.s_id')
            ->select('appointments.*','students.name', 'students.email', 'students.phone')
            ->paginate(10);

        return view('faculty.appointments')->with('appointments',$appointments);
    }

    public function findSlots(Request $request){
        $f_id=$request->f_id;
        $date=$request->date;
//        $date=date("Y-m-d", strtotime($request->get('date')));
        $day=date("D", strtotime($date));
        $day=strtolower($day);


//        $schedule=null;
//        $schedule=DB::table('schedules')
//            ->select('starts_at','ends_at')->distinct()
//            ->where('f_id',$f_id)
//            ->where('starts_at','<=',$date)
//            ->where('ends_at','>=',$date)
//            ->first();
//
//        $starts=$schedule['starts_at'];
//        $ends=$schedule['ends_at'];
////      return $f_id." ".$date." ".$day." ".$schedule." ".$starts." ".$ends."\n";

        //$request->id here is the id of our chosen option id
        $data = DB::table('schedules')->
        select('slot', 'f_id')->
        where('f_id', $f_id)->where('starts_at','<=',$date)->
        where('ends_at','>=',$date)->where($day, '=', 'on')->get();


        // $data["msg"]="No slots available";
//            $data["date"]=$date;

        return response()->json($data);//then sent this data to ajax success

    }

    public function findAppointments(Request $request){
        $f_id=$request->f_id;
        $date=$request->date;
        $slot=$request->slot;

        //$request->id here is the id of our chosen option id
        $data = Appointment::select('starts_at', 'ends_at')->
        where('f_id', $f_id)->where('date',$date)->where('slot',$slot)->get();


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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $validate=Validator::make($request->all(), [
                'faculty' => 'required',
                'date' => 'required',
                'starts_at' => 'required',
                'ends_at' => 'required',
                'slot' => 'required',
            ]);
        } catch (ValidationException $e) {
        }

        if ($validate->fails()) {

//            foreach ($validate->getMessageBag()->getMessages() as $field_name=>$message){
//                $errors=array(
//                    'message'=>$message,
//                    'type'=>'warning',
//                );
//            }

            $response = array(
                'message' => 'Required fields are missing',
                'type' => 'warning'
            );

            return response()->json($response);
        }
        else {
            $starts = Carbon::createFromFormat('H:i a', $request->starts_at)->toTimeString();
            $ends = Carbon::createFromFormat('H:i a', $request->ends_at)->toTimeString();

            //check if the any appointment available
            $isAvailable = Appointment::select('id')->
            where('f_id', $request->faculty)->where('date', $request->date)->
            whereBetween('starts_at', [$starts, $ends])->whereBetween('ends_at', [$starts, $ends])->first();

            if (empty($isAvailable)) {
                $appointment = new Appointment();
                $appointment->s_id = Auth::user()->s_id;
                $appointment->f_id = $request->faculty;
                $appointment->date = $request->date;
                $appointment->slot = $request->slot;
                $appointment->starts_at = $starts;
                $appointment->ends_at = $ends;
                $appointment->status = "Pending";
                $appointment->message = $request->message;

                $appointment->save();

                $response = array(
                    'message' => 'Appointment is submitted Successfully',
                    'type' => 'success'
                );
                return response()->json($response);
            } else {
                $response = array(
                    'message' => 'Appointment is already taken, Please check your time.',
                    'type' => 'error'
                );

                return response()->json($response);
            }
        }
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

    public function storeFromFaculty(Request $request)
    {
        try {
            $validate=Validator::make($request->all(), [
                'faculty' => 'required',
                'date' => 'required',
                'starts_at' => 'required',
                'ends_at' => 'required',
                'slot' => 'required',
            ]);
        } catch (ValidationException $e) {
        }

        if ($validate->fails()) {

//            foreach ($validate->getMessageBag()->getMessages() as $field_name=>$message){
//                $errors=array(
//                    'message'=>$message,
//                    'type'=>'warning',
//                );
//            }

            $response = array(
                'message' => 'Required fields are missing',
                'type' => 'warning'
            );

            return response()->json($response);
        }
        else {
            $starts = Carbon::createFromFormat('H:i a', $request->starts_at)->toTimeString();
            $ends = Carbon::createFromFormat('H:i a', $request->ends_at)->toTimeString();

            //check if the any appointment available
            $isAvailable = Appointment::select('id')->
            where('f_id', $request->faculty)->where('date', $request->date)->
            whereBetween('starts_at', [$starts, $ends])->whereBetween('ends_at', [$starts, $ends])->first();

            if (empty($isAvailable)) {
                $appointment = new Appointment();
                $appointment->s_id = Auth::user()->s_id;
                $appointment->f_id = $request->faculty;
                $appointment->date = $request->date;
                $appointment->slot = $request->slot;
                $appointment->starts_at = $starts;
                $appointment->ends_at = $ends;
                $appointment->status = "Pending";
                $appointment->message = $request->message;

                $appointment->save();

                $response = array(
                    'message' => 'Appointment is submitted Successfully',
                    'type' => 'success'
                );
                return response()->json($response);
            } else {
                $response = array(
                    'message' => 'Appointment is already taken, Please check your time.',
                    'type' => 'error'
                );

                return response()->json($response);
            }
        }
    }
}
