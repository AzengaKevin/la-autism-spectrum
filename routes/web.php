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
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/user/settings', fn() => view('settings.show'))->name('settings.show');

});

Route::resource('questionnaires', 'QuestionnairesController')
    ->only('index');
    
Route::post('questionnaires/{questionnaire}', 'QuestionnairesController@store')
    ->name('questionnaires.store');

Route::resource('questionnaires.questions', 'QuestionnaireQuestionController')
    ->only('index');
Route::resource('questionnaires.videos', 'QuestionnaireVideoController')
    ->only('index');
Route::resource('questionnaires.pictures', 'QuestionnairePictureController')
    ->only('index');
Route::resource('questionnaires.screenings', 'QuestionnaireScreeningController')
    ->only('store');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes that can only be accessed by users with the admin role
|
*/
Route::group([
    'middleware' => ['auth:sanctum', 'auth', 'verified'],
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'
], function(){
    Route::resource('users', 'UsersController');
    
    Route::get('/roles', 'RolesController@index')->name('roles.index')
        ->middleware('can:viewAny,App\Models\Role');
});


/*
|--------------------------------------------------------------------------
| Professionals Routes
|--------------------------------------------------------------------------
|
| Routes that can only be accessed by ecperts with the admin role
|
*/
Route::group([
    'middleware' => ['auth:sanctum', 'auth', 'verified'],
    'prefix' => 'expert',
    'as' => 'expert.',
    'namespace' => 'Expert'
], function(){
    Route::get('questionnaires', fn() => view('expert.questionnaires.index'))->name('questionnaires')
        ->middleware('can:viewAny,App\Models\Questionnaire');
    Route::resource('questionnaires.questions', 'QuestionnaireQuestionController',
        ['only' => ['index', 'create', 'store']]);
    Route::resource('questionnaires.pictures', 'QuestionnairePictureController',
        ['only' => ['index', 'create', 'store']]);
    Route::resource('questionnaires.videos', 'QuestionnaireVideoController',
        ['only' => ['index', 'create', 'store', 'edit', 'update', 'delete']]);
});


