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

Route::get('/studentform',  'StudentController@create')->name('studentform');
Route::post('/studentreg', 'StudentController@store');
Route::get('/student', 'StudentController@index')->name('student');
Route::get('/student/profile', 'StudentController@show');
Route::get('/student/profile/edit', 'StudentController@edit');
Route::get('/student/profile/org/edit', 'StudentController@editorg');
Route::get('/student/profile/org/add', 'StudentController@add');
Route::get('/student/org', 'StudentController@org');
Route::post('/student/org/add', 'StudentController@addorg');
Route::get('/student/org/edit', 'StudentController@orgedit');
// Route::post('/student/org/edit', 'StudentController@updateorg');

Route::get('/student/log', 'LogbookController@index');


Route::get('/schoolform',  'SchoolController@create')->name('schoolform');
Route::post('/schoolreg', 'SchoolController@store');
Route::get('/school', 'SchoolController@index')->name('school');

Route::get('/industryform',  'IndustryController@create')->name('industryform');
Route::post('/industryreg', 'IndustryController@store');
Route::post('/industry/orgreg', 'IndustryController@orgstore');
Route::get('/industry/org/edit', 'IndustryController@edit');
Route::get('/industry', 'IndustryController@index')->name('industryhome');
Route::get('/industry/org', 'IndustryController@org');
Route::get('/industry/student', 'IndustryController@student');
