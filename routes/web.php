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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('tasks', 'TaskController@index');
Route::get('tasks/create', 'TaskController@create');
Route::get('tasks/{channel}/{task}', 'TaskController@show');
Route::delete('tasks/{channel}/{task}', 'TaskController@destroy')->name('delete');
Route::post('tasks', 'TaskController@store');
Route::get('tasks/{channel}', 'TaskController@index');
Route::get('/tasks/{channel}/{task}/posts', 'PostController@index');
Route::post('/tasks/{channel}/{task}/posts', 'PostController@store');
Route::patch('/posts/{post}', 'PostController@update');
Route::delete('/posts/{post}', 'PostController@destroy');
Route::post('/tasks/{channel}/{task}/subscriptions', 'TaskSubscriptionsController@store')->middleware('auth');
Route::delete('/tasks/{channel}/{task}/subscriptions', 'TaskSubscriptionsController@destroy')->middleware('auth');

Route::post('/posts/{post}/favorites', 'FavoritesController@store');
Route::delete('/posts/{post}/favorites', 'FavoritesController@destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');


