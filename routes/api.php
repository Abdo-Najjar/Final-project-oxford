<?php

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

//login 
Route::post('/sanctum/token', 'UserController@apiLogin');


Route::middleware('auth:sanctum')->group(function () {

    //logout 
    Route::post('/sanctum/logout', 'UserController@logout');


    //logout from all devices
    Route::post('/sanctum/logout/devices', 'UserController@logoutFromAllDevices');

    
    //dashbaord 
    Route::apiResource('courses', 'CourseController');
    
    Route::get('applications', 'ApplicationController@index')-> name('applications.index');
});


//user profile
Route::get('/user/{user}', 'UserController@user');

//guest
Route::get('advertisements', 'AdvertisementController@index')->name('advertisements.index');

Route::get('advertisements/{course}/course', 'AdvertisementController@show')->name('advertisements.show');

Route::post('applications', 'ApplicationController@store')->name('applications.store');
