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

// Route::get('/', function () {
//return view('welcome');
// });
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');


Route::get('/success','attendanceController@index')->name('index')->middleware('auth');

Route::get('/attendance/{admin_id}', 'attendanceController@attendance')->name('attendance')->middleware('auth');
Route::get('/attendanceedit', 'attendanceController@attendanceEdit')->name('attendanceEdit')->middleware('auth');
Route::post('/attendanceeditSup', 'attendanceController@attendanceEditBySup')->name('attendanceEditBySup')->middleware('auth');
Route::get('/attendanceeditSup', 'attendanceController@attendanceEditBySup')->name('attendanceEditBySup')->middleware('auth');

Route::get('/attendancedetails', 'attendanceController@attendancedetails')->name('attendancedetails')->middleware('auth');
// Route::get('/attendancedetails-selected', 'attendanceController@attendancedetailsByDay')->name('attendancedetailsSelected')->middleware('auth');

Route::get('/attendancedetails-for-supervisor/{user_id}', 'attendanceController@attendancedetailsForSupervisor')->name('attendancedetailsForSupervisor')->middleware('auth');
Route::post('/attendancedetails-by-day', 'attendanceController@attendancedetailsByDay')->name('attendancedetailsByDay')->middleware('auth');
Route::post('/attendancedetails-by-day-sup/{user_id}', 'attendanceController@attendancedetailsByDaySupervisor')->name('attendancedetailsByDaySupervisor')->middleware('auth');

Route::post('/submit-attendance/{user_id}',['uses'=>'attendanceController@submitAttendance','as' =>'submitAttendance'])->middleware('auth');
Route::post('/submit-attendance-update',['uses'=>'attendanceController@submitAttendanceUpdate','as' =>'submitAttendanceUpdate'])->middleware('auth');
//Route::get('/addemployee', 'attendanceController@addemployee')->name('addemployee');


Route::get('/add-supervisor',['uses'=>'attendanceController@addSupervisor','as' =>'addSupervisor'])->middleware('auth');
Route::post('/new-supervisor',['uses'=>'attendanceController@newSupervisor','as' =>'newSupervisor'])->middleware('auth');
Route::get('/view-supervisor',['uses'=>'attendanceController@viewSupervisor','as' =>'viewSupervisor'])->middleware('auth');
Route::post('/view-supervisor/update/{id}',['uses'=>'attendanceController@updateSupervisor','as' =>'updateSupervisor'])->middleware('auth');
Route::post('/view-supervisor/delete/{id}',['uses'=>'attendanceController@deleteSupervisor','as' =>'deleteSupervisor'])->middleware('auth');

Route::get('/add-employee',['uses'=>'attendanceController@addemployee','as' =>'addemployee'])->middleware('auth');
Route::post('/new-employee',['uses'=>'attendanceController@newEmployee','as' =>'newEmployee'])->middleware('auth');
Route::get('/employeelist/{admin_id}', 'attendanceController@employeelist')->name('employeelist')->middleware('auth');
Route::post('/employeelist/update/{id}', 'attendanceController@updateEmployee')->name('updateEmployee')->middleware('auth');
Route::post('/employeelist/delete/{id}', 'attendanceController@deleteEmployee')->name('deleteEmployee')->middleware('auth');

Route::get('/employeelist-admin', 'attendanceController@employeelistForAdmin')->name('employeelistForAdmin')->middleware('auth');
Route::post('/employeelist-admin', 'attendanceController@employeelistForAdminZone')->name('employeelistForAdminZone')->middleware('auth');

Route::get('/add-zone',['uses'=>'attendanceController@addZone','as' =>'addZone'])->middleware('auth');
Route::post('/new-zone',['uses'=>'attendanceController@newZone','as' =>'newZone'])->middleware('auth');
Route::get('/view-zone',['uses'=>'attendanceController@viewZone','as' =>'viewZone'])->middleware('auth');
Route::post('/view-zone/edit/{id}', ['uses' => 'attendanceController@updateZone', 'as' => 'updateZone'])->middleware('auth');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
