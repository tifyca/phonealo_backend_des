<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Ventas;
use App\Ciudades;
use App\Horarios;

class LogisticaController extends Controller
{
    public function index(){
    	
    	$ventas = DB::table('ventas')
    		->join('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
    		->join('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
    		->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
    		->select('ventas.*', 'pedidos.id_cliente', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'ciudades.ciudad')
    		->where('ventas.id_estado', '=', '1')
    		->where('ventas.status_v', '=', '11')
    		->orwhere('ventas.id_estado', '=', '11')
    		->where('ventas.status_v', '=', '11')
    		->orderby('ventas.horario_entrega', 'desc')
    		->get();
    	$ciudades = Ciudades::get();
    	$horarios = Horarios::get();
    #dd($horarios);
    	return view('Procesar.Logistica.index', compact('ventas', 'ciudades', 'horarios'));
    }
    public function edit(){
    	return view('Procesar.Logistica.edit');
    }
    public function remisa(){
    	return view('Procesar.Logistica.remisa');
    }
}
