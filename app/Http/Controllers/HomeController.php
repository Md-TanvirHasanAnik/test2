<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

          $today = Carbon::now()->setTimezone('Asia/Dhaka')->format('Y-m-d');

        $appointments = DB::table('appointments')
            ->join('faculties', 'appointments.f_id', '=', 'faculties.f_id')
            ->select('appointments.*','faculties.name', 'faculties.email','faculties.photo', 'faculties.phone')
            ->where('appointments.status','!=','cancelled')
            ->where('appointments.date','=',$today)
            ->where('appointments.s_id','=',Auth::user()->s_id)
            ->paginate(10);


        return view('student.home')->with('appointments',$appointments);
        
    }
}
