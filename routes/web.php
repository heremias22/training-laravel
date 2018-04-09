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
Route::get('/profile/user/{user}', 'UsersController@getProfile')->name('user.profile');
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
