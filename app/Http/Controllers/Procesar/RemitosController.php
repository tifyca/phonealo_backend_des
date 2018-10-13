<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Remitos;

class RemitosController extends Controller
{
    public function index(){

    	$remitos = Remitos::groupBy('remitos.id')
	    	->join('detalle_remito', 'remitos.id', 'detalle_remito.id_remito')
    		->join('empleados', 'remitos.id_delivery', 'empleados.id')
    		->join('estados', 'remitos.id_estado', 'estados.id')
    		// ->join('ventas', 'ventas.id', 'detalle_remito.id_venta')
    		// ->join('pedidos', 'ventas.id_pedido', 'pedidos.id')
            // ->join('clientes', 'pedidos.id_cliente', 'clientes.id')
    		->select(
    			'remitos.id', 'remitos.fecha', 'remitos.importe',
    			'empleados.nombres', 
    			'estados.estado'
    			// 'clientes.nombres as nombre_cliente'

    		)
    		->paginate(10);

    	return view('Procesar.Remitos.index', compact('remitos', 'suma'));
    }
}
