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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::get('/', 'CategoryController@index');
Route::get('/', function(){
	return view('ecommerce_home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/file/{key}', "FileController@getFile");
Route::resource('categoria', "CategoryController");
Route::resource('subcategoria', "SubcategoryController");
Route::resource('tag', "TagController");
Route::resource('editorial', "EditorialController");
Route::resource('autor', "AuthorController");
Route::resource('blog', "BlogController");
Route::post('/file_blog/{blog_id}', 'BlogController@uploadFile')->name('file_blog');
