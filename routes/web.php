<?php

use App\Mail\NewUserWelcomeMail;
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

Auth::routes();

Route::get('/email', function(){
    return new NewUserWelcomeMail();
});

Route::post('/follow/{user}', 'FollowsController@store');

Route::get('/profiles/{userId}', 'ProfilesController@index')->name('profile.show');
Route::get('/profiles/{userId}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profiles/{userId}', 'ProfilesController@update')->name('profile.update');

// Route::post('/name', 'HomeController@show')->name('name');

// post
Route::get('/', 'PostsController@index');
Route::get('/p/create', 'PostsController@create')->name('post.create');
Route::post('/p/store', 'PostsController@store')->name('post.store');
Route::get('/p/show/{post}', 'PostsController@show')->name('post.show');
