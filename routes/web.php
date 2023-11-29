<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\PageController;
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

Route::post('/logging-out', 'Auth\LoginController@loggingOut');
Auth::routes();

Route::get('/verification', [PageController::class, 'verify']);
Route::post('/verification', [PageController::class, 'post_verify']);
Route::post('/resend-verification', [PageController::class, 'resend_verify']);

Route::post('/password/token', 'PageController@password_verify');
Route::get('/password/change', 'PageController@password_change');
Route::put('/password/confirm', 'PageController@password_confirm');

Route::get('/download/{file}', 'AdminController@material_download');

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

    // ADMIN Routes "0"
Route::prefix('admin')->group(function ()
{
    Route::get('', 'AdminController@index')->name('adminhome');
    Route::get('setup', 'AdminController@setup')->name('admin.setup');
    Route::get('students', 'AdminController@students')->name('admin.students');
    Route::get('staffs', 'AdminController@staffs')->name('admin.staffs');
    Route::get('organizations', 'AdminController@organizations')->name('admin.orgs');
    Route::get('itf-agents', 'AdminController@itf_agents')->name('admin.itfagents');

    Route::get('departments', 'AdminController@dept_create');
    Route::post('departments/store', 'AdminController@dept_store')->name('dept.store');

    Route::get('announce', 'AdminController@announce');
    Route::post('announce/store', 'AdminController@post_announcement');
    Route::get('announce/{id}', 'AdminController@get_notice');
    Route::put('announce/update', 'AdminController@edit_notice');
    Route::delete('announce/{id}', 'AdminController@delete_notice');

    Route::get('materials', 'AdminController@materials');
    Route::post('material/store', 'AdminController@store_material');
    Route::delete('material/{id}', 'AdminController@delete_material');

    // Session Setup
    Route::post('setup/store', 'SessionController@store')->name('admin.setup.store');
    Route::get('setup/edit/{id}', 'SessionController@edit')->name('admin.setup.edit'); // ADD EDIT STATUS OF SESSION
    Route::put('setup/update', 'SessionController@update')->name('admin.setup.update');

    // Students
    // Route::post('students/store', 'AdminController@store')->name('admin.setup.store');
    Route::get('students/{id}', 'AdminController@view_student');
    Route::get('students/log/{id}', 'AdminController@student_log');
    Route::put('students/update', 'AdminController@studentProfileUpdate');

    Route::get('assign-students/siwes-400', 'AdminController@siwes400Students');

    Route::get('/placement/siwes-300/{session_id}', 'AdminController@placement300perSession');
    Route::get('/placement/siwes-400/{session_id}', 'AdminController@placement400perSession');
    Route::get('/placement/swep-200/{session_id}', 'AdminController@swep200perSession');

    Route::get('/swep-200/{id}', 'AdminController@swep200');
    Route::get('/siwes-300/{id}', 'AdminController@siwes300');
    Route::get('/siwes-400/{id}', 'AdminController@siwes400');

    Route::get('/student-200/{id}', 'AdminController@student200');

    Route::post('/student/edit-itcu-score', 'AdminController@edit_itcu_score');
    Route::post('/upload-swep', 'AdminController@uploadResult');

    Route::delete('/user/deactivate/{id}', 'AdminController@deactivateUser');
    Route::delete('/user/activate/{id}', 'AdminController@activateUser');
    Route::delete('/user/logout/{id}', 'AdminController@logoutUser');

    // Organization
    Route::get('organizations/{id}', 'AdminController@org_details');
    Route::get('/contacts', 'AdminController@contacts');

    //Staff
    Route::get('/staffs/{id}', 'AdminController@get_staff');
    Route::put('staff/update', 'AdminController@updateStaff');
    Route::post('/assign-student', 'AdminController@assign_student_to_staff');

});
    // STUDENT Routes "1"
