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
Route::get('/subreddits', 'SubredditsController@index')->name('subreddits.index');
Route::get('/subreddits/create', 'SubredditsController@create')->name('subreddits.create');
Route::post('/subreddits/store', 'SubredditsController@store')->name('subreddits.store');
Route::get('/subreddits/{subreddit}/}', 'SubredditsController@show')->name('subreddits.show');
Route::get('/subreddits/{subreddit}/edit', 'SubredditsController@edit')->name('subreddits.edit');
Route::put('/subreddits/{subreddit}', 'SubredditsController@update')->name('subreddits.update');
Route::delete('/subreddits/{subreddit}', 'SubredditsController@destroy')->name('subreddits.destroy');