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
Route::post('subscribe', 'SubscriptionsController@subscribe')->name('subcribe.subreddit');
Route::post('unsubscribe', 'SubscriptionsController@unsubscribe')->name('unsubcribe.subreddit');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/subreddits/r/{subreddit}', 'SubredditsController@main')->name('subreddit.main');
Route::resource('/subreddits', 'SubredditsController');
Route::get('posts/create/{id}', ['as' => 'post.create', 'uses' => 'PostsController@create']);
Route::get('comments/create/{id}', ['as' => 'comment.create', 'uses' => 'CommentController@create']);
Route::resource('/posts', 'PostsController')->except([
    'create'
]);
Route::resource('/comments', 'CommentsController')->except([
    'create'
]);
Route::resource('/users', 'UsersController');

/*
Route::resource('/comments', 'CommentsController');

Route::get('/subreddits', 'SubredditsController@index')->name('subreddits.index');
Route::get('/subreddits/create', 'SubredditsController@create')->name('subreddits.create');
Route::post('/subreddits/store', 'SubredditsController@store')->name('subreddits.store');
Route::get('/subreddits/{subreddit}/}', 'SubredditsController@show')->name('subreddits.show');
Route::get('/subreddits/{subreddit}/edit', 'SubredditsController@edit')->name('subreddits.edit');
Route::put('/subreddits/{subreddit}', 'SubredditsController@update')->name('subreddits.update');
Route::delete('/subreddits/{subreddit}', 'SubredditsController@destroy')->name('subreddits.destroy');
*/