<?php
use Illuminate\Http\Request; 
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // Route::get('webview', function(){
    //     return view('webview');
    // });

    // AJAX
    Route::get('paises', 'Ajax\Direcciones@paises')->name('paises_ajax');
    Route::get('departamentos', 'Ajax\Direcciones@Departamentos')->name('departamentos_ajax');
    Route::get('ciudadesCombo', 'Ajax\Direcciones@CiudadesCombo')->name('ciudadesCombo');
    Route::get('ciudades', 'Ajax\Direcciones@Ciudades')->name('ciudades_ajax');
    Route::get('barriosCombo', 'Ajax\Direcciones@BarriosCombo')->name('barriosCombo');
    Route::get('barrios', 'Ajax\Direcciones@barrios')->name('barrios_ajax');


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

    Route::get('configurar/direcciones/paises', 'Configurar\DireccionesController@paises')->name('paises');
    Route::get('configurar/direcciones/departamentos', 'Configurar\DireccionesController@departamentos')->name('departamentos');
    Route::get('configurar/direcciones/ciudades', 'Configurar\DireccionesController@ciudades')->name('ciudades');
    Route::get('configurar/direcciones/barrios', 'Configurar\DireccionesController@barrios')->name('barrios');
    



    Route::resource('configurar/fuente', 'Configurar\FuenteController');

    
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


    //GALERIA

    Route::get('galeria/{valor}', [
        'uses' => 'GaleriaController@index',
        'as'   => 'galeria.index'
    ]);

    Route::get('galeria/new/{valor}', [
        'uses' => 'GaleriaController@new',
        'as'   => 'galeria.new'
    ]);
    Route::get('galeria/update/{valor}', [
        'uses' => 'GaleriaController@update',
        'as'   => 'galeria.update'
    ]);

     ////////


     // INVENTARIO
    Route::resource('inventario/entradas', 'Inventario\EntradasController');

    Route::resource('inventario/salidas', 'Inventario\SalidasController');
    Route::resource('inventario/consolidado', 'Inventario\ConsolidadoController');
     // //////////


    // PROCESAR
    Route::resource('procesar/ventas', 'Procesar\VentasController');
    Route::resource('procesar/remitos', 'Procesar\RemitosController');
    Route::resource('procesar/descompuestos', 'Procesar\DescompuestoController');

    ////////////


   /////////////////////////////////////////////////////////////////////////////////////////
   // Módulo Seguridad
    Route::resource('seguridad/usuarios', 'Seguridad\UsuariosController');
    Route::get('seguridad/usuarios/{id}/destroy', [
        'uses' => 'Seguridad\UsuariosController@destroy',
        'as'   => 'usuarios.destroy'
    ]);

    Route::get('seguridad/usuarios/cambiar/{valor}', [
        'uses' => 'Seguridad\UsuariosController@cambiar',
        'as'   => 'usuarios.cambiar'
    ]);
    Route::put('seguridad/usuarios/update_password/{valor}', [
        'uses' => 'Seguridad\UsuariosController@update_password',
        'as'   => 'usuarios.update_password'
    ]);

    Route::resource('seguridad/roles', 'Seguridad\RolesController');
    Route::get('seguridad/roles/{id}/destroy', [
        'uses' => 'Seguridad\RolesController@destroy',
        'as'   => 'roles.destroy'
    ]);

    Route::resource('seguridad/auditoria', 'Seguridad\AuditoriaController');





    ///////////

    


});
