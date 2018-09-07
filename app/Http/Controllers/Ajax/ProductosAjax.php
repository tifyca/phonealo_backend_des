<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Subcategorias;
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

    	$productos = Productos::where('id', $id_producto)->first();

    	return $productos;
    }

    public function subcategorias_list(Request $request)
    {
        $id_categoria = $request["idc"];
        $subcategorias = Subcategorias::where('id_categoria',$id_categoria)->where('status','1')->get();
        return $subcategorias;
    }
}