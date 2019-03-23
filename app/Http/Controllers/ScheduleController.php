<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeSlot;
use App\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth:faculty');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $current_semester=DB::table('controls')
            ->select('current_semester')
            ->first();



      $semester=DB::table('semesters')
            ->select('semesters.*')
            ->where('semester','=',$current_semester->current_semester)
            ->first();

        $slots=TimeSlot::all();
       // return $slots;

        $schedules = DB::table('schedules')
            ->select('schedules.*')
            ->where('f_id',Auth::user()->f_id)
            ->get();

//        return $schedules;
//        return $slots;
        return view('faculty.schedule',compact('semester','slots','schedules'));

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

       // return response()->json($request->all());

        try {
            $validate=Validator::make($request->all(), [
                'starts_at' => 'required',
                'ends_at' => 'required',
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

            //clear existing schedule
        DB::table('schedules')
            ->where('f_id', '=', Auth::user()->f_id)
            ->where('type','=','regular')
            ->delete();


        $sa=date("Y-m-d", strtotime($request->starts_at));
        $ea=date("Y-m-d", strtotime($request->ends_at));
//        echo $sa." ".$ea."\n";

            //slot and days from slots[slot][day] array of input fields
        foreach ((array)$request->slots as $slot=>$days ){
            # code...
            $a=array();

                $schedule=new Schedule;
                $schedule->f_id=Auth::user()->f_id;
                $schedule->slot=$slot;
                $schedule->starts_at=$sa;
                $schedule->ends_at=$ea;
                $schedule->sat="off";
                $schedule->sun="off";
                $schedule->mon="off";
                $schedule->tue="off";
                $schedule->wed="off";
                $schedule->thu="off";
                $schedule->fri="off";
                $schedule->type="regular";

                //day and value from days
            foreach ((array) $days as $day=>$value){
                $a[$day]=$value;
                
                 $schedule->$day=$value;
//                echo "$i ".$slot." ".$day." ".$value." ".count($a);
//                echo "\n";

        }

          $schedule->save();
      }

            $response = array(
                'message' => 'Schedule is submitted Successfully',
                'type' => 'success'
            );
            return response()->json($response);

   }


        //split into timeslots
//        $starttime = '9:00';  // your start time
//        $endtime = '21:00';  // End time
//        $duration = '30';  // split by 30 mins
//
//        $array_of_time = array ();
//        $start_time    = strtotime ($starttime); //change to strtotime
//        $end_time      = strtotime ($endtime); //change to strtotime
//
//        $add_mins  = $duration * 60;
//
//        while ($start_time <= $end_time) // loop between time
//        {
//           $array_of_time[] = date ("h:i", $start_time);
//           $start_time += $add_mins; // to check endtie=me
//        }
//
//
//       // echo '<pre>';
//      //  print_r($array_of_time);
//       // echo '</pre>';
//        //end splitting
//
////        return $schedule;
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


