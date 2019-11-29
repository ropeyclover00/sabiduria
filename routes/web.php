<?php
//Globales
Route::get('/file/{key}', "FileController@getFile");
Auth::routes(['verify' => true]);
Route::resource('comentario', "CommentController")->except(['edit', 'update', 'create', 'index']);;
Route::resource('pedido', "OrderController")->except(['edit', 'create'])->middleware(['auth', 'verified']);

//Estaticas
Route::get('/', "HomeController@index")->name('home');
Route::get('/home', "HomeController@index")->name('home');
Route::get('/contacto', "HomeController@contacto")->name('contacto');
Route::post('/contacto', "HomeController@sendContacto")->name('contacto_email');
Route::get('/nosotros', "HomeController@nosotros")->name('nosotros');

//Carrito
Route::get('/carrito', "CartController@index")->name('carrito')->middleware(['verified', 'auth']);
Route::post('/carrito/{product_id}', "CartController@store")->name('carrito2')->middleware(['verified', 'auth']);
Route::delete('/carrito/{carrito}', "CartController@destroy")->name('carrito_destroy')->middleware(['verified', 'auth']);

//Productos
Route::get('/productos/{category_id?}/{subcategory_id?}', "ProductController@listFront")->name('productos');
Route::get('/producto-detalle/{producto}', "ProductController@showFront")->name('producto-detalle');
Route::post('/producto-comentario/{producto}', "ProductController@addComment")->middleware(['verified', 'auth'])->name('producto-comentario');

//Blogs
Route::get('/blogs/{category_id?}/{subcategory_id?}', "BlogController@listFront")->name('blogs');
Route::get('/blog-detalle/{blog}', "BlogController@showFront")->name('blog-detalle');
Route::post('/blog-comentario/{blog}', "BlogController@addComment")->middleware(['verified', 'auth'])->name('blog-comentario');

//Cliente
Route::get('/cuenta', "UserController@cuenta")->middleware(['verified', 'auth'])->name('cuenta');
Route::post('/cuenta/{usuario}', "UserController@updateCuenta")->middleware(['verified', 'auth'])->name('cuenta_update');
Route::get('/pedidos', "OrderController@getByUser")->middleware(['verified', 'auth'])->name('pedidos');

//Panel Administrativo
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