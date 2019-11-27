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
	return view('front.static.home');
});


Route::get('/file/{key}', "FileController@getFile");
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/categorias', "CategoryController@listFront")->name('front_categorias');

Route::prefix('admin')->group(function(){
	Auth::routes();
});

Route::resource('comentario', "CommentController")->except(['edit', 'update', 'create', 'index']);;
Route::resource('pedido', "OrderController")->except(['edit', 'create']);

Route::prefix('admin')->middleware(['auth', 'role'])->group(function(){

	Route::get('/', function(){
		return redirect()->route('usuario.index');
	})->name('admin');
	Route::resource('categoria', "CategoryController");
	Route::resource('subcategoria', "SubcategoryController");
	Route::resource('tag', "TagController");
	Route::resource('editorial', "EditorialController");
	Route::resource('autor', "AuthorController");
	Route::resource('blog', "BlogController");
	Route::post('/file_blog/{blog_id}', 'BlogController@uploadFile')->name('file_blog');
	Route::delete('/file_blog/{file_id}', 'BlogController@deleteFile')->name('delete_file_blog');
	Route::resource('producto', "ProductController");
	Route::resource('usuario', "UserController");

});