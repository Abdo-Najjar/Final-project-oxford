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

    //home page data for admin
    Route::get('dashboard/home', 'HomeController@home')->name('dashboard.home');

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
    Route::put('sections/{section}/assign/{user}/user', 'SectionController@assign')->name('sections.assign');

    //fire fire from class (Section)
    Route::delete('sections/{section}/fire/{user}/user', 'SectionController@fire')->name('sections.fire');

    //delete advertisements
    Route::delete('advertisements/{advertisement}', 'AdvertisementController@destroy')->name('advertisements.destroy');

    //store advertisements
    Route::post('advertisements', 'AdvertisementController@store')->name('advertisements.store');

    //store student
    Route::post('users', 'UserController@store')->name('users.store');

    //get teachers
    Route::get('teachers', 'UserController@teachers')->name('teachers.index');

    // return all sections that teacher has 
    Route::get('teachers/sections' , 'UserController@sections')->name('teachers.sections');

    //get students
    Route::get('students', 'UserController@students')->name('students.index');

    // get classes for student
    Route::get('my-classes' , 'UserController@myClasses')->name('students.classes');

    
    //get students related with a classtype
    Route::get('students/{courseType}/coursetypes', 'UserController@studentsInCourseType')->name('students.studentsInCourseType');

    //get students related with a section
    Route::get('students/{section}/sections', 'UserController@studentsInSection')->name('students.studentsInSection');

    //store fees
    Route::put('fees/{user}/users/{section}/sections', 'FeeController@store')->name('fee.store');

    //show fee
    Route::get('fees/{user}/users/{section}/sections', 'FeeController@show')->name('fee.show');

    //store evaluation for student
    Route::put('evaluations/{user}/students/{section}/sections', 'EvaluationController@evaluateStudent')->name('evaluations.evaluateStudent');
    
    //show student evaluation
    Route::get('evaluations/{user}/students/{section}/sections', 'EvaluationController@showStudentEvaluation')->name('evaluations.showStudentEvaluation');

    // store evaluation for section
    Route::put('evaluations/{section}/sections' , 'EvaluationController@evaluateSection')->name('evaluations.section');

    // store evaluation for teacher
    Route::put('evaluations/{user}/teacher' , 'EvaluationController@evaluateTeacher')->name('evaluations.teacher');

    Route::get('teachers/evaluation' , 'EvaluationController@showTeacherEvaluation')->name('evaluations.teachers.show');

    // paginate media   
    Route::get('media' , 'MassMediaController@index')->name('media.index');

    // paginate media for all 
    Route::get('media/{courseType}/courseType' , 'MassMediaController@courseTypeIndex')->name('media.courseTypeIndex');

    Route::get('media/{courseType}/courseType/video' , 'MassMediaController@courseTypeVideo')->name('media.courseTypeVideoIndex');

    Route::get('media/{courseType}/courseType/audio' , 'MassMediaController@courseTypeAudio')->name('media.courseTypeAudioIndex');
    //show media
    Route::get('media/{massMedia}' , 'MassMediaController@show')->name('media.show');
});


//user profile
Route::get('/users/{user}', 'UserController@user');

//get coursetypes
Route::get('coursetype', 'CourseTypeController@index');

//guest
Route::get('advertisements', 'AdvertisementController@index')->name('advertisements.index');

//show course details for that advertisement
Route::get('advertisements/{course}/course', 'AdvertisementController@show')->name('advertisements.show');

//store an application
Route::post('applications', 'ApplicationController@store')->name('applications.store');
