<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Dotenv\Exception\ValidationException;

class StudentController extends Controller
{
    //

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
    public function appointments()
    {

        $appointments = DB::table('appointments')
            ->join('faculties', 'appointments.f_id', '=', 'faculties.f_id')
            ->select('appointments.*','faculties.name', 'faculties.email','faculties.photo', 'faculties.phone')
            ->paginate(10);


        return view('student.appointments')->with('appointments',$appointments);
    }

    public function profile(){

        $student=DB::table('students')
            ->select('*')
            ->where('s_id','=',Auth::user()->s_id)
            ->first();
        return view('student.profile')->with('student',$student);
    }

    public function editProfileForm(){

        $student=DB::table('students')
            ->select('*')
            ->where('s_id','=',Auth::user()->s_id)
            ->first();

        return view('student.editProfile')->with('student',$student);;
    }

    public function editProfile(Request $request)
        {
            $validation = Validator::make($request->all(), [
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                's_id' => 'required',
                'name' => 'required',
                'department' => 'required',
                'phone' => 'required',
            ]);
            if($validation->fails())
            {

                return back()->with('error','Required fields are missing!');

//                return response()->json([
//                    'message'   => $validation->errors()->all(),
//                    'type'  => 'error',
//                ]);
            }
            else
            {

                $s_id=Auth::user()->s_id;

                $student=Student::select('*')
                    ->where('s_id','=',$s_id)
                    ->first();

                $image_path= $student->photo;

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $image_name = Auth::user()->name . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $image_name);

                    $image_path='/images/' . $image_name;
                }

                $student->name=$request->name;
                $student->department=$request->department;
                $student->phone=$request->phone;
                $student->photo=$image_path;
                $student->bio=$request->bio;
                $student->save();


                return back()->with('success','Profile Successfully Updated');

//                return response()->json([
//                    'message'   => 'Profile Successfully Updated',
//                    'image_src' => '/images/'.$image_name,
//                    'type'  => 'success'
//                ]);
            }
    }

    public function viewFacultyInfo($id){

        $faculty=DB::table('faculties')
            ->select('*')
            ->where('f_id','=',$id)
            ->first();

        return view('student.viewFacultyProfile',compact('faculty'));
    }

    public function faculties(){

        $faculties=DB::table('faculties')
            ->select('*')
            ->paginate(12);

        return view('student.facultyMembers',compact('faculties'));
    }

}
