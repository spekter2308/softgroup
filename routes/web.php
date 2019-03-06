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
Route::get('/home', 'HomeController@index')->name('home');

//default for logout (link for /posts)
Route::get('/', 'PostController@index');

//>Posts pages
Route::resource('/posts', 'PostController')
	->names('posts');


//<Admin part (for control users)
Route::resource('/users', 'UserController')
	->except('create', 'show')
	->names('users')->middleware('admin');
//>