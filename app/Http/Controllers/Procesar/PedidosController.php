<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas;
use App\Detalles_Ventas;
use App\detalle;
use App\pedido;
use App\Estados;
use App\Notas_Ventas;
use App\Http\User;
use DB;
@session_start();

class PedidosController extends Controller
{
    public function index(Request $request)
    {
      $id_pedido = $request->id_pedido;
      $telefono  = $request->telefono;	
      $id_usuario =  $_SESSION["user"];
      if($id_pedido=="" && $telefono=="")
      {
       $pedidos = DB::table('pedidos as a')->join('detalle_pedidos as b','a.id','=','b.id_pedido')->join('clientes as c','a.id_cliente','=','c.id')->join('estados as d','a.id_estado','=','d.id')->leftjoin('users as e','a.id_usuario','=','e.id')->join('ventas as f','a.id','=','f.id_pedido')->select('a.id','f.id as id_venta','a.fecha','a.id_estado','a.id_cliente','c.nombres','c.telefono','c.barrio','c.direccion',DB::raw('sum(b.precio * b.cantidad) as monto'),'a.id_usuario','d.estado','e.name')->groupBy('a.id')->orderby('a.fecha','desc')->paginate(10);

      }
      if($id_pedido!="" && $telefono=="")
      {
       $pedidos = DB::table('pedidos as a')->join('detalle_pedidos as b','a.id','=','b.id_pedido')->join('clientes as c','a.id_cliente','=','c.id')->join('estados as d','a.id_estado','=','d.id')->leftjoin('users as e','a.id_usuario','=','e.id')->join('ventas as f','a.id','=','f.id_pedido')->select('a.id','a.fecha','f.id as id_venta','a.id_estado','a.id_cliente','c.nombres','c.telefono','c.barrio','c.direccion',DB::raw('sum(b.precio * b.cantidad) as monto'),'a.id_usuario','d.estado','e.name')->where('f.id',$id_pedido)->groupBy('a.id')->orderby('a.fecha','desc')->paginate(10);

      }
      if($id_pedido=="" && $telefono!="")
      {
       $pedidos = DB::table('pedidos as a')->join('detalle_pedidos as b','a.id','=','b.id_pedido')->join('clientes as c','a.id_cliente','=','c.id')->join('estados as d','a.id_estado','=','d.id')->leftjoin('users as e','a.id_usuario','=','e.id')->join('ventas as f','a.id','=','f.id_pedido')->select('a.id','f.id as id_venta','a.fecha','a.id_estado','a.id_cliente','c.nombres','c.telefono','c.barrio','c.direccion',DB::raw('sum(b.precio * b.cantidad) as monto'),'a.id_usuario','d.estado','e.name')->where('c.telefono',$telefono)->groupBy('a.id')->orderby('a.fecha','desc')->paginate(10);

      }

      if($id_pedido!="" && $telefono!="")
      {
       $pedidos = DB::table('pedidos as a')->join('detalle_pedidos as b','a.id','=','b.id_pedido')->join('clientes as c','a.id_cliente','=','c.id')->join('estados as d','a.id_estado','=','d.id')->leftjoin('users as e','a.id_usuario','=','e.id')->join('ventas as f','a.id','=','f.id_pedido')->select('a.id','f.id as id_venta','a.fecha','a.id_estado','a.id_cliente','c.nombres','c.telefono','c.barrio','c.direccion',DB::raw('sum(b.precio * b.cantidad) as monto'),'a.id_usuario','d.estado','e.name')->where('c.telefono',$telefono)->where('f.id',$id_pedido)->groupBy('a.id')->orderby('a.fecha','desc')->paginate(10);

      }
      $notas=DB::table('notas_ventas as a')->join('users as b','a.id_usuario','=','b.id')->select('a.id_venta','a.nota','b.name')->orderby('a.id_venta')->get();

       return view('Procesar.Pedidos.index')->with('pedidos',$pedidos)->with('id_usuario',$id_usuario)->with('notas',$notas);
    }

    public function show(Request $request)
    {

    }

    public function edit(Request $request)
    {

    }
    public function venta_caida(Request $request){
       $ventas=Ventas::find($request->id);
       $id = $ventas->id_pedido;
       $ventas->id_estado=2;
       $ventas->save();
       $pedidos=pedido::where('id',$id)->first();
       $pedidos->id_estado=2;
       $pedidos->save();
       return $pedidos;
    }
    public function confirmar($id){

       $ventas=Ventas::find($id);
       $idp = $ventas->id_pedido;
       $ventas->id_estado=9;
       $ventas->save();
       $pedidos=pedido::where('id',$idp)->first();
       $pedidos->id_estado=9;
       $pedidos->save();
       return redirect()->route('pedidos.index');
    }

    public function venta_devuelta(Request $request){
       $ventas=Ventas::find($request->id);
       $id = $ventas->id_pedido;
       $ventas->id_estado=4;
       $ventas->save();
       $pedidos=pedido::where('id',$id)->first();
       $pedidos->id_estado=4;
       $pedidos->save();
       return $pedidos;
    }




    public function agregar_nota($id){
      
    }

}
