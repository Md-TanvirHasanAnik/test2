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
use Yajra\DataTables\DataTables;

class AjaxDataController extends Controller
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

    public function studentAppointments()
    {
        //for table ajax data in appointments
        $appointments = DB::table('appointments')
            ->join('faculties', 'appointments.f_id', '=', 'faculties.f_id')
            ->select('appointments.*','faculties.name', 'faculties.email', 'faculties.phone')
            ->get();

        try {
            return DataTables::of($appointments)->make(true);
        } catch (\Exception $e) {
        }
    }

    public function findSchedule(Request $request){

//        $today=date("Y-m-d", strtotime($request->starts_at));
        $today=date("Y-m-d");

        $schedules = DB::table('schedules')
            ->select('schedules.*')
            ->where('f_id',$request->f_id)
            ->where('ends_at','>=',$today)
            ->get();

        return response()->json($schedules);//then sent this data to ajax success
    }


    public function findFaculty(Request $request){

        //$request->id here is the id of our chosen option id
        if ($request->department=='all') {
           $data=Faculty::select('*')
           ->get();
        }
        else{
            $data=Faculty::select('*')->where('department',$request->department)->get();
        }
       
        return response()->json($data);//then sent this data to ajax success
    }

    public function getFacultyMembers(Request $request){

        //$request->id here is the id of our chosen option id
        if ($request->department=='all') {
           $data=Faculty::select('*')
           ->where('available','yes')
           ->get();
        }
        else{
            $data=Faculty::select('*')
            ->where('department',$request->department)
            ->where('available','yes')
            ->get();
        }
       
        return response()->json($data);//then sent this data to ajax success
    }

    public function checkAvailability(Request $request){

        
            $available=Faculty::select('available')
            ->where('f_id',$request->f_id)
            ->first();

            if ($available->available=='yes') {
                 $response = array(
                            'available' => 'yes'
                        );
                        return response()->json($response);
            }
            else{
                 $response = array(
                            'available' => 'no'
                        );
                        return response()->json($response);
            }
        
       
        // return response()->json($data);//then sent this data to ajax success
    }

    public function findSlots(Request $request){
        $f_id=$request->f_id;
        $date=$request->date;
//        $date=date("Y-m-d", strtotime($request->get('date')));
        $day=date("D", strtotime($date));
        $day=strtolower($day);

//        return $f_id." ".$date." ".$day;
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
//      return $f_id." ".$date." ".$day." ".$schedule." ".$starts." ".$ends."\n";

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
        where('f_id', $f_id)->where('date',$date)->where('slot',$slot)->
        where('status','!=','cancelled')->get();


        return response()->json($data);//then sent this data to ajax success

    }

    public function searchFaculty(Request $request){
        //$request->id here is the id of our chosen option id
        if ($request->department=="all") {
              $data = Faculty::select('*')->where("name","LIKE","%{$request->get('query')}%")->get();
        }
        else{
             $data = Faculty::select('*')->
             where("department","=",$request->department)->where("name","LIKE","%{$request->get('query')}%")->get();
        }
      
        return response()->json($data);//then sent this data to ajax success

    }

    public function searchByResearchArea(Request $request){
        //$request->id here is the id of our chosen option id
        if ($request->department=="all") {
              $data = Faculty::select('*')->where("research_area","LIKE","%{$request->get('query')}%")->get();
        }
        else{
             $data = Faculty::select('*')->
             where("department","=",$request->department)->where("research_area","LIKE","%{$request->get('query')}%")->get();
        }
        return response()->json($data);//then sent this data to ajax success

    }

    public function allFaculty(Request $request){

        //$request->id here is the id of our chosen option id
       

        if (empty($request->department)) {
              $data=Faculty::select('*')->get();
        }
        else{
             $data=Faculty::select('*')-> where("department","=",$request->department)->get();
        }

        return response()->json($data);//then sent this data to ajax success
    }
}
