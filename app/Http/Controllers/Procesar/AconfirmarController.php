<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas;
use App\User;
use App\Notas_Ventas;

class AconfirmarController extends Controller
{
    public function index(){

    	$aconfirmar = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
    						 ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
    						 ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
    						 ->leftjoin('estados', 'ventas.id_estado', '=', 'estados.id')
    						 ->where('ventas.id_estado', 9)
    						 ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.id_estado', 'ventas.fecha', 'pedidos.id_cliente', 'pedidos.id_usuario', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.barrio', 'users.name', 'estados.estado')
    						 ->orderBy('ventas.fecha')
    						 ->get();

    	$vendedor= User::all();

    	 $nota  =Notas_Ventas::join('users', 'notas_ventas.id_usuario', '=', 'users.id')
                            ->select('nota', 'id_venta', 'name as nombre', 'notas_ventas.created_at as fecha')
                            ->groupBy('id_venta', 'notas_ventas.id_usuario', 'notas_ventas.created_at')
                            ->orderBy('id_venta')
                            ->get();
 

        $notaventa= Notas_Ventas::join('ventas', 'notas_ventas.id_venta', '=', 'ventas.id')
                                ->select('notas_ventas.id_venta')->get();

    		return view('Procesar.Aconfirmar.index', compact('aconfirmar','vendedor', 'nota', 'notaventa'));
    }
}
