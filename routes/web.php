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
Route::get('/faculty/home', 'FacultyHomeController@index')->name('faculty.home');

Route::get('/schedules/add', 'ScheduleController@index')->name('schedule.add');
Route::post('/schedules/store', 'ScheduleController@store')->name('schedule.store');

Route::get('/appointments/add', 'AppointmentController@index')->name('appointment.add');
Route::get('/findFaculty', 'AppointmentController@findFaculty')->name('appointment.findFaculty');
Route::get('/searchFaculty', 'AppointmentController@searchFaculty')->name('appointment.searchFaculty');
Route::get('/findSlots', 'AppointmentController@findSlots')->name('appointment.findSlots');
Route::post('/appointments/store', 'AppointmentController@store')->name('appointment.store');

Route::get('/findAppointments', 'AppointmentController@findAppointments')->name('appointment.findAppointments');
Route::get ('/student/{id}', 'StudentController@showInfo')->name('student.info');
Route::get ('/faculty/{id}', 'FacultyController@showInfo')->name('faculty.info');


Route::post ('/appointments', 'AppointmentController@showInfo')->name('student.appointments');
Route::post ('/faculties', 'FacultyController@showInfo')->name('student.faculties');
Route::post ('/profile', 'FacultyController@showInfo')->name('student.profile');

Route::post ('/faculty/appointments', 'AppointmentController@showInfo')->name('faculty.appointments');
Route::post ('/faculty/schedule', 'FacultyController@showInfo')->name('faculty.schedule');
Route::post ('/faculty/profile', 'FacultyController@showInfo')->name('faculty.profile');
