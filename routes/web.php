<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    // CONFIGURAR

    Route::get('configurar/cargos', 'Configurar\CargosController@index')->name('cargos');
    Route::get('configurar/categorias', 'Configurar\CategoriasController@index')->name('categorias');
    Route::get('configurar/divisas', 'Configurar\DivisasController@index')->name('divisas');
    Route::get('configurar/estados', 'Configurar\EstadosController@index')->name('estados');
    Route::get('configurar/gastos', 'Configurar\GastosController@index')->name('gastos');
    Route::get('configurar/tipocliente', 'Configurar\TipoClienteController@index')->name('tipocliente');
    
    // ///////////
    // REGISTRO

    Route::resource('registro/clientes', 'Registro\ClientesController');

    Route::get('registro/clientes/update/{valor}', [
            'uses' => 'Registro\ClientesController@update',
            'as'   => 'clientes.update'
        ]);

    Route::resource('registro/proveedores', 'Registro\ProveedoresController');

    Route::get('registro/proveedores/update/{valor}', [
            'uses' => 'Registro\ProveedoresController@update',
            'as'   => 'proveedores.update'
        ]);

    Route::resource('registro/productos', 'Registro\ProductosController');

    Route::get('registro/productos/update/{valor}', [
            'uses' => 'Registro\ProductosController@update',
            'as'   => 'productos.update'
        ]);

    Route::get('registro/repartidores', 'Registro\RepartidoresController@index')->name('repartidores');
    Route::get('registro/inventario', 'Registro\InventarioController@index')->name('inventario');
    Route::get('registro/gastos', 'Registro\GastosController@index')->name('gastos');
    Route::get('registro/faltantes', 'Registro\FaltantesController@index')->name('faltantes');
    
    
   
    
    

    ///////////



   
    
    
  
  
});
