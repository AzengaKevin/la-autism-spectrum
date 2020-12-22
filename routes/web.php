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

Route::get('/', fn() => view('welcome'))
    ->name('home');

Route::group([
    'middleware' => ['auth:sanctum', 'auth', 'verified'],
], function(){
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/user/settings', fn() => view('settings.show'))->name('settings.show');
    Route::get('/user/questionnaires', fn() => view('questionnaires'))->name('questionnaires')
        ->middleware('can:viewAny,App\Models\Questionnaire');
    Route::get('/user/questionnaires/{questionnaire:slug}/questions', 'QuestionController@index')
        ->name('questionnaires.questions.index');
    Route::get('/user/questionnaires/{questionnaire:slug}/questions/create', 'QuestionController@create')
        ->name('questionnaires.questions.create');
    Route::post('/user/questionnaires/{questionnaire:slug}/questions', 'QuestionController@store')
        ->name('questionnaires.questions.store');
    Route::get('/roles', 'RolesController@index')->name('roles.index')
        ->middleware('can:viewAny,App\Models\Role');

    Route::resource('users', 'UsersController');
});

Route::get('screenings', 'ScreeningController@index')->name('screenings.index');
Route::get('screenings/{questionnaire:slug}', 'ScreeningController@show')->name('screenings.show');
Route::post('screenings/{questionnaire:slug}', 'ScreeningController@store')->name('screenings.store');