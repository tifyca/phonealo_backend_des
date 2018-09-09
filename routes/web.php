 <?php
use Illuminate\Http\Request; 
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

   

    // AJAX
    Route::get('paises', 'Ajax\Direcciones@paises')->name('paises_ajax');
    Route::get('departamentos', 'Ajax\Direcciones@Departamentos')->name('departamentos_ajax');
    Route::get('ciudadesCombo', 'Ajax\Direcciones@CiudadesCombo')->name('ciudadesCombo');
    Route::get('ciudades', 'Ajax\Direcciones@Ciudades')->name('ciudades_ajax');
    Route::get('barriosCombo', 'Ajax\Direcciones@BarriosCombo')->name('barriosCombo');
    Route::get('barrios', 'Ajax\Direcciones@barrios')->name('barrios_ajax');

    Route::get('productos', 'Ajax\ProductosAjax@productos_list')->name('productos_ajax');
    Route::get('mostrar_subcategorias', 'Ajax\ProductosAjax@subcategorias_list')->name('mostrar_subcategorias');
    Route::get('producto_click', 'Ajax\ProductosAjax@producto')->name('producto_click');
    Route::get('cargos', 'Ajax\Configurar@cargos')->name('cargos_ajax');

    


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
    Route::get('configurar/direcciones/ciudades/dpto/{ciudad_id?}', 'Configurar\DireccionesController@tablaCiudades');



    Route::get('configurar/direcciones/barrios', 'Configurar\DireccionesController@barrios')->name('barrios');
    Route::get('configurar/direcciones/barrios/edit/{barrio_id?}','Configurar\DireccionesController@editar_barrios');
    Route::post('configurar/direcciones/barrios','Configurar\DireccionesController@store_barrios');
    Route::put('configurar/direcciones/barrios/mod/{barrio_id?}','Configurar\DireccionesController@update_barrios');
    Route::delete('configurar/direcciones/barrios/{barrio_id?}','Configurar\DireccionesController@destroy_barrios');
    Route::get('configurar/direcciones/barrios/ciud/{barrio_id?}', 'Configurar\DireccionesController@tablaBarrios');

    
    Route::get('configurar/estados', 'Configurar\EstadosController@index')->name('estados');
    Route::get('configurar/estados/edit/{estado_id?}','Configurar\EstadosController@editar');
    Route::put('configurar/estados/mod/{estado_id?}','Configurar\EstadosController@update');
    

     
   
   




    Route::resource('configurar/fuente', 'Configurar\FuenteController');

    
    // ///////////
    // REGISTRO

    Route::resource('registro/clientes', 'Registro\ClientesController');
    Route::post('registro/clientes/create', 'Registro\ClientesController@create_cliente');
    Route::get('registro/clientes/editar/{id_cliente?}','Registro\ClientesController@editar');
    Route::put('registro/clientes/mod/{id_cliente?}','Registro\ClientesController@update');
    Route::get('registro/clientes/gmaps/{ubicacion?}',  'Registro\ClientesController@gmaps');

    Route::resource('registro/proveedores', 'Registro\ProveedoresController');
    Route::post('registro/proveedores/create', 'Registro\ProveedoresController@create');
    Route::get('registro/proveedores/editar/{id_proveedor?}','Registro\ProveedoresController@editar');
    Route::put('registro/proveedores/mod/{id_proveedor?}','Registro\ProveedoresController@update');
   




    Route::resource('registro/productos', 'Registro\ProductosController');

   
    Route::get('registro/productos/detalle/{valor}', [
        'uses' => 'Registro\ProductosController@detalle',
        'as'   => 'productos.detalle'
    ]);


    ////////////////////////////////////////////////////////////////////////////////////////////////////////


    Route::resource('registro/empleados', 'Registro\EmpleadosController');
    Route::post('registro/empleados/create', 'Registro\EmpleadosController@create');
    Route::get('registro/empleados/editar/{id_empleado?}','Registro\EmpleadosController@editar');
    Route::put('registro/empleados/mod/{id_empleado?}','Registro\EmpleadosController@update');
    Route::delete('registro/empleados/{id_empleado?}','Registro\EmpleadosController@destroy');

    Route::get('registro/inventario', 'Registro\InventarioController@index')->name('inventario');

    Route::resource('registro/gastos', 'Registro\GastosController');


    Route::get('registro/faltantes', 'Registro\FaltantesController@index')->name('faltantes');



    //GALERIA
    Route::resource('galeria','GaleriaController');
    Route::get('galeria/{id}', [
        'uses' => 'GaleriaController@index',
        'as'   => 'galeria.index'
    ]);

    Route::get('galeria/new/{id}', [
        'uses' => 'GaleriaController@new',
        'as'   => 'galeria.new'
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

    Route::get('procesar/conversiones', 'Procesar\ConversionesController@index')->name('procesar.conversiones');
    Route::get('procesar/conversiones/new', 'Procesar\ConversionesController@new')->name('procesar.conversiones.new');
    Route::get('procesar/conversiones/show', 'Procesar\ConversionesController@show')->name('procesar.conversiones.show');

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

    /////////////////////////////////////////////
    ///CAJA

    Route::get('caja/index', 'Caja\AbrirController@index')->name('caja.index');
    Route::get('caja/abrir', 'Caja\AbrirController@abrir')->name('caja.abrir');
    Route::get('caja/remitos', 'Caja\AbrirController@remitos')->name('caja.remitos');
    Route::get('caja/cobro_remito', 'Caja\AbrirController@cobro_remito')->name('caja.cobro_remito');
    Route::get('caja/salida', 'Caja\AbrirController@salida')->name('caja.salida');
    Route::get('caja/cerrar', 'Caja\AbrirController@cerrar')->name('caja.cerrar');

    Route::get('caja/cierres', 'Caja\CierresController@index')->name('caja.cierres');
    Route::get('caja/cierres/resumen', 'Caja\CierresController@resumen')->name('caja.cierre.resumen');
    Route::get('caja/cierres/informe', 'Caja\CierresController@informe')->name('caja.cierre.informe');
    Route::get('caja/cierres/informe/modificado', 'Caja\CierresController@modificado')->name('caja.cierre.informe.modificado');

    Route::get('caja/historial', 'Caja\historialController@index')->name('caja.historial');
    



    


});
