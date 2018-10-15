<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//rutas para appdelivery
Route::post('delivery/ingresar', 'api\delivery\RepartidoresController@ingresar');
Route::get('delivery/iniciarjornada', 'api\delivery\RepartidoresController@iniciarjornada');
Route::get('delivery/pedidos/{id}', 'api\delivery\RepartidoresController@pedidos_asignados');
Route::get('delivery/detalle/{id}', 'api\delivery\RepartidoresController@detalle_venta');
Route::post('delivery/entrega/{id}', 'api\delivery\RepartidoresController@marca_entrega');
Route::post('delivery/observaciones/{id}', 'api\delivery\RepartidoresController@observaciones');

//documentacion delivery
Route::get('delivery/documentacion', 'api\delivery\documentacionController@index');
Route::get('delivery/documentacion/ingresar', 'api\delivery\documentacionController@ingresar')->name('delivery.documentacion.ingresar');
//rutas para appecommerce