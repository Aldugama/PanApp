<?php
// Ruta raíz aplicación. Devuelve una vista con el método estático view()
Route::view('/', 'home');

// Rutas de autenticación por defecto
Auth::routes();

//Ruta para el inicio
Route::get('home', 'HomeController@index')->name('home');


//! Rutas para rol administrador
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->namespace('Admin')
    ->group(function () {

        Route::get('/', 'OrdersController@index')->name('admin.home');


        Route::get('rol/buscar', ['as' => 'rol.search', 'uses' => 'RoleController@search']);                
        Route::resource('rol', 'RoleController')->except('create', 'edit');
        Route::get('rol/restore/{id}', ['as' => 'rol.restore', 'uses' => 'RoleController@restore']);


        Route::get('usuario/buscar', ['as' => 'usuario.search', 'uses' => 'UserController@search']);                
        Route::resource('usuario', 'UserController')->except('create', 'edit');
        Route::get('usuario/restore/{id}', ['as' => 'usuario.restore', 'uses' => 'UserController@restore']);


        Route::get('categorias/buscar', ['as' => 'categorias.search', 'uses' => 'CategoryController@search']);
        Route::resource('categorias', 'CategoryController')->except('create', 'edit'); // Recurso categorias
        Route::get('categorias/restore/{id}', ['as' => 'categorias.restore', 'uses' => 'CategoryController@restore']);


        Route::get('producto/buscar', ['as' => 'producto.search', 'uses' => 'ProductController@search']);        
        Route::resource('producto', 'ProductController')->except('create', 'edit'); // Recurso productos
        Route::get('producto/restore/{id}', ['as' => 'producto.restore', 'uses' => 'ProductController@restore']);

        
        Route::get('pedido/buscar', ['as' => 'pedido.search', 'uses' => 'OrdersController@search']);        
        Route::resource('pedido', 'OrdersController')->except('create', 'edit'); //Recurso para pedidos
        Route::get('pedido/restore/{id}', ['as' => 'pedido.restore', 'uses' => 'OrdersController@restore']);

        Route::get('cart/buscar', ['as' => 'cart.search', 'uses' => 'CartController@search']);        
        Route::resource('cart', 'CartController')->only('index', 'show', 'destroy', 'update'); //Recurso para pedidos
        Route::get('cart/restore/{id}', ['as' => 'cart.restore', 'uses' => 'CartController@restore']);
        
    });



//! Rutas para rol tiendas 
Route::middleware(['auth', 'role:tienda'])
    ->prefix('tienda')
    ->namespace('Shop')
    ->group(function () {
        Route::get('/', 'CatalogController@index')->name('catalogo.index');
        Route::get('categoria/{id}', 'CatalogController@showByCategory');
        Route::get('producto/{id}', 'CatalogController@show');
        Route::get('catalogo/buscar', ['as' => 'catalogo.search', 'uses' => 'CatalogController@search']);
        Route::resource('carro', 'CartController');
        //Route::get('carro/restore/{id}', 'CartController@restore')->name('carro.restore');
        Route::post('anadir-producto/{id}', 'CartItemsController@addItem')->name('add.item');
        Route::post('quitar-producto/{id}', 'CartItemsController@removeItem')->name('remove.item');
        Route::put('activar-pedido/{id}', 'CartController@activated')->name('carro.activar');
        Route::put('cancelar-pedido/{id}', 'CartController@cancelled')->name('carro.cancelar');
    });



//! Rutas para rol horno
Route::middleware(['auth', 'role:horno'])
    ->prefix('central')
    ->namespace('Central')
    ->group(function () {
        Route::get('/', function () {
            return view('central.central');
        });
        Route::get('total-pedidos', 'CentralController@printAllExceptDrinksCakes')->name('central.all');
        Route::get('total-pedidos-por-tienda', 'CentralController@printOrdersByShop')->name('central.shops');
        Route::get('total-pedidos/categoria/{id}', 'CentralController@printByCategory')->name('central.category');
    });
