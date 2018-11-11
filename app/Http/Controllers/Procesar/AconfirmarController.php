<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas;
use App\User;
use App\Notas_Ventas;
use App\Detalle_Ventas;
use App\Productos;


class AconfirmarController extends Controller
{
    public function index(Request $request){

        $vendedor=$request->vendedor;
        $venta=$request->venta;
        $fecha=$request->fecha;

        if($vendedor!="" && $venta=="" && $fecha==""  ){

        $aconfirmar = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                             ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                             ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
                             ->leftjoin('estados', 'ventas.id_estado', '=', 'estados.id')
                             ->where('ventas.id_estado', 9)
                             ->where('ventas.id_usuario', $vendedor)
                             ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.id_estado', 'ventas.fecha', 'pedidos.id_cliente', 'pedidos.id_usuario', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.barrio', 'users.name', 'estados.estado')
                             ->orderBy('ventas.fecha')
                             ->get();

        }
        if($vendedor=="" && $venta!="" && $fecha==""  ){

        $aconfirmar = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                             ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                             ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
                             ->leftjoin('estados', 'ventas.id_estado', '=', 'estados.id')
                             ->where('ventas.id_estado', 9)
                             ->where('ventas.id', $venta)
                             ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.id_estado', 'ventas.fecha', 'pedidos.id_cliente', 'pedidos.id_usuario', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.barrio', 'users.name', 'estados.estado')
                             ->orderBy('ventas.fecha')
                             ->get();

        }
        if($vendedor=="" && $venta=="" && $fecha!=""  ){

        $aconfirmar = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                             ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                             ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
                             ->leftjoin('estados', 'ventas.id_estado', '=', 'estados.id')
                             ->where('ventas.id_estado', 9)
                             ->where('ventas.fecha', $fecha)
                             ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.id_estado', 'ventas.fecha', 'pedidos.id_cliente', 'pedidos.id_usuario', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.barrio', 'users.name', 'estados.estado')
                             ->orderBy('ventas.fecha')
                             ->get();

        }
        if($vendedor!="" && $venta!="" && $fecha==""  ){

        $aconfirmar = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                             ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                             ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
                             ->leftjoin('estados', 'ventas.id_estado', '=', 'estados.id')
                             ->where('ventas.id_estado', 9)
                             ->where('ventas.id_usuario', $vendedor)
                             ->where('ventas.id', $venta)
                             ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.id_estado', 'ventas.fecha', 'pedidos.id_cliente', 'pedidos.id_usuario', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.barrio', 'users.name', 'estados.estado')
                             ->orderBy('ventas.fecha')
                             ->get();

        }
         if($vendedor!="" && $venta=="" && $fecha!=""  ){

        $aconfirmar = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                             ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                             ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
                             ->leftjoin('estados', 'ventas.id_estado', '=', 'estados.id')
                             ->where('ventas.id_estado', 9)
                             ->where('ventas.id_usuario', $vendedor)
                             ->where('ventas.fecha', $fecha)
                             ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.id_estado', 'ventas.fecha', 'pedidos.id_cliente', 'pedidos.id_usuario', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.barrio', 'users.name', 'estados.estado')
                             ->orderBy('ventas.fecha')
                             ->get();

        }
        if($vendedor=="" && $venta!="" && $fecha!=""  ){

        $aconfirmar = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                             ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                             ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
                             ->leftjoin('estados', 'ventas.id_estado', '=', 'estados.id')
                             ->where('ventas.id_estado', 9)
                             ->where('ventas.id', $venta)
                             ->where('ventas.fecha', $fecha)
                             ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.id_estado', 'ventas.fecha', 'pedidos.id_cliente', 'pedidos.id_usuario', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.barrio', 'users.name', 'estados.estado')
                             ->orderBy('ventas.fecha')
                             ->get();

        }
        if($vendedor!="" && $venta!="" && $fecha!=""  ){

        $aconfirmar = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
                             ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
                             ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
                             ->leftjoin('estados', 'ventas.id_estado', '=', 'estados.id')
                             ->where('ventas.id_estado', 9)
                              ->where('ventas.id_usuario', $vendedor)
                             ->where('ventas.id', $venta)
                             ->where('ventas.fecha', $fecha)
                             ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.id_estado', 'ventas.fecha', 'pedidos.id_cliente', 'pedidos.id_usuario', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.barrio', 'users.name', 'estados.estado')
                             ->orderBy('ventas.fecha')
                             ->get();

        }
        if($vendedor=="" && $venta=="" && $fecha==""  ){


    	$aconfirmar = Ventas::leftjoin('pedidos', 'ventas.id_pedido', '=', 'pedidos.id')
    						 ->leftjoin('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
    						 ->leftjoin('users', 'pedidos.id_usuario', '=', 'users.id')
    						 ->leftjoin('estados', 'ventas.id_estado', '=', 'estados.id')
    						 ->where('ventas.id_estado', 9)
    						 ->select('ventas.id', 'ventas.importe', 'ventas.id_pedido', 'ventas.id_estado', 'ventas.fecha', 'pedidos.id_cliente', 'pedidos.id_usuario', 'clientes.nombres', 'clientes.telefono', 'clientes.direccion', 'clientes.barrio', 'users.name', 'estados.estado')
    						 ->orderBy('ventas.fecha')
    						 ->get();

        }
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

    public function reactivar(Request $request){

        dd($request->id);


        $dtventa=Detalle_Ventas::join('productos', 'detalle_ventas.id_producto', '=', 'productos.id')
                             ->where('detalle_ventas.id_venta', $request->id)
                             ->select('detalle_ventas.id_producto', 'detalle_ventas.cantidad', 'productos.stock_activo')
                             ->get();
        $completo=1;

        foreach ($dtventa as $key) {
            if($key->stock_activo<$key->cantidad){
                $completo=0;
            }
        }

        if($completo==1){

           // foreach ($dtventa as $keyo) {

              /*  $producto= Productos::find($keyo->id_producto);
                $producto->stock_activo=$producto->stock_activo-$keyo->cantidad;
                $producto->stock_provisorio=$producto->stock_provisorio-$keyo->cantidad;
                $producto->save;*/

                $venta=Ventas::find($request->id);
                $venta->id_estado=1;
                $venta->fecha_activo=CURDATE();
                $venta->save();
          //  }
        }else{

            $venta=Ventas::find($request->id);
            $venta->id_estado=5;
            $venta->save();
        }

        return $dtventa;
    }

}
