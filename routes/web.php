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

Route::get('/', fn() => view('welcome'));

Route::group([
    'middleware' => ['auth:sanctum', 'auth', 'verified'],
], function(){
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/user/settings', fn() => view('settings.show'))->name('settings.show');
    Route::get('/user/questionnaires', fn() => view('questionnaires'))->name('questionnaires');
    Route::get('/user/questionnaires/{questionnaire:slug}/questions', 'QuestionController@index')
        ->name('questionnaires.questions.index');
    Route::get('/user/questionnaires/{questionnaire:slug}/questions/create', 'QuestionController@create')
        ->name('questionnaires.questions.create');
    Route::post('/user/questionnaires/{questionnaire:slug}/questions', 'QuestionController@store')
        ->name('questionnaires.questions.store');
});