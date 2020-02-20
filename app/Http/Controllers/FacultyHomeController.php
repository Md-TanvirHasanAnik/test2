<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FacultyHomeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:faculty');
    }

    public function index()
    {

//        $appointments=Appointment::all();

          $today = Carbon::now()->setTimezone('Asia/Dhaka')->format('Y-m-d');

        $appointments = DB::table('appointments')
            ->join('students', 'appointments.s_id', '=', 'students.s_id')
            ->select('appointments.*','students.name', 'students.email','students.photo', 'students.phone')
            ->where('appointments.f_id','=',Auth::user()->f_id)
            ->where('appointments.status','!=','cancelled')
            ->where('appointments.date','=',$today)
            ->paginate(10);


        return view('faculty.home')->with('appointments',$appointments);
    }
}
