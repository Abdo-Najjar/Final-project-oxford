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

    //cruds operations
    Route::apiResource('applications', 'ApplicationController')->except('update');

    //cruds section
    Route::apiResource('sections', 'SectionController');

    //assign student to class (Section)
    Route::put('sections/{section}/assign/{user}/user' , 'SectionController@assign')->name('sections.assign');

    //fire fire from class (Section)
    Route::delete('sections/{section}/fire/{user}/user' , 'SectionController@fire')->name('sections.fire');

    //delete advertisements
    Route::delete('advertisements/{advertisement}', 'AdvertisementController@destroy')->name('advertisements.destroy');

    //store advertisements
    Route::post('advertisements', 'AdvertisementController@store')->name('advertisements.store');

    //store student
    Route::post('users' , 'UserController@store')->name('users.store');

    //get teachers
    Route::get('teachers' , 'UserController@teachers')->name('teachers.index');

    //fees
    // Route::put('fees' , )
});


//user profile
Route::get('/users/{user}', 'UserController@user');

//get coursetypes
Route::get('coursetype' , 'CourseTypeController@index');

//guest
Route::get('advertisements', 'AdvertisementController@index')->name('advertisements.index');

//show course details for that advertisement
Route::get('advertisements/{course}/course', 'AdvertisementController@show')->name('advertisements.show');

//store an application
Route::post('applications', 'ApplicationController@store')->name('applications.store');
