<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyHomeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:faculty');
    }

    public function index()
    {
        return view('faculty_home');
    }
}
