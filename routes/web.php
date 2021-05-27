<?php

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
//Homepage
Route::get('/', 'BlogController@index')->name('guest.posts.index');
//Guest Show per il singolo elemento
Route::get('posts/{slug}', 'BlogController@show')->name('guest.posts.show');
//Route per aggiungere i messaggi
Route::post('posts/{post}/add-comment' , 'BlogController@storeComment')->name('guest.posts.add-comment');
//Route per mostrare i post filtrati per tag
Route::get('tags/{slug}', 'BlogController@filterByTag')->name('guest.posts.filter-by-tag');

//Admin Routes
Route::prefix('admin')->name('admin.')->namespace('Admin')->group( function () {
    //Routes Admin per i Posts
    Route::resource('posts', 'PostController');
    //Routes Admin per i Tags
    Route::resource('tags', 'TagController');
    //Route Delete per i Messaggi
    Route::delete('comments/{comment}' , 'CommentController@deleteComment')->name('comments.destroy');
});

