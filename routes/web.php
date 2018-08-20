<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('configurar/cargos', 'Configurar\CargosController@index')->name('cargos');
    Route::get('configurar/categorias', 'Configurar\CategoriasController@index')->name('categorias');
    Route::get('configurar/divisas', 'Configurar\DivisasController@index')->name('divisas');
    Route::get('configurar/estados', 'Configurar\EstadosController@index')->name('estados');
    Route::get('configurar/gastos', 'Configurar\GastosController@index')->name('gastos');
    Route::get('configurar/tipocliente', 'Configurar\TipoClienteController@index')->name('tipocliente');
    


Route::get('usuarios/cambiar/{valor}', [
		'uses' => 'UsersController@cambiar',
		'as'   => 'usuarios.cambiar'
	]);
Route::put('usuarios/update_password/{valor}', [
		'uses' => 'UsersController@update_password',
		'as'   => 'usuarios.update_password'
	]);
   
    
    
  
  
});
