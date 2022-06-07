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

    // REGISTRATION Routes *change to prefix form and reg*
Route::get('/studentform',  'StudentController@create')->name('studentform');
Route::post('/studentreg', 'StudentController@store');
Route::get('/schoolform',  'SchoolController@create')->name('schoolform');
Route::post('/schoolreg', 'SchoolController@store');
Route::get('/industryform',  'IndustryController@create')->name('industryform');
Route::post('/industryreg', 'IndustryController@store');

    // STUDENT Routes 
Route::prefix('student')->group(function () {
    Route::get('', 'StudentController@index')->name('student');
    Route::get('/profile', 'StudentController@show');
    Route::get('/profile/edit', 'StudentController@edit');
    
    Route::get('/org', 'StudentController@org');
    Route::post('/org/add', 'StudentController@orgadd');
    // Route::get('/org/edit', 'StudentController@orgedit');

    Route::get('/profile/org/edit', 'StudentController@editorg');

   
    Route::get('/org/edit', 'StudentController@orgedit');
    // Route::post('/student/org/edit', 'StudentController@updateorg');
    Route::get('/log', 'LogbookController@index');
});

    //INDUSTRY Routes
Route::prefix('industry')->group(function () {
    Route::get('', 'IndustryController@index')->name('industry');
    Route::post('/orgreg', 'IndustryController@orgstore');
    Route::get('/org/edit', 'IndustryController@edit');
    Route::get('/org', 'IndustryController@org');
    Route::get('/student', 'IndustryController@student');
});

    // SCHOOL Routes
Route::prefix('school')->group(function () {
    Route::get('', 'SchoolController@index')->name('school');
});