Route::prefix('student')->group(function ()
{
    Route::get('', 'StudentController@index')->name('student');

    Route::get('/profile', 'StudentController@show');
    Route::get('/profile/edit', 'StudentController@edit');
    Route::put('/profile/update', 'StudentController@update');
    Route::get('/profile/other/edit', 'StudentController@other_edit');
    Route::put('/profile/other/update', 'StudentController@other_update');
    Route::post('/bank-details/store', 'StudentController@store_bank');

    Route::get('/org', 'StudentController@org');

    Route::get('/siwes/{siwes_id}', 'StudentController@siwes_edit');
    Route::put('/siwes/update', 'StudentController@siwes_update');

    // Student LogBook

    // Logbook for SIWES 400
    Route::get('/log', 'LogbookController@index400');
    Route::post('/log/initiate', 'LogbookController@initiate_logbook');
    Route::post('/log/form8', 'LogbookController@store_form8');

    // Logbook for SWEP 200
    Route::get('/log200', 'LogbookController@index200');

    // Logbook for SIWES  300
    Route::get('/log300', 'LogbookController@index300');

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

    // SCHOOL Routes "2"
Route::prefix('school')->group(function ()
{
    Route::get('', 'SchoolController@index')->name('school');
    Route::post('/material/store', 'SchoolController@store_material');

    Route::get('/student/{id}', 'SchoolController@student');
    Route::get('/students/{session_id}/{siwes_type_id}', 'SchoolController@students');

    Route::get('/siwes-400/{user_id}', 'SchoolController@siwes400');
    Route::get('/swep-200/{user_id}', 'SchoolController@swep200');
    Route::get('/siwes-300/{user_id}', 'SchoolController@siwes300');

    Route::post('/swep-attendance/{siwes_id}', 'SchoolController@swep_attendance');

    Route::get('/swep-200/edit/{id}', 'SchoolController@swep200student');
    Route::post('/upload-swep', 'SchoolController@uploadResult');
    
    Route::post('/student/edit-swep-score', 'SchoolController@edit_swep_score');

    Route::post('/supervision/store', 'SchoolController@store_supervisionform');
    Route::put('/supervision/update/{id}', 'SchoolController@update_supervisionform');

    Route::post('/log/form8', 'SchoolController@store_form8');
    
});

    //INDUSTRY Routes "3"
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
    Route::get('/siwes-student/{id}', 'IndustryController@siwes_student');
    Route::get('/logbook/{siwes_id}', 'IndustryController@siwes_log');


    Route::post('/weekly/approve/{id}', 'IndustryController@approve_week');
    Route::put('/log/monthly/update', 'IndustryController@comment_monthly');

    Route::post('/supervision/store', [IndustryController::class, 'store_assessment']);
    Route::put('/supervision/update/{id}', [IndustryController::class, 'update_assessment']);
    Route::post('/log/form8', [IndustryController::class,'store_form8']);
});

// PDF Form downloads
Route::prefix('form')->group(function ()
{
    Route::get('/scaf/{id}', [FormController::class, 'viewdocumentSCAF']);
    Route::get('/sp3/{id}', [FormController::class, 'viewdocumentSP3']);
    Route::get('/siar/{id}', [FormController::class, 'viewdocumentSIAR']);
    Route::get('/ssf/{id}', [FormController::class, 'viewdocumentSSF']);
    Route::get('/form8/{id}', [FormController::class, 'viewdocumentForm8']);

    Route::get('/download-scaf/{id}', [FormController::class, 'downloadSCAF']);
    Route::get('/download-sp3/{id}', [FormController::class, 'downloadSP3']);
    Route::get('/download-siar/{id}', [FormController::class, 'downloadSIAR']);
    Route::get('/download-ssf/{id}', [FormController::class, 'downloadSSF']);
    Route::get('/download-form8/{id}', [FormController::class, 'downloadForm8']);

});

    // ITF Routes "4"
// Route::prefix('itf')->group(function ()
// {
//     Route::get('', 'ItfController@index')->name('itf');
// });
