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


Route::get('/threads', 'ThreadsController@index');
Route::get('/threads/create','ThreadsController@create');
Route::get('/threads/{channel}/{thread}','ThreadsController@show');


Route::post('threads', 'ThreadsController@store');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');

Route::get('/threads/{channel}','ThreadsController@index');

//Route::resource('threads','ThreadsController');

//before
//Route::get('/threads/{thread}', 'ThreadsController@show');
//after


// could be fine:
// Route::post('/threads/{thread}/replies', 'ThreadsController@addReply');
// but controller could become bloated,adding methods like, updateReply, etc..
// So it could be like this and adopt the restfull paradigm





