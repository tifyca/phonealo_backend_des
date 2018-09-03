<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;

class ProductosAjax extends Controller
{
    public function productos_list(Request $request){
    	$producto = $request['producto'];
    	$cadena = $producto.'%';

    	$productos = Productos::where('descripcion', 'LIKE', $cadena)->orderBy('descripcion', 'asc')->get();

    	return $productos;
    }

    public function producto(Request $request){
    	$id_producto = $request['id_producto'];

    	$productos = Productos::where('id_producto', $id_producto)->first();

    	return $productos;
    }
}
