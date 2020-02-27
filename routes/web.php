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
Route::get('topics', 'TopicController@index')->name('topics');
Route::get('topic/new' , 'TopicController@new')->name('topic.new');
Route::post('topic', 'TopicController@store')->name('topic.store');
Route::get('topic/{topic}', 'TopicController@show')->name('topic.show');
Route::post('topic/{topic}/reply', 'ReplyController@store')->name('reply.store');
Route::get('badge/new', 'BadgeController@new')->name('badge.new');
Route::post('badge', 'BadgeController@store')->name('badge.store');

Route::get('addlike/{reply_id}' , 'ReplyController@addlike');
Route::get('countLike/{id_reply}' , 'ReplyController@countlike');
Route::get('checkStatus/{id_reply}' , 'ReplyController@checkStatusLike');


Route::get('dislike/{replyid}' , 'ReplyController@dislike');