<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Soporte;

class DescompuestoController extends Controller
{
    public function index(){

    	$descompuesto=Soporte::join('productos', 'productos.id', '=', 'soporte.id_producto')
    						 ->whereIn('status_soporte', [1,3])
    						//->join('ventas', 'ventas.id_pedido', '=', 'soporte.id_pedido')
    						 ->select('soporte.id as idsoporte', 'soporte.id_producto', 'soporte.id_remito','soporte.id_pedido','soporte.nota','soporte.fecha_ing','soporte.fecha_eg','soporte.status_soporte', 'productos.id', 'productos.descripcion','productos.precio_compra')
    						 ->orderBy('soporte.id', 'DESC')
    						 ->get();
    

    	return view('Procesar.Descompuesto.index', compact('descompuesto'));
    }
    public function soporte(){


    	$soporte=Soporte::join('productos', 'productos.id', '=', 'soporte.id_producto')
    						 ->whereIn('status_soporte', [2])
    						//->join('ventas', 'ventas.id_pedido', '=', 'soporte.id_pedido')
    						 ->select('soporte.id as idsoporte', 'soporte.id_producto', 'soporte.id_remito','soporte.id_pedido','soporte.nota','soporte.fecha_ing','soporte.fecha_eg','soporte.status_soporte', 'productos.id', 'productos.descripcion','productos.precio_compra')
    					     ->get();


    	return view('Procesar.Descompuesto.soporte', compact('soporte'));
    }
}
