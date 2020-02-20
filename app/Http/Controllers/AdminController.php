<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        // $this->middleware('auth:faculty');
        $this->middleware('auth:admin');
    }

    public function index()
    {




        return view('admin.home');

    }

    public function semesters(){

        $semesters=DB::table('semesters')
            ->select('*')
            ->orderBy('id','DESC')
            ->get();

        $current_semester=DB::table('controls')
            ->select('*')
            ->first();

        return view('admin.semesters',compact('semesters','current_semester'));
    }

    public function timeSlots(){

        $current_semester=DB::table('controls')
            ->select('*')
            ->first();

        $slots=DB::table('time_slots')
            ->select('*')
            ->where('type',$current_semester->schedule_type)
            ->get();



        return view('admin.timeSlots',compact('slots','current_semester'));
//        return $slots;
    }

    public function control()
    {

        return view('admin.home');

    }

    public function getDates(Request $request){

        $dates = DB::table('semesters')
            ->select('*')
            ->where('id',$request->id)
            ->first();

        return response()->json($dates);//then sent this data to ajax success
    }


    public function addSemesters(Request $request){

        try {
            $validate=Validator::make($request->all(), [

                'semester' => 'required',
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



        }

        return view('admin.semesters',compact('semesters','current_semester'));
    }

    public function upSemesters(){

        $semesters=DB::table('semesters')
            ->select('*')
            ->orderBy('id','DESC')
            ->get();

        $current_semester=DB::table('controls')
            ->select('*')
            ->first();

        return view('admin.semesters',compact('semesters','current_semester'));
    }




    public function profile(){

        $admin=DB::table('admins')
            ->select('*')
            ->where('a_id','=',Auth::user()->a_id)
            ->first();

        return view('admin.profile')->with('admin',$admin);
    }
    public function editProfileForm(){

        $admin=DB::table('admins')
            ->select('*')
            ->where('a_id','=',Auth::user()->a_id)
            ->first();

        return view('admin.editProfile')->with('admin',$admin);

    }



}
