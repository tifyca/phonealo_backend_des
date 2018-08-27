<?php
use Illuminate\Http\Request; 
Auth::routes();
 
Route::group(['middleware' => 'auth'], function () {

    // AJAX
    Route::get('departamentos', 'Ajax\Direcciones@Departamentos')->name('departamentos');
    Route::get('ciudades', 'Ajax\Direcciones@Ciudades')->name('ciudades');

    /////////////


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    // CONFIGURAR

    Route::resource('configurar/cargos', 'Configurar\CargosController');

    Route::get('configurar/cargos/edit/{cargo_id?}','Configurar\CargosController@editar');
  
    Route::post('configurar/cargos','Configurar\CargosController@agregar');

    Route::put('configurar/cargos/mod/{cargo_id?}','Configurar\CargosController@update');

    Route::delete('configurar/cargos/{cargo_id?}','Configurar\CargosController@destroy');



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

    Route::resource('configurar/direcciones', 'Configurar\DireccionesController');
    
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
