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
/*
 * Les differentes vues du blog
 */
Route::get('/', 'HomeController@index')
    ->name('home')
;

Route::get('/{page}', 'HomeController@index')
    ->where('page', '[0-9]*')
    ->name('pagination')
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
/*
 * Comment CRUD
 */
Route::post('/comment', 'CommentController@store')
    ->name('commentCreate')
;

/*
 * Post CRUD
 */
Route::group(['prefix'=>'/post'], function(){
    Route::get('/add', 'PostController@add')
        ->name('postAdd');
    ;

    Route::post('/store', 'PostController@store')
        ->name('postStore')
    ;

    Route::get('/edit/{id}', 'PostController@edit')
        ->where('id', '[0-9]+')
        ->name('postEdit')
    ;

    Route::post('/update/{id}', 'PostController@update')
        ->where('id', '[0-9]+')
        ->name('postUpdate')
    ;
});
/*
 * Messenger
 */
Route::group(['prefix'=>'/messages'], function(){
    Route::get('/{id}', 'MessageController@conversation')
        ->where('id', '[0-9]+')
        ->name('conversation')
    ;
});

Route::view('/messages', 'messenger.conversation-mockup');