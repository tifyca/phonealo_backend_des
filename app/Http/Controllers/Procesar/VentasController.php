<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clientes;

class VentasController extends Controller
{
    public function index(){
    	return view('Procesar.Ventas.index');
    }

    public function getcliente($telefono){

    
    	$clientes=Clientes::where('telefono', $telefono)->get();

         	return ($clientes);
   	}
}
