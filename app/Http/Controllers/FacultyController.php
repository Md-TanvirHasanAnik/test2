<?php

namespace App\Http\Controllers;

use App\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacultyController extends Controller
{
    //


    /**
     * Create a new controller instance.
     *
     * @return void
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
    public function appointments()
    {
        $appointments = DB::table('appointments')
            ->join('students', 'appointments.s_id', '=', 'students.s_id')
            ->select('appointments.*','students.name', 'students.email', 'students.phone')
            ->paginate(10);

        return view('faculty.appointments')->with('appointments',$appointments);
    }
    public function profile(){
        return view('faculty.profile');
    }
    public function editProfile(){
        return view('faculty.editProfile');
    }

    public function schedules(){
        $slots=TimeSlot::all();
        // return $slots;
        return view('faculty.schedule')->with('slots',$slots);
    }
}
