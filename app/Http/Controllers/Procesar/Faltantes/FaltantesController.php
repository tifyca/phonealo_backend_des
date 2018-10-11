<?php

namespace App\Http\Controllers\Procesar\Faltantes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pedido;

class FaltantesController extends Controller
{
    public function index(Request $request){      
        $producto = $request->producto;
        $fecha = $request->fecha;
        if ( $producto && !$fecha) {
            $pedidos = pedido::enEspera()
                ->where(function($query) use ($producto){
                    $query->where('productos.codigo_producto', 'like', '%'.$producto.'%')
                    ->orWhere('productos.descripcion', 'like', '%'.$producto.'%');
                })
                ->paginate(10);         
        }elseif( $fecha && !$producto) {
             $pedidos = pedido::enEspera()
                ->where('ventas.fecha', $fecha)    
                ->paginate(10);
        }elseif ( $producto && $fecha ) {
            $pedidos = pedido::enEspera()
                ->where('ventas.fecha', $fecha)
                ->where(function($query) use ($producto){
                    $query->where('productos.codigo_producto', 'like', '%'.$producto.'%')
                    ->orWhere('productos.descripcion', 'like', '%'.$producto.'%');                    
                })
                ->paginate(10);
        }else{
            $pedidos = pedido::EnEspera()->paginate(10);            
        }

       return view("Procesar.Faltantes.index", compact('pedidos')); 
    }
    public function show($id){
        return "show " . $id;
    }
    public function store(Request $request){

    }
    public function edit($id){

    }
    public function update(Request $request, $id){

    }
}


// Probando