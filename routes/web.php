<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    // CONFIGURAR

    Route::resource('configurar/cargos', 'Configurar\CargosController');

    Route::get('configurar/cargos/update/{valor}', [
            'uses' => 'Configurar\CargosController@update',
            'as'   => 'cargos.update'
        ]);

    Route::resource('configurar/categorias', 'Configurar\CategoriasController');

    Route::get('configurar/categorias/update/{valor}', [
            'uses' => 'Configurar\CategoriasController@update',
            'as'   => 'categorias.update'
        ]);

    Route::get('configurar/estados', 'Configurar\EstadosController@index')->name('estados');

    Route::resource('configurar/subcategorias', 'Configurar\SubcategoriasController');
    
    Route::get('configurar/subcategorias/update/{valor}', [
            'uses' => 'Configurar\SubcategoriasController@update',
            'as'   => 'subcategorias.update'
        ]);
    
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

    Route::get('registro/productos/detalle/{valor}', [
            'uses' => 'Registro\ProductosController@detalle',
            'as'   => 'productos.detalle'
        ]);



    Route::resource('registro/empleados', 'Registro\EmpleadosController');

    Route::get('registro/empleados/update/{valor}', [
            'uses' => 'Registro\EmpleadosController@update',
            'as'   => 'empleados.update'
        ]);

    Route::get('registro/inventario', 'Registro\InventarioController@index')->name('inventario');

    Route::resource('registro/gastos', 'Registro\GastosController');

    Route::get('registro/gastos/update/{valor}', [
            'uses' => 'Registro\gastosController@update',
            'as'   => 'gastos.update'
        ]);

    Route::get('registro/faltantes', 'Registro\FaltantesController@index')->name('faltantes');
    
    
   
    
    

    ///////////



   
    
    
  
  
});
