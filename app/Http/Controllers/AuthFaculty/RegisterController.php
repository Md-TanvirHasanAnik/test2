<?php

namespace App\Http\Controllers\AuthFaculty;

use App\Faculty;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/faculty/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:faculty');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'f_id' => ['required', 'string', 'max:255','unique:faculties'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:faculties','regex:/(.*)diu\.edu\.bd$/i'],
            'phone' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
             'designation' => ['required', 'string', 'max:255'],
            'faculty' => ['string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return Faculty::create([
            'name' => $data['name'],
            'f_id' => $data['f_id'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'department' => $data['department'],
              'designation' => $data['designation'],
            'faculty' => $data['faculty'],
            'photo' => '/images/default.jpg',
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('authFaculty.register');
    }

   

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('faculty');
    }
}
