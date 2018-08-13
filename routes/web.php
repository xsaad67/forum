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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/threads','ThreadController@index');
Route::get('/thread/create','ThreadController@create');
Route::get('/thread/{channel}/{thread}','ThreadController@show');
Route::delete('/thread/{channel}/{thread}','ThreadController@destroy');
Route::post('/threads','ThreadController@store');
Route::get('/threads/{channel}','ThreadController@index');
Route::post('thread/{channel}/{thread}/reply','ReplyController@store');
Route::post('/replies/{reply}/favorites','FavoriteController@store'); 
Route::get('/profiles/{user}','ProfileController@show');

Route::get('/users',function(){
	return App\User::all();
});