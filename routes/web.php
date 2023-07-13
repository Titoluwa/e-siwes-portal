<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogbookController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

    // REGISTRATION Routes
Route::prefix('/register')->group(function()
{
    Route::get('student', 'StudentController@create')->name('studentform');
    Route::post('student', 'StudentController@store');

    Route::post('/dept/fetch','StudentController@dept_fetch')->name('dept.fetch');
    Route::post('/course/fetch','StudentController@course_fetch')->name('course.fetch');

    Route::get('industry', 'IndustryController@create')->name('industryform');
    Route::post('industry', 'IndustryController@store');

    Route::get('school', 'SchoolController@create')->name('schoolform');
    Route::post('school', 'SchoolController@store');
});

    // ADMIN Routes
Route::prefix('admin')->group(function ()
{
    Route::get('', 'AdminController@index')->name('adminhome');
    Route::get('setup', 'AdminController@setup')->name('admin.setup');
    Route::get('students', 'AdminController@students')->name('admin.students');
    Route::get('staffs', 'AdminController@staffs')->name('admin.staffs');
    Route::get('organizations', 'AdminController@organizations')->name('admin.orgs');
    Route::get('itf-agents', 'AdminController@itf_agents')->name('admin.itfagents');

    // Session Setup
    Route::post('setup/store', 'SessionController@store')->name('admin.setup.store');
    Route::get('setup/edit/{id}', 'SessionController@edit')->name('admin.setup.edit'); // ADD EDIT STATUS OF SESSION
    Route::put('setup/update', 'SessionController@update')->name('admin.setup.update');

    // Students
    Route::post('students/store', 'AdminController@store')->name('admin.setup.store');
    Route::get('students/{id}', 'AdminController@view_student');
    Route::get('students/log/{id}', 'AdminController@student_log');

    // Organization
    Route::get('organizations/{id}', 'AdminController@org_details');

});

    // STUDENT Routes
Route::prefix('student')->group(function ()
{
    Route::get('', 'StudentController@index')->name('student');

    Route::get('/profile', 'StudentController@show');
    Route::get('/profile/edit', 'StudentController@edit');
    Route::put('/profile/update', 'StudentController@update');
    Route::get('/profile/other/edit', 'StudentController@other_edit');
    Route::put('/profile/other/update', 'StudentController@other_update');

    Route::get('/org', 'StudentController@org');
    Route::post('/org/add', 'StudentController@org_add');
    Route::get('/org/edit', 'StudentController@org_edit');
    Route::put('/org/update', 'StudentController@org_update');

    // Student LogBook
    Route::get('/log', 'LogbookController@index');

    Route::post('/log/daily', 'LogbookController@store_daily');
    Route::get('/log/daily/{id}', 'LogbookController@show_daily');
    Route::put('/log/daily/update', 'LogbookController@update_daily');
    Route::delete('/log/daily/{id}', 'LogbookController@destroy_daily');

    Route::post('/log/weekly', 'LogbookController@store_weekly');
    Route::get('/log/weekly/{id}', 'LogbookController@show_week');
    Route::put('/log/weekly/update', 'LogbookController@update_weekly');
    Route::delete('/log/weekly/{id}', 'LogbookController@destroy_weekly');

    Route::post('/log/monthly', 'LogbookController@store_monthly');
    Route::get('/log/monthly/{id}', 'LogbookController@show_month');
    Route::put('/log/monthly/update', 'LogbookController@update_monthly');
    Route::delete('/log/monthly/{id}', 'LogbookController@destroy_monthly');
});

// SCHOOL Routes
Route::prefix('school')->group(function ()
{
    Route::get('', 'SchoolController@index')->name('school');
});

    //INDUSTRY Routes
Route::prefix('industry')->group(function ()
{
    Route::get('', 'IndustryController@index')->name('industry');

    Route::get('/org', 'IndustryController@org');
    Route::post('/org', 'IndustryController@org_store');
    Route::get('/org/edit', 'IndustryController@org_edit');
    Route::put('/org/update', 'IndustryController@org_update');

    Route::get('/profile', 'IndustryController@profile');
    Route::put('/profile/update', 'IndustryController@profile_update');

    Route::get('/student/{id}', 'IndustryController@student');
    Route::get('/student/log/{id}', 'IndustryController@student_log');

});

    // ITF Routes
Route::prefix('itf')->group(function ()
{
    Route::get('', 'ItfController@index')->name('itf');
});
