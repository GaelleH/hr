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
Route::get('/changePassword','HomeController@showChangePasswordForm')->name('changePassword');