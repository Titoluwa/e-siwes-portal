<?php

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

    Route::get('industry', 'IndustryController@create')->name('industryform');
    Route::post('industry', 'IndustryController@store');

    Route::get('school', 'SchoolController@create')->name('schoolform');
    Route::post('school', 'SchoolController@store');
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
    Route::delete('log/daily/{id}', 'LogbookController@destroy_daily');

    Route::post('/log/weekly', 'LogbookController@store_weekly');
    Route::get('/log/weekly/{id}', 'LogbookController@show_week');
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
});

    // SCHOOL Routes
Route::prefix('school')->group(function () 
{
    Route::get('', 'SchoolController@index')->name('school');
});