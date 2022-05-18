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
Route::get('/student', 'StudentController@index')->name('student')->middleware('student');
Route::get('/student/profile', 'StudentController@show')->middleware('student');

Route::get('/schoolform',  'SchoolController@create')->name('schoolform');
Route::post('/schoolreg', 'SchoolController@store');
Route::get('/school', 'SchoolController@index')->name('school')->middleware('school');

Route::get('/industryform',  'IndustryController@create')->name('industryform');
Route::post('/industryreg', 'IndustryController@store');
Route::get('/industry', 'IndustryController@index')->name('industryhome')->middleware('industry');
