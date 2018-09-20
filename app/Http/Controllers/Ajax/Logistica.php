<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Ventas;
class Logistica extends Controller
{
    #jgonzalez
   	public function detalle_venta(Request $request){
    	$id = $request['id'];
    	$venta = Ventas::Detalle($id);
    	return $venta;
    }

}
