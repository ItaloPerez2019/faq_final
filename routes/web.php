<?php
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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=> 'user'], function() {

    Route::get('/{user_id}/profile', 'ProfileController@create')->name('profile.create');
    Route::get('/{user_id}/profile/{profile_id}', 'ProfileController@show')->name('profile.show');
    Route::get('/{user_id}/profile/{profile_id}/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/{user_id}/profile/', 'ProfileController@store')->name('profile.store');
    Route::patch('/{user_id}/profile/{profile_id}', 'ProfileController@update')->name('profile.update');
    Route::delete('/{user_id}/profile/{profile_id}', 'ProfileController@destroy')->name('profile.destroy');

});

Route::group(['prefix'=> 'questions'], function() {

    Route::get('/{question_id}/answers/create', 'AnswerController@create')->name('answer.create');
    Route::get('/{question_id}/answers/{answer_id}', 'AnswerController@show')->name('answer.show');
    Route::get('/{question_id}/answers/{answer_id}/edit', 'AnswerController@edit')->name('answer.edit');
    Route::post('/{question_id}/answers/', 'AnswerController@store')->name('answer.store');
    Route::patch('/{question_id}/answer/{answer_id}', 'AnswerController@update')->name('answer.update');
    Route::delete('/{question_id}/answer/{answer_id}', 'AnswerController@destroy')->name('answer.destroy');

    Route::post('/vote','QuestionController@vote')->name('question.vote');

});

Route::resources([
    'question' => 'QuestionController',
]);



