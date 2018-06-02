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

Auth::routes();

Route::get('/', 'HomeController@index')
    ->name('home')
;

Route::get('/my-profile', 'HomeController@myProfile')
    ->name('my-profile')
;

Route::get('/profile/{id}', 'HomeController@profile')
    ->where('id', '[0-9]+')
    ->name('profile')
;

Route::get('/profile', 'HomeController@profile');

Route::get('/post/{id}', 'HomeController@post')
    ->where('id', '[0-9]+')
    ->name('post')
;

Route::post('/comment', 'CommentController@store')
    ->name('commentCreate')
;