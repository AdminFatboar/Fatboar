<?php

use Illuminate\Support\Facades\Route;

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




Route::post('/test', 'Auth\LoginController@test')->name('test');

Auth::routes();

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('login/google', 'Auth\LoginController@Provider');
Route::get('/googlecallback', 'Auth\LoginController@Callback');

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/once', 'HomeController@once')->name('once');

Route::match(['get', 'post'], '/employer/login', 'EmployerController@login')->name('employer.login');
Route::group(['middleware' => ['employer']], function () {
    Route::match(['get', 'post'], '/employer/page1', 'EmployerController@page1')->name('employer.page1');
    Route::post('employer/validate', 'EmployerController@validate_ticket')->name('employer.validate');
});

Route::group(['middleware' => ['auth']], function () {
    Route::match(['get', 'post'], '/competition', 'HomeController@competition')->name('competition');
    Route::match(['get', 'post'], '/profile', 'HomeController@userProfile')->name('user.profile');
    Route::post('/profile/delete', 'HomeController@deleteProfile')->name('user.delete');
});
Route::get('/', 'HomeController@competition')->name('home');


Route::match(['get', 'post'], '/admin/login', 'AdminController@login')->name('admin.login');
Route::group(['middleware' => ['admin']], function () {
    Route::match(['get', 'post'], '/admin/page1', 'AdminController@page1')->name('admin.page1');
    Route::post('admin/draw', 'AdminController@draw')->name('admin.draw');

    Route::post('admin/reset-stats', 'AdminController@resetStats')->name('admin.resetStats');
    Route::post('admin/reset-tirage', 'AdminController@resetTirage')->name('admin.resetTirage');
    Route::post('admin/delete-user', 'AdminController@deleteUser')->name('admin.resetTirage');
    Route::post('admin/delete-employer', 'AdminController@deleteEmployer')->name('admin.deleteEmployer');
    Route::post('admin/delete-admin', 'AdminController@deleteAdmin')->name('admin.deleteAdmin');
    Route::post('admin/create-admin', 'AdminController@createAdmin')->name('admin.createAdmin');
    Route::post('admin/create-employer', 'AdminController@createEmployer')->name('admin.createEmployer');

    Route::post('admin/compteur', 'AdminController@validTickets')->name('admin.validTickets');
    Route::get('admin/export/', 'AdminController@export');
});

Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@changePassword')->name('change.password');
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/cgu', 'HomeController@cgu')->name('cgu');
Route::get('/mentions', 'HomeController@mentions')->name('mentions');
Route::get('/confidentialite', 'HomeController@confidentialite')->name('confidentialite');
Route::get('/cookies', 'HomeController@cookies')->name('cookies');
Route::get('/kpi', 'AdminController@kpi')->name('kpi');
Route::permanentRedirect('/employer', '/employer/login');
Route::permanentRedirect('/admin', '/admin/login');
Route::permanentRedirect('/home', '/competition');


Route::post('subscribe','SubscriptionController@store')->name('subscribe');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
