<?php

use Illuminate\Http\Request;

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

//Route::post('login', 'API\UserController@login');
//Route::post('register', 'API\UserController@register');
//
//Route::group(['middleware' => 'auth:api'], function(){
//
//    Route::post('details', 'API\UserController@details');
//
//});


Route::post('register', 'ApiUseController@register');

Route::post('login', 'ApiUseController@login');

Route::post('book', 'ApiUseController@book');

Route::get('vehicle', 'ApiUseController@allVehicles');

Route::get('service', 'ApiUseController@allServices');

Route::get('package', 'ApiUseController@allPackages');

Route::get('branch', 'ApiUseController@allBranches');

Route::get('branch/{id}', 'ApiUseController@BranchDetails');

Route::get('bookDetails/{id}', 'ApiUseController@BookingDetails');

Route::get('profile/{id}', 'ApiUseController@profileDetails');