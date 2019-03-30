<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        $faculty=DB::table('faculties')
            ->select('*')
            ->where('f_id','=',Auth::user()->f_id)
            ->first();

        return view('faculty.profile')->with('faculty',$faculty);
    }
    public function editProfileForm(){

        $faculty=DB::table('faculties')
            ->select('*')
            ->where('f_id','=',Auth::user()->f_id)
            ->first();

        return view('faculty.editProfile')->with('faculty',$faculty);

    }

public function editProfile(Request $request){
        $validation = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'f_id' => 'required',
            'name' => 'required',
            'faculty' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'phone' => 'required',
        ]);
        if($validation->fails())
        {

            return back()->with('error','Required fields are missing!');

//            return response()->json([
//                'message'   => $validation->errors()->all(),
//                'type'  => 'error',
//            ]);
        }
        else {



            $f_id = Auth::user()->f_id;

            $faculty = Faculty::select('*')
                ->where('f_id', '=', $f_id)
                ->first();

            $image_path= $faculty->photo;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = Auth::user()->name . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $image_name);

                $image_path='/images/' . $image_name;
            }

            $faculty->name = $request->name;
            $faculty->faculty = $request->faculty;
            $faculty->department = $request->department;
            $faculty->designation = $request->designation;
            $faculty->phone = $request->phone;
            $faculty->photo = $image_path;
            $faculty->bio=$request->bio;
            $faculty->save();


            return back()->with('success', 'Profile Successfully Updated');

//                return response()->json([
//                    'message'   => 'Profile Successfully Updated',
//                    'image_src' => '/images/'.$image_name,
//                    'type'  => 'success'
//                ]);
        }
    }



    public function viewStudentInfo($id){

        $student=DB::table('students')
            ->select('*')
            ->where('s_id','=',$id)
            ->first();

        $visitor="guest";

        return view('faculty.viewStudentProfile',compact('student','visitor'));
    }

    public function schedules(){
        $slots=TimeSlot::all();
        // return $slots;
        return view('faculty.schedule')->with('slots',$slots);
    }
}
