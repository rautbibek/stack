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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/question','QuestionController')->except('show');
route::resource('question.answer','AnswerController')->except(['index','show','create']);
Route::get('/question/{slug}','QuestionController@show')->name('question.show');
route::post('accept/{answer}/answer','AcceptAnswerController')->name('accept.answer');
