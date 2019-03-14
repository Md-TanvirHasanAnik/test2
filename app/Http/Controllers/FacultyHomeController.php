<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
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
            ->join('users', 'appointments.s_id', '=', 'users.s_id')
            ->select('appointments.*','users.name', 'users.email', 'users.phone')
            ->get();


        return view('faculty_home')->with('appointments',$appointments);
    }
}
