<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Schedule;
use App\Appointment;
use Carbon\Carbon;
use DateTime;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

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
//        $faculty=Faculty::all();//get data from table
//        return view('student.addAppointment')->with('faculty',$faculty);

        $appointments = DB::table('appointments')
            ->join('faculties', 'appointments.f_id', '=', 'faculties.f_id')
            ->select('appointments.*','faculties.name', 'faculties.email', 'faculties.phone')
            ->where('appointments.s_id','=',Auth::user()->s_id)
            ->where('appointments.status','!=','deleted')
            ->paginate(10);

        return view('student.appointments')->with('appointments',$appointments);
    }

    public function appointmentForm()
    {
        $faculty=Faculty::all();//get data from table
        return view('student.addAppointment')->with('faculty',$faculty);

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
                $appointment->status = "pending";
                $appointment->message = $request->message;
                $appointment->updated_by =Auth::user()->s_id;

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


    public function cancel(Request $request)
    {

            //check if the any appointment available
            $appointment = Appointment::find($request->id);


            if (!empty($appointment)) {

                $appointment->status = "cancelled";
                $appointment->updated_by =Auth::user()->s_id;
                $appointment->save();

                $response = array(
                    'message' => 'Appointment is Cancelled Successfully',
                    'type' => 'success'
                );
                return response()->json($response);
            } else {
                $response = array(
                    'message' => 'Something error happened.',
                    'type' => 'error'
                );

                return response()->json($response);
            }

    }

    public function delete(Request $request)
    {

        //check if the any appointment available

        $appointment=Appointment::find($request->id);
//        $appointment->delete();

        if (!empty($appointment)) {

            $appointment->status = "deleted";
            $appointment->updated_by =Auth::user()->s_id;
            $appointment->save();

            $response = array(
                'message' => 'Appointment is Deleted Successfully',
                'type' => 'success'
            );
            return response()->json($response);
        } else {
            $response = array(
                'message' => 'Something error happened.',
                'type' => 'error'
            );

            return response()->json($response);
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        //$request->id here is the id of our chosen option id
        $data = Appointment::select('*')->
        where('id', $request->id)->get();


        $data[0]->starts_at=date("h:i A",strtotime($data[0]->starts_at));
        $data[0]->ends_at=date("h:i A",strtotime($data[0]->ends_at));


        return response()->json($data);//then sent this data to ajax success
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        //check if the any appointment available
        $appointment = Appointment::find($request->id);


        if (!empty($appointment)) {

            $appointment->date = $request->date;
            $appointment->slot = $request->slot;
            $appointment->starts_at = $request->starts_at;
            $appointment->ends_at = $request->ends_at;
            $appointment->message = $request->message;
            $appointment->updated_by =Auth::user()->s_id;
            $appointment->save();

            $response = array(
                'message' => 'Appointment is updated Successfully',
                'type' => 'success'
            );
            return response()->json($response);
        } else {
            $response = array(
                'message' => 'Something error happened.',
                'type' => 'error'
            );

            return response()->json($response);
        }

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
