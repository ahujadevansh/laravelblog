<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/blog/{post}/', 'WelcomeController@show')->name('blog.show');
Route::get('/blog/category/{category}/', 'WelcomeController@category')->name('blog.category');
Route::get('/blog/tag/{tag}/', 'WelcomeController@tag')->name('blog.tag');

Auth::routes();

Route::middleware(['auth'])->group(function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::resource('tags', 'TagsController');

    Route::delete('/posts/trash/{post}','PostsController@trash')->name('posts.trash');
    Route::put('/posts/restore/{id}','PostsController@restore')->name('posts.restore');
    Route::get('/posts/trashed','PostsController@trashed')->name('posts.trashed');
    Route::resource('posts', 'PostsController');
});

Route::middleware(['auth', 'admin'])->group(function(){

    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::put('/users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});
