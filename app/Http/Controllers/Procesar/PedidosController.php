<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas;
use App\Detalles_Ventas;
use App\detalle;
use App\pedido;
use App\Estados;
use App\Facturas;
use App\Horarios;
use App\Monto_delivery;
use App\Forma_pago;
use App\Notas_Ventas;
use App\User;
use App\auditoria;
use App\Productos;
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
     $nota  =Notas_Ventas::join('users', 'notas_ventas.id_usuario', '=', 'users.id')
                            ->select('nota', 'id_venta', 'name as nombre', 'notas_ventas.created_at as fecha')
                            ->groupBy('id_venta', 'notas_ventas.id_usuario', 'notas_ventas.created_at')
                            ->orderBy('id_venta')
                            ->get();
 

        $notaventa= Notas_Ventas::join('ventas', 'notas_ventas.id_venta', '=', 'ventas.id')
                                ->select('notas_ventas.id_venta')->get();

       return view('Procesar.Pedidos.index')->with('pedidos',$pedidos)->with('id_usuario',$id_usuario)->with('nota',$nota)->with('notaventa',$notaventa);
    }

    public function show(Request $request)
    {

    }

    public function edit(Request $request)
    {

    }
    public function venta_caida(Request $request){
       $ventas=Ventas::find($request->id);
        if($ventas->isEmpty()){}
      else{
          $id = $ventas->id_pedido;
         $ventas->id_estado=2;
       $ventas->save();
       $pedidos=pedido::where('id',$id)->first();
       $pedidos->id_estado=2;
       $pedidos->save();
       $detalles= Detalles_Ventas::where("id_venta",$request->id)->get();
       foreach($detalles as $detalle){
         $id_producto = $detalles->id_producto;
         $cantidad    = $detalles->cantidad;
         $productos= Productos::where('id',$id_producto)->first();
         if($productos->isEmpty()){ 
         }else{
          $productos->stock = $productos->stock + $cantidad;
          $productos->save();
         }
       }
       $auditoria = new auditoria();
       $auditoria->id_venta   = $id;
       $auditoria->id_usuario =  $_SESSION["user"];
       $auditoria->fecha      = date('Y-m-d');
       $auditoria->accion     = "Procesando Venta Caida: Venta Nro".$request->id;
       $auditoria->save(); 

        }  
    }
    public function confirmar($id){

       $ventas=Ventas::find($id);
              if($ventas->isEmpty()){}
        else{
 
       $idp = $ventas->id_pedido;
       $ventas->id_estado=9;
       $ventas->save();
       $pedidos=pedido::where('id',$idp)->first();
       $pedidos->id_estado=9;
       $pedidos->save();
       $auditoria = new auditoria();
       $auditoria->id_venta   = $id;
       $auditoria->id_usuario =  $_SESSION["user"];
       $auditoria->fecha      = date('Y-m-d');
       $auditoria->accion     = "Confirmando Pedido: Venta Nro".$id;
       $auditoria->save(); }
       return redirect()->route('pedidos.index');
    }





    public function agregar_nota($id){
      
    }


    public function editar_venta($id){
        
      
         $horarios  = Horarios::all();
           $deliverys = Monto_delivery::all();
          $formas    = Forma_pago::all();
          $venta=Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
            ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
            ->leftjoin('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
            ->leftjoin('departamentos', 'clientes.id_departamento', '=', 'departamentos.id')
            ->leftjoin('facturas', 'ventas.id', '=', 'facturas.id_venta')
            ->leftjoin('horarios', 'ventas.id_horario', '=', 'horarios.id')
            ->leftjoin('forma_pago', 'ventas.id_forma_pago', '=', 'forma_pago.id')
                ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido','ventas.id_forma_pago', 'forma_pago.forma_pago', 'ventas.factura', 'ventas.id_horario', 'horarios.horario', 'ventas.fecha', 'ventas.fecha_activo', 'ventas.notas', 'ventas.id_estado', 'ventas.status_v','pedidos.id_cliente', 'clientes.id as idcliente','clientes.nombres','clientes.ruc_ci', 'clientes.id_tipo','clientes.email','clientes.telefono', 'clientes.direccion','clientes.ubicacion','clientes.barrio', 'departamentos.nombre as departamento', 'ciudades.ciudad as ciudad','barrio', 'clientes.id_ciudad as id_ciudad', 'clientes.id_departamento as id_departamento', 'ciudades.ciudad',  'facturas.nombres as fnombres',  'facturas.ruc_ci as fruc', 'facturas.direccion as fdireccion')
                ->where('ventas.id', $id)
                ->get();
          $detalles=Ventas::join('detalle_ventas', 'detalle_ventas.id_venta', '=','ventas.id')
                         ->join('productos', 'detalle_ventas.id_producto', '=','productos.id')
                         ->leftjoin('montos_delivery', 'montos_delivery.monto', '=','detalle_ventas.precio')
                         ->select('detalle_ventas.cantidad', 'detalle_ventas.precio', 'detalle_ventas.id_producto','montos_delivery.id as id_delivery', 'productos.codigo_producto', 'productos.nombre_original', 'productos.descripcion')
                         ->where('ventas.id', '=', $id)
                         ->get();
          
        
         return view('Procesar.Pedidos.edit', compact('venta','horarios','deliverys', 'formas', 'detalles'));
    }

public function update(Request $request,$id)
{
  $ventas=Ventas::find($id);
  $horario = $ventas->id_horario;
  $zhorario = $request->horario_venta;
  if($horario!=$zhorario)
  {
    $ventas->horario = $zhorario;
    
  } 
  $facturas=Facturas::where("id_venta",$id)->first();
  if(empty($facturas)){

  }else{
    $facturas->direccion = $request->factura_dir;

  }
    $auditoria = new auditoria();
    $auditoria->id_usuario =  $_SESSION["user"];
    $auditoria->id_venta   = $id;
    $auditoria->fecha      = date('Y-m-d');
    $auditoria->accion     = "Modificación de Pedido: Venta Nro".$id;
    $auditoria->save();  
    return redirect()->route('pedidos.index');
 }

}
