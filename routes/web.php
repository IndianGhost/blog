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
Route::group(['prefix'=>'/profile'], function(){
    Route::get('/', 'HomeController@myProfile')
        ->name('my-profile')
    ;

    Route::get('/{id}', 'HomeController@profile')
        ->where('id', '[0-9]+')
        ->name('profile')
    ;
});

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
        ->where('id', '[0-9]+'
        )
        ->name('postEdit')
    ;

    Route::post('/update/{id}', 'PostController@update')
        ->where('id', '[0-9]+')
        ->name('postUpdate')
    ;

    Route::get('/delete/{id}', 'PostController@delete')
        ->where('id', '[0-9]+')
        ->name('postDelete')
    ;
});
/*
 * Messenger
 */
Route::group(['prefix'=>'/messages'], function(){
    Route::post('/', 'MessageController@store')
        ->name('messageStore')
    ;

    Route::get('/{id}', 'MessageController@conversation')
        ->where('id', '[0-9]+')
        ->name('conversation')
    ;

    Route::get('/', 'MessageController@messages')
        ->name('messages')
    ;
});