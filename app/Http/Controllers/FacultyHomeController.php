<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $appointments = DB::table('appointments')
            ->join('students', 'appointments.s_id', '=', 'students.s_id')
            ->select('appointments.*','students.name', 'students.email', 'students.phone')
            ->where('appointments.f_id','=',Auth::user()->f_id)
            ->where('appointments.status','=','pending')
            ->paginate(10);


        return view('faculty.home')->with('appointments',$appointments);
    }
}
