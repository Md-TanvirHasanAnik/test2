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


Route::get ('faculty/login', 'AuthFaculty\LoginController@showLoginForm')->name('login.faculty');
Route::post ('faculty/login', 'AuthFaculty\LoginController@login');
Route::post ('faculty/logout', 'AuthFaculty\LoginController@logout')->name('logout.faculty');
Route::post ('faculty/password/email',  'AuthFaculty\ForgotPasswordController@sendResetLinkEmail');
Route::get ('faculty/password/reset', 'AuthFaculty\ForgotPasswordController@showLinkRequestForm')->name('password.faculty.reset');
Route::post ('faculty/password/reset', 'AuthFaculty\ResetPasswordController@reset');
Route::get ('faculty/password/reset/{token}', 'AuthFaculty\ResetPasswordController@showResetForm');
Route::get ('faculty/register', 'AuthFaculty\RegisterController@showRegistrationForm')->name('register.faculty');
Route::post ('faculty/register',  'AuthFaculty\RegisterController@register');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/faculty/home', 'FacultyHomeController@index')->name('faculty.home');

Route::get('/schedules', 'ScheduleController@index')->name('faculty.schedule');
Route::post('/schedules/store', 'ScheduleController@store')->name('faculty.schedule.store');

Route::get('/appointments/add', 'AppointmentController@index')->name('appointment.add');
Route::get('/findFaculty', 'AppointmentController@findFaculty')->name('appointment.findFaculty');
Route::get('/searchFaculty', 'AppointmentController@searchFaculty')->name('appointment.searchFaculty');
Route::get('/findSlots', 'AppointmentController@findSlots')->name('appointment.findSlots');
Route::post('/appointments/store', 'AppointmentController@store')->name('appointment.store');
Route::get('/findAppointments', 'AppointmentController@findAppointments')->name('appointment.findAppointments');

Route::get ('/students/{id}', 'StudentController@showInfo')->name('student.info');
Route::get ('/faculties/{id}', 'FacultyController@showInfo')->name('faculty.info');


Route::get ('/appointments', 'StudentController@appointments')->name('student.appointments');
Route::get ('/faculties', 'StudentController@faculties')->name('student.faculties');
Route::get ('/profile', 'StudentController@profile')->name('student.profile');
Route::get ('/profile/edit', 'StudentController@editProfile')->name('student.editProfile');


//Route::get ('/faculty/schedules', 'FacultyController@schedules')->name('faculty.schedule');
Route::get ('/faculty/profile', 'FacultyController@profile')->name('faculty.profile');
Route::get ('/faculty/appointments', 'FacultyController@appointments')->name('faculty.appointments');
Route::get ('/faculty/profile/edit', 'FacultyController@editProfile')->name('faculty.editProfile');
