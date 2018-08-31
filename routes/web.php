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


    ///////////


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    // CONFIGURAR

    Route::resource('configurar/cargos', 'Configurar\CargosController');
    Route::get('configurar/cargos/edit/{cargo_id?}','Configurar\CargosController@editar');
    Route::post('configurar/cargos','Configurar\CargosController@store');
    Route::put('configurar/cargos/mod/{cargo_id?}','Configurar\CargosController@update');
    Route::delete('configurar/cargos/{cargo_id?}','Configurar\CargosController@destroy');

    Route::resource('configurar/categorias', 'Configurar\CategoriasController');
    Route::get('configurar/categorias/edit/{categoria_id?}','Configurar\CategoriasController@editar');
    Route::post('configurar/categorias','Configurar\CategoriasController@store');
    Route::put('configurar/categorias/mod/{categoria_id?}','Configurar\CategoriasController@update');
    Route::delete('configurar/categorias/{categoria_id?}','Configurar\CategoriasController@destroy');

    Route::resource('configurar/subcategorias', 'Configurar\SubcategoriasController');
    Route::get('configurar/subcategorias/edit/{subcategoria_id?}','Configurar\SubcategoriasController@editar');
    Route::post('configurar/subcategorias','Configurar\SubcategoriasController@store');
    Route::get('configurar/subcategorias/cat/{cat?}','Configurar\SubcategoriasController@tipocat');
    Route::put('configurar/subcategorias/mod/{subcategoria_id?}','Configurar\SubcategoriasController@update');
    Route::delete('configurar/subcategorias/{subcategoria_id?}','Configurar\SubcategoriasController@destroy');

    Route::resource('configurar/fuentes', 'Configurar\FuenteController');
    Route::get('configurar/fuentes/edit/{fuente_id?}','Configurar\FuenteController@editar');
    Route::post('configurar/fuentes','Configurar\FuenteController@store');
    Route::put('configurar/fuentes/mod/{fuente_id?}','Configurar\FuenteController@update');
    Route::delete('configurar/fuentes/{fuente_id?}','Configurar\FuenteController@destroy');


    Route::get('configurar/direcciones/paises', 'Configurar\DireccionesController@paises')->name('paises');
    Route::get('configurar/direcciones/paises/edit/{pais_id?}','Configurar\DireccionesController@editar_paises');
    Route::post('configurar/direcciones/paises','Configurar\DireccionesController@store_paises');
    Route::put('configurar/direcciones/paises/mod/{pais_id?}','Configurar\DireccionesController@update_paises');
    Route::delete('configurar/direcciones/paises/{pais_id?}','Configurar\DireccionesController@destroy_paises');



    Route::get('configurar/direcciones/departamentos', 'Configurar\DireccionesController@departamentos')->name('departamentos');
    Route::get('configurar/direcciones/departamentos/edit/{dpto_id?}','Configurar\DireccionesController@editar_departamentos');
    Route::post('configurar/direcciones/departamentos','Configurar\DireccionesController@store_departamentos');
    Route::put('configurar/direcciones/departamentos/mod/{dpto_id?}','Configurar\DireccionesController@update_departamentos');
    Route::delete('configurar/direcciones/departamentos/{dpto_id?}','Configurar\DireccionesController@destroy_departamentos');

    Route::get('configurar/direcciones/ciudades', 'Configurar\DireccionesController@ciudades')->name('ciudades');
    Route::get('configurar/direcciones/ciudades/edit/{ciudad_id?}','Configurar\DireccionesController@editar_ciudades');
    Route::post('configurar/direcciones/ciudades','Configurar\DireccionesController@store_ciudades');
    Route::put('configurar/direcciones/ciudades/mod/{ciudad_id?}','Configurar\DireccionesController@update_ciudades');
    Route::delete('configurar/direcciones/ciudades/{ciudad_id?}','Configurar\DireccionesController@destroy_ciudades');

    Route::get('configurar/direcciones/barrios', 'Configurar\DireccionesController@barrios')->name('barrios');
    Route::get('configurar/direcciones/barrios/edit/{barrio_id?}','Configurar\DireccionesController@editar_barrios');
    Route::post('configurar/direcciones/barrios','Configurar\DireccionesController@store_barrios');
    Route::put('configurar/direcciones/barrios/mod/{barrio_id?}','Configurar\DireccionesController@update_barrios');
    Route::delete('configurar/direcciones/barrios/{barrio_id?}','Configurar\DireccionesController@destroy_barrios');

    
    Route::get('configurar/estados', 'Configurar\EstadosController@index')->name('estados');
    Route::get('configurar/estados/edit/{estado_id?}','Configurar\EstadosController@editar');
    Route::put('configurar/estados/mod/{estado_id?}','Configurar\EstadosController@update');
    

     
   
   




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

 // PROCESAR
    Route::resource('procesar/ventas', 'Procesar\VentasController');
    Route::resource('procesar/remitos', 'Procesar\RemitosController');

    Route::get('procesar/descompuestos', 'Procesar\DescompuestoController@index')->name('descompuestos');
  
     Route::get('procesar/descompuestos/soporte', [
            'uses' => 'Procesar\DescompuestoController@soporte',
            'as'   => 'descompuestos.soporte'
        ]);

     Route::resource('procesar/aconfirmar', 'Procesar\AconfirmarController');

     Route::get('procesar/logistica', 'Procesar\LogisticaController@index')->name('logistica');

     Route::get('procesar/logistica/edit', 'Procesar\LogisticaController@edit')->name('editar_logistica');

     Route::resource('procesar/monitoreo', 'Procesar\MonitoreoController');

      Route::get('procesar/monitoreo/cargar/{valor}', [
            'uses' => 'Procesar\MonitoreoController@cargar',
            'as'   => 'monitoreo.cargar'
        ]);

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
    ///////////

    


});
