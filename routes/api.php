<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('AuthApi')->group(function () {
    Route::post('/set-ticket', 'Api\TicketController@generate')->name('set-ticket');
    Route::post('/admin/create', 'Api\UserAPIController@createAdmin')->name('api.admin.create');
    Route::post('/admin/delete', 'Api\UserAPIController@deleteAdmin')->name('api.admin.delete');
    Route::post('/employer/create', 'Api\UserAPIController@createEmployer')->name('api.employer.create');
    Route::post('/employer/delete', 'Api\UserAPIController@deleteEmployer')->name('api.employer.delete');
    Route::post('/user/delete', 'Api\UserAPIController@deleteUser')->name('api.employer.delete');
	Route::get('/user/id', 'Api\UserAPIController@GetUserById')->name('api.GetUser.ById');
	Route::get('/user/tickets', 'Api\UserAPIController@GetTickets')->name('api.GetTickets.All');
    Route::get('/user/valid_tickets', 'Api\UserAPIController@GetAllTicket')->name('api.GetAllTickets');
});
