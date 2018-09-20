<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Ventas;
use App\Ciudades;
use App\Horarios;

class LogisticaController extends Controller
{
    public function index(){
    	#jgonzalez 
    	$ventas = Ventas::Listado();
    	$ciudades = Ciudades::get();
    	$horarios = Horarios::get();
    	return view('Procesar.Logistica.index', compact('ventas', 'ciudades', 'horarios'));
    }
    public function edit(){
    	return view('Procesar.Logistica.edit');
    }
    public function remisa(){
    	return view('Procesar.Logistica.remisa');
    }
}
