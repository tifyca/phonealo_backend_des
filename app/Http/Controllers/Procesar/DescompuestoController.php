<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DescompuestoController extends Controller
{
    public function index(){

    	/*$descompuesto=Soporte::join('productos', 'productos..id_producto', '=', 'soporte.id_producto')
    						 ->join('ventas', 'ventas.id_pe', '=', 'soporte.id_producto')
    						 ->whereIn('status_soporte', 1,3)
    						 ->orderBy('soporte.id')
    						 ->get(), compact('descompuesto');*/

    	return view('Procesar.Descompuesto.index');
    }
    public function soporte(){
    	return view('Procesar.Descompuesto.soporte');
    }
}
