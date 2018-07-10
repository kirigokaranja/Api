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

/*Branch Information*/
Route::get('/Branch', 'ViewsController@showAddBranchForm');

Route::post('/Branch', 'AddEditController@addBranch');

Route::get('/Branches', 'ViewsController@showallBranches');

Route::get('/Branch/View/{id}', 'ViewsController@viewSpecificBranch');


/*Manager Information*/
Route::get('/Manager', 'ViewsController@showAddManagerForm');

Route::post('/Manager', 'AddEditController@addManager');

Route::get('/Managers', 'ViewsController@showallManagers');

Route::get('/Manager/View/{id}', 'ViewsController@viewSpecificManager');


/*Vehicle Information*/
Route::get('/Vehicle', 'ViewsController@showAddVehicleForm');

Route::post('/Vehicle', 'AddEditController@addVehicle');

Route::get('/Vehicles', 'ViewsController@showallVehicles');

Route::get('/Vehicle/View/{id}', 'ViewsController@viewSpecificVehicle');


/*Package Information*/
Route::get('/Package', 'ViewsController@showAddPackageForm');

Route::post('/Package', 'AddEditController@addPackage');

Route::get('/Packages', 'ViewsController@showallPackages');

Route::get('/Package/View/{id}', 'ViewsController@viewSpecificPackage');


/*Additional Services Information*/
Route::get('/Service', 'ViewsController@showAddServiceForm');

Route::post('/Service', 'AddEditController@addService');

Route::get('/Services', 'ViewsController@showallServices');

Route::get('/Service/View/{id}', 'ViewsController@viewSpecificService');



/* Washer Information*/
Route::get('/Washer', 'ViewsController@showAddWasherForm');

Route::post('/Washer', 'AddEditController@addWasher');

Route::get('/Washers', 'ViewsController@showallWashers');

Route::get('/Washer/View/{id}', 'ViewsController@viewSpecificWasher');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/Login', 'AddEditController@login');

Route::get('/login', 'ViewsController@login');

Route::get('/logout','AddEditController@logout');

Route::get('/confirmWash', 'BookingsController@confirmWash');

Route::get('/assignWasher', 'BookingsController@showBookings');

Route::get('/confirmPayment', 'BookingsController@confirmPay');

Route::get('/assignWasher/View/{id}', 'BookingsController@viewSpecificBooking');

Route::post('assign/{id}', 'BookingsController@AssignWasher');

Route::post('cwash/{id}', 'BookingsController@confirm');

Route::post('pay/{id}', 'BookingsController@payment');
