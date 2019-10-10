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

Route::get('conversation/{conversation}', 'ChatController@indexConversation')->name('conv.index');
Route::get('messages/{conversation}', 'ChatController@getConversationMessages')->name('conv.messages');
Route::post('message/{conversation}', 'ChatController@sendMessage')->name('message.store');
Route::group(['prefix' => 'api'], function (){


    Route::get('conversations', 'ChatController@index');
    Route::post('conversations', 'ChatController@store');

    Route::get('conversations/{conversation}/users', 'ChatController@participants');
    Route::post('conversations/{conversation}/users', 'ChatController@join');
    Route::delete('conversations/{conversation}/users', 'ChatController@leaveConversation');

    Route::get('conversations/{conversation}/messages', 'ChatController@getMessages');
    Route::post('conversations/{conversation}/messages', 'ChatController@sendMessage');
    Route::delete('conversations/{conversation}/messages', 'ChatController@deleteMessages');

    Route::post('pusher/auth', function() {
        return auth()->user();
    });
});

Route::get('event', function() {
    return event(new \App\Events\TestRedis());
});
