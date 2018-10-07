<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas;
use App\Detalles_Ventas;
use App\detalle;
use App\pedido;
use App\Estados;
use App\Http\User;
use DB;
@session_start();

class PedidosController extends Controller
{
    public function index(Request $request)
    {

       $pedidos = DB::table('pedidos as a')->join('detalle_pedidos as b','a.id','=','b.id_pedido')->join('clientes as c','a.id_cliente','=','c.id')->join('estados as d','a.id_estado','=','d.id')->leftjoin('users as e','a.id_usuario','=','e.id')->select('a.id','a.fecha','a.id_estado','a.id_cliente','c.nombres','c.telefono','c.barrio','c.direccion',DB::raw('sum(b.precio * b.cantidad) as monto'),'a.id_usuario','d.estado','e.name')->groupBy('a.id')->orderby('a.fecha','desc')->paginate(10);
       return view('Procesar.Pedidos.index')->with('pedidos',$pedidos);
    }

    public function show(Request $request)
    {

    }

    public function edit(Request $request)
    {

    }


}
