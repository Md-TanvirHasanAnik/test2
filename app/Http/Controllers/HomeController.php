<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $appointments = DB::table('appointments')
            ->join('faculties', 'appointments.f_id', '=', 'faculties.f_id')
            ->select('appointments.*','faculties.name', 'faculties.email', 'faculties.phone')
            ->where('appointments.status','=','pending')
            ->get();


        return view('student.home')->with('appointments',$appointments);
    }
}
