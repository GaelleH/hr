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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resources([
    'users' => 'UserController',
    'user_functions' => 'UserFunctionController',
    'absences' => 'AbscencesYearController',
    'absence' => 'AbsenceController',
    'absence-types' => 'AbsenceTypeController',
]);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/my-absence', 'AbsenceController@myAbsence')->name('myAbsence');
Route::get('/unapproved-absence', 'AbsenceController@unapprovedAbsences')->name('unapprovedAbsences');
Route::get('/unapproved-absence/{id}', 'AbsenceController@absence')->name('toApprove');
Route::post('/unapproved-absence/{id}', 'AbsenceController@notApproved')->name('notApproved');
Route::put('/unapproved-absence/{id}', 'AbsenceController@approved')->name('approve');
Route::get('/changePassword','HomeController@showChangePasswordForm')->name('changePassword');