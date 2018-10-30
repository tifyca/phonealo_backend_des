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
    Route::get('categoria', 'Ajax\Configurar@categorias')->name('tipocategoria');
    Route::get('horarios', 'Ajax\Configurar@horarios')->name('horarios_ajax');

    Route::get('productos', 'Ajax\ProductosAjax@productos_list')->name('productos_ajax');
    Route::get('mostrar_subcategorias', 'Ajax\ProductosAjax@subcategorias_list')->name('mostrar_subcategorias');
    Route::get('mostrar_solicitudes', 'Ajax\ProductosAjax@solicitudes_list')->name('mostrar_solicitudes');
    Route::get('buscar_categoria', 'Ajax\ProductosAjax@categorias_list')->name('buscar_categoria');
    Route::get('buscar_solped', 'Ajax\ProductosAjax@solped_monto')->name('buscar_solped');
    Route::get('buscar_comprobantes', 'Ajax\ProductosAjax@solped_comprobantes')->name('buscar_comprobantes');
    Route::get('buscar_factura', 'Ajax\ProductosAjax@solped_factura')->name('buscar_factura');
    Route::get('buscar_item', 'Ajax\ProductosAjax@verificar_detalle')->name('buscar_item');
    Route::get('buscar_empleados', 'Ajax\RegistroController@empleados_list')->name('mostrar_subcategorias');


    Route::get('producto_click', 'Ajax\ProductosAjax@producto')->name('producto_click');
    Route::get('cargos', 'Ajax\Configurar@cargos')->name('cargos_ajax');
    Route::get('detalle_venta', 'Ajax\Logistica@detalle_venta')->name('detalle_venta');
    Route::get('agregar_remisa', 'Ajax\Logistica@agregar_remisa')->name('agregar_remisa');
    Route::get('quitar_remisa', 'Ajax\Logistica@quitar_remisa')->name('quitar_remisa');
    Route::get('fact_venta', 'Ajax\Logistica@fact_venta')->name('fact_venta');
    Route::get('num_factura', 'Ajax\Logistica@num_factura')->name('num_factura');
    Route::get('activar_venta', 'Ajax\Logistica@activar_venta')->name('activar_venta');
    Route::get('asignar_remisa', 'Ajax\Logistica@asignar_remisa')->name('asignar_remisa');
    Route::get('search_notas', 'Ajax\Logistica@search_notas')->name('search_notas');
     Route::get('add_notas', 'Ajax\Logistica@add_notas')->name('add_notas');
     Route::get('onoffhorario', 'Ajax\Logistica@onoffhorario')->name('onoffhorario');
    

    
    

    


    ///////////

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    // CONFIGURAR

    Route::resource('configurar/cargos', 'Configurar\CargosController');
    Route::post('configurar/cargos/create','Configurar\CargosController@store');
    Route::get('configurar/cargos/edit/{cargo_id?}','Configurar\CargosController@editar');
    Route::put('configurar/cargos/mod/{cargo_id?}','Configurar\CargosController@update');
    Route::delete('configurar/cargos/{cargo_id?}','Configurar\CargosController@destroy');

    Route::resource('configurar/categorias', 'Configurar\CategoriasController');
    Route::get('configurar/categorias/edit/{categoria_id?}','Configurar\CategoriasController@editar');
    Route::post('configurar/categorias','Configurar\CategoriasController@store');
    Route::put('configurar/categorias/mod/{categoria_id?}','Configurar\CategoriasController@update');
    Route::delete('configurar/categorias/{categoria_id?}','Configurar\CategoriasController@destroy');


    Route::resource('configurar/montos_delivery', 'Configurar\Montos_deliveryController');
    Route::get('configurar/montos_delivery/edit/{id?}','Configurar\Montos_deliveryController@editar');
    
    Route::put('configurar/montos_delivery/mod/{id?}','Configurar\Montos_deliveryController@update');
    Route::delete('configurar/montos_delivery/{id?}','Configurar\Montos_deliveryController@destroy');
    Route::get('configurar/montos_delivery/anular', [
        'uses' => 'configurar\Montos_deliveryController@anular',
        'as'   => 'montos_delivery.anular'
    ]);


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
    
    Route::resource('configurar/horas', 'Configurar\HorasController');
    Route::get('configurar/horas/edit/{hora_id?}','Configurar\HorasController@editar');
    Route::post('configurar/horas/create','Configurar\HorasController@store');
    Route::put('configurar/horas/mod/{hora_id?}','Configurar\HorasController@update');
    Route::delete('configurar/horas/{hora_id?}','Configurar\HorasController@destroy');
     
    Route::resource('configurar/formas', 'Configurar\FormaPagoController');
    Route::post('configurar/formas/create','Configurar\FormaPagoController@store');
    Route::get('configurar/formas/edit/{forma_id?}','Configurar\FormaPagoController@editar');
    Route::put('configurar/formas/mod/{forma_id?}','Configurar\FormaPagoController@update');
    Route::delete('configurar/formas/{forma_id?}','Configurar\FormaPagoController@destroy');
   




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
   Route::get('registro/productos/ajustar','Registro\ProductosController@modificar')->name("productos.ajustar");
   
   Route::get('productos/cambiar_nombres','Registro\ProductosController@cambiar_nombres')->name("productos/cambiar_nombres");
   Route::get('productos/cambiar_nombre_original','Registro\ProductosController@cambiar_nombre_original')->name("productos/cambiar_nombre_original");
   
   Route::get('productos/cambiar_precio','Registro\ProductosController@cambiar_precio')->name("productos/cambiar_precio");
   Route::get('productos/cambiar_precio_minimo','Registro\ProductosController@cambiar_precio_minimo')->name("productos/cambiar_precio_minimo");
   Route::get('productos/proveedor/crear','Registro\ProductosController@crear')->name("productos/proveedor/crear");

  Route::post('productos/almacenar','Registro\ProductosController@almacenar')->name("productos.almacenar");
   Route::get('registro/productos/proveedor','Registro\ProveedoresController@proveedor')->name("productos.proveedor");
  
    Route::get('registro/productos/detalle/{valor}', [
        'uses' => 'Registro\ProductosController@detalle',
        'as'   => 'productos.detalle'
    ]);



    Route::resource('registro/empleados', 'Registro\EmpleadosController');
    Route::resource('registro/empleados', 'Registro\EmpleadosController');
    Route::post('registro/empleados/create', 'Registro\EmpleadosController@create');
    Route::get('registro/empleados/editar/{id_empleado?}','Registro\EmpleadosController@editar');
    Route::put('registro/empleados/mod/{id_empleado?}','Registro\EmpleadosController@update');
    Route::delete('registro/empleados/{id_empleado?}','Registro\EmpleadosController@destroy');

    Route::get('registro/inventario', 'Registro\InventarioController@index')->name('inventario');


    //GALERIA
    Route::resource('galeria','GaleriaController');
    Route::get('galeria/{id}', [
        'uses' => 'GaleriaController@index',
        'as'   => 'galeria.index'
    ]);

    Route::get('galeria/destroy', [
        'uses' => 'GaleriaController@destroy',
        'as'   => 'galeria.destroy'
    ]);


    Route::get('galeria/new/{id}', [
        'uses' => 'GaleriaController@new',
        'as'   => 'galeria.new'
    ]);

     ////////


     // INVENTARIO

    Route::resource('inventario/entradas', 'Inventario\EntradasController');
    Route::get('entradas/anular', [
        'uses' => 'Inventario\EntradasController@anular',
        'as'   => 'entradas.anular'
    ]);
    Route::get('inventario/entradas', [
        'uses' => 'Inventario\EntradasController@index',
        'as'   => 'entradas.index'
    ]);
    Route::get('entradas/{id}/ver', [
        'uses' => 'Inventario\EntradasController@vista',
        'as'   => 'entradas.ver'
    ]);
     Route::get('entradas/{id}/pdf', [
        'uses' => 'Inventario\EntradasController@pdf',
        'as'   => 'entradas.pdf'
    ]);
    Route::get('entradas/{id}/confirmar', [
        'uses' => 'Inventario\EntradasController@confirmar',
        'as'   => 'entradas.confirmar'
    ]);
      Route::post('entradas/carga', [
        'uses' => 'Inventario\EntradasController@carga',
        'as'   => 'entradas.carga'
    ]);
      Route::post('entradas/update', [
        'uses' => 'Inventario\EntradasController@update',
        'as'   => 'entradas.update'
    ]);

  Route::post('entrada/store', [
        'uses' => 'Inventario\EntradasController@store',
        'as'   => 'entrada.store'
    ]);
    Route::get('cdetalle','Inventario\EntradasController@cargar_detalle');
    Route::get('edetalle','Inventario\EntradasController@eliminar_detalle');

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
    Route::get('gastos/anular', [
        'uses' => 'Registro\GastosController@anular',
        'as'   => 'gastos.anular'
    ]);

    
    
    ///////////

    // PROCESAR
    // 
     Route::resource('procesar/gastos', 'Registro\GastosController');
    
    Route::resource('procesar/ventas', 'Procesar\VentasController');
    Route::get('searchCliente/{tlf?}', 'Procesar\VentasController@getcliente')->name('searchCliente');
    Route::post('procesar/ventas/add', 'Procesar\VentasController@addventa');
    Route::post('procesar/ventas/create', 'Procesar\VentasController@create');
    Route::post('procesar/ventas/editar', 'Procesar\VentasController@editar_guardar');
    Route::get('/procesar/elimanarProdCesta/{prod?}/{client?}', 'Procesar\VentasController@delventa');
    Route::post('procesar/Ventas/delProdCesta/', 'Procesar\VentasController@deleditventa');
    Route::get('procesar/ventas/detalle/{valor}', 'Procesar\VentasController@detalle_producto');
    Route::get('logistica/Ventas/editar/{id_venta?}','Procesar\VentasController@editar_venta');
    

    Route::resource('procesar/remitos', 'Procesar\RemitosController');

    Route::get('procesar/descompuestos', 'Procesar\DescompuestoController@index')->name('descompuestos');

    Route::get('procesar/descompuestos/soporte', [
            'uses' => 'Procesar\DescompuestoController@soporte',
            'as'   => 'descompuestos.soporte'
        ]);

    Route::resource('procesar/aconfirmar', 'Procesar\AconfirmarController');

    
    Route::get('procesar/logistica', 'Procesar\LogisticaController@index')->name('logistica');
    Route::post('procesar/logistica', 'Procesar\LogisticaController@index')->name('logistica.submit');
    Route::get('procesar/logistica/edit', 'Procesar\LogisticaController@edit')->name('editar_logistica');
    Route::get('procesar/logistica/remisa', 'Procesar\LogisticaController@remisa')->name('logistica.remisa');
    Route::get('procesar/logistica/factura', 'Procesar\LogisticaController@factura')->name('logistica.factura');
    Route::get('procesar/logistica/movimiento', 'Procesar\LogisticaController@movimiento')->name('logistica.movimiento');
    Route::get('procesar/logistica/recibo', 'Procesar\LogisticaController@recibo')->name('logistica.recibo');
    Route::put('procesar/logistica/edithorario', 'Procesar\LogisticaController@edithorario')->name('edithorario');




//logistica
    Route::get('logistica', 'Procesar\LogisticaController@index')->name('logistica');
    Route::post('logistica', 'Procesar\LogisticaController@index')->name('logistica.submit');
    Route::get('logistica/edit', 'Procesar\LogisticaController@edit')->name('editar_logistica');
    Route::get('logistica/remisa', 'Procesar\LogisticaController@remisa')->name('logistica.remisa');
    Route::get('logistica/factura', 'Procesar\LogisticaController@factura')->name('logistica.factura');
    Route::get('logistica/movimiento', 'Procesar\LogisticaController@movimiento')->name('logistica.movimiento');
    Route::get('logistica/recibo', 'Procesar\LogisticaController@recibo')->name('logistica.recibo');
    Route::put('logistica/edithorario', 'Procesar\LogisticaController@edithorario')->name('edithorario');
    
    Route::resource('logistica/remitos', 'Procesar\RemitosController');
    Route::get('logistica/monitoreo', 'Procesar\RemitosController@monitoreo')->name('logistica.monitoreo');
///    
    Route::get('procesar/conversiones', 'Procesar\ConversionesController@index')->name('procesar.conversiones');
    Route::get('procesar/conversiones/new', 'Procesar\ConversionesController@new')->name('procesar.conversiones.new');
    Route::get('procesar/conversiones/show', 'Procesar\ConversionesController@show')->name('procesar.conversiones.show');

    Route::prefix('procesar')->group(function(){
        Route::resource('faltantes', 'Procesar\Faltantes\FaltantesController');
        Route::resource('faltantes-consolidado', 'Procesar\Faltantes\ConsolidadoController');
    });

    Route::resource('procesar/pedidos', 'Procesar\PedidosController');
    Route::get('caida', 'Procesar\PedidosController@venta_caida')->name('caida');
    Route::get('venta/devuelta', 'Procesar\PedidosController@venta_caida')->name('venta/devuelta');

    Route::get('procesar/pedidos/{id}/confirmar', [
        'uses' => 'Procesar\PedidosController@confirmar',
        'as'   => 'procesar.confirmar'
    ]);

Route::get('procesar/pedidos/{id}/nota', [
        'uses' => 'Procesar\PedidosController@agregar_nota',
        'as'   => 'procesar.notas'
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
    Route::get('seguridad/usuarios/crea_app', 'Seguridad\UsuariosController@crea_app')->name('usuarios.crea_app');
    Route::get('seguridad/usuarios/appdelivery', 'Seguridad\UsuariosController@appdelivery')->name('appdelivery');


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
    Route::get('caja/detalle', 'Caja\AbrirController@detalle')->name('caja.detalle');


    Route::get('caja/cierres', 'Caja\CierresController@index')->name('caja.cierres');
    Route::get('caja/cierres/resumen', 'Caja\CierresController@resumen')->name('caja.cierre.resumen');
    Route::get('caja/cierres/informe', 'Caja\CierresController@informe')->name('caja.cierre.informe');
    Route::get('caja/cierres/informe/modificado', 'Caja\CierresController@modificado')->name('caja.cierre.informe.modificado');

    Route::get('caja/historial', 'Caja\historialController@index')->name('caja.historial');
    

//////////////////////
/// DOCUMENTACION

    Route::get('documentacion', 'Documentacion\DocumentacionController@index')->name('documentacion');
    Route::get('documentacion/configurar', 'Documentacion\DocumentacionController@configurar')->name('documentacion.configurar');
    Route::get('documentacion/registro', 'Documentacion\DocumentacionController@registro')->name('documentacion.registro');
    Route::get('documentacion/inventario', 'Documentacion\DocumentacionController@inventario')->name('documentacion.inventario');
    Route::get('documentacion/procesar', 'Documentacion\DocumentacionController@procesar')->name('documentacion.procesar');
    Route::get('documentacion/caja', 'Documentacion\DocumentacionController@caja')->name('documentacion.caja');
    Route::get('documentacion/seguridad', 'Documentacion\DocumentacionController@seguridad')->name('documentacion.seguridad');





});
