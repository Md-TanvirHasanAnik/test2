<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get ('login_faculty', 'AuthFaculty\LoginController@showLoginForm')->name('login.faculty');
Route::post ('login_faculty', 'AuthFaculty\LoginController@login'); 
Route::post ('logout_faculty', 'AuthFaculty\LoginController@logout')->name('logout.faculty');
Route::post ('password_faculty/email',  'AuthFaculty\ForgotPasswordController@sendResetLinkEmail'); 
Route::get ('password_faculty/reset', 'AuthFaculty\ForgotPasswordController@showLinkRequestForm')->name('password.faculty.reset');
Route::post ('password_faculty/reset', 'AuthFaculty\ResetPasswordController@reset');       
Route::get ('password_faculty/reset/{token}', 'AuthFaculty\ResetPasswordController@showResetForm'); 
Route::get ('register_faculty', 'AuthFaculty\RegisterController@showRegistrationForm')->name('register.faculty');
Route::post ('register_faculty',  'AuthFaculty\RegisterController@register');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/faculty_home', 'FacultyHomeController@index')->name('faculty.home');

Route::get('/schedule', 'ScheduleController@index');
Route::post('store', 'ScheduleController@store')->name('store');

Route::get('/appointment', 'AppointmentController@index');
Route::get('/findFaculty', 'AppointmentController@findFaculty')->name('faculty.find');
Route::get('/searchFaculty', 'AppointmentController@searchFaculty')->name('faculty.search');
Route::get('/findSlots', 'AppointmentController@findSlots')->name('faculty.slots');

