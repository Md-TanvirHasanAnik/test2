<?php

namespace App\Http\Controllers\Auth;

use App\Student;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            's_id' => ['required', 'string', 'max:255','unique:students'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students','regex:/(.*)diu\.edu\.bd$/i'],
            'phone' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'campus' => ['required'],
            'level_term' => ['required'],
            'photo' => ['string', 'max:255'],
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

        return Student::create([
            'name' => $data['name'],
            's_id' => $data['s_id'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'department' => $data['department'],
            'campus' => $data['campus'],
            'level_term' => $data['level_term'],
            'photo' => '/images/default.jpg',
            'password' => Hash::make($data['password']),
        ]);
    }

}
