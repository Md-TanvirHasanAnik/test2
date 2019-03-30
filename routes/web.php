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

Route::get('/appointments/add', 'AppointmentController@appointmentForm')->name('appointment.add');
Route::get ('/appointments/edit', 'AppointmentController@edit')->name('appointment.edit');
Route::post('/appointments/store', 'AppointmentController@store')->name('appointment.store');
Route::get ('/appointments/delete', 'AppointmentController@delete')->name('appointment.delete');
Route::get ('/appointments/cancel', 'AppointmentController@cancel')->name('appointment.cancel');
Route::post ('/appointments/update', 'AppointmentController@update')->name('appointment.update');

Route::get('/ajax/findFaculty', 'AjaxDataController@findFaculty')->name('ajax.findFaculty');
Route::get('/ajax/searchFaculty', 'AjaxDataController@searchFaculty')->name('ajax.searchFaculty');
Route::get('/ajax/findSlots', 'AjaxDataController@findSlots')->name('ajax.findSlots');
Route::get('/ajax/findAppointments', 'AjaxDataController@findAppointments')->name('ajax.findAppointments');
Route::get ('/ajax/studentAppointments', 'AjaxDataController@studentAppointments')->name('ajax.studentAppointments');
Route::get ('/ajax/findSchedule', 'AjaxDataController@findSchedule')->name('ajax.findSchedule');

Route::get ('/faculties/{id}', 'StudentController@viewFacultyInfo')->name('student.facultyInfo');
Route::get ('/students/{id}', 'FacultyController@viewStudentInfo')->name('faculty.studentInfo');


Route::get ('/appointments', 'AppointmentController@index')->name('student.appointments');
Route::get ('/faculties', 'StudentController@faculties')->name('student.faculties');
Route::get ('/profile', 'StudentController@profile')->name('student.profile');
Route::get ('/profile/edit', 'StudentController@editProfileForm')->name('student.editProfileForm');
Route::post ('/profile/edit', 'StudentController@editProfile')->name('student.editProfile');


//Route::get ('/faculty/schedules', 'FacultyController@schedules')->name('faculty.schedule');
Route::get ('/faculty/profile', 'FacultyController@profile')->name('faculty.profile');
Route::get ('/faculty/appointments', 'FacultyAppointmentController@index')->name('faculty.appointments');
Route::get ('/faculty/profile/edit', 'FacultyController@editProfileForm')->name('faculty.editProfileForm');
Route::post ('/faculty/profile/edit', 'FacultyController@editProfile')->name('faculty.editProfile');

Route::get('/faculty/appointments/add', 'FacultyAppointmentController@appointmentForm')->name('facultyAppointment.add');
Route::get ('/faculty/appointments/edit', 'FacultyAppointmentController@edit')->name('facultyAppointment.edit');
Route::post('/faculty/appointments/store', 'FacultyAppointmentController@store')->name('facultyAppointment.store');
Route::get ('/faculty/appointments/update', 'FacultyAppointmentController@changeStatus')->name('facultyAppointment.changeStatus');
Route::get ('/faculty/appointments/cancel', 'FacultyAppointmentController@cancel')->name('facultyAppointment.cancel');
Route::post ('/faculty/appointments/update', 'FacultyAppointmentController@update')->name('facultyAppointment.update');
