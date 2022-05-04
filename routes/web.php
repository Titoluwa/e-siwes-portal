<?php

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

Route::get('/student',  'StudentController@create')->name('student');
Route::post('/studentreg', 'StudentController@store');

Route::get('/school',  'SchoolController@create')->name('school');
Route::post('/schoolreg', 'SchoolController@store');

Route::get('/industry',  'IndustryController@create')->name('industry');
Route::post('/industryreg', 'IndustryController@store');

Route::get('/home', 'HomeController@index')->name('home');
