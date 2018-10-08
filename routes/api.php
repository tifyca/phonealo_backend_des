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

Route::post('ingresar', 'api\RepartidoresController@iniciar');
Route::get('pedidos/{id}', 'api\RepartidoresController@pedidos_asignados');
Route::post('iniciar', 'api\RepartidoresController@iniciar_jornada');
Route::get('detalle/{id}', 'api\RepartidoresController@detalle_venta');
Route::post('entrega/{id}', 'api\RepartidoresController@marca_entrega');
Route::post('observaciones/{id}', 'api\RepartidoresController@observaciones');