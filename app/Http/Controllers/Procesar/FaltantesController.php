<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pedido;
use DB;

class FaltantesController extends Controller
{
    public function index(Request $request){
        $producto = $request->producto;
        if ( $producto ) {
            $pedidos = pedido::enEspera()
                ->where(function($query) use ($producto){
                    $query->where('productos.codigo_producto', 'like', '%'.$producto.'%')
                    ->orWhere('productos.descripcion', 'like', '%'.$producto.'%');                    
                })
                ->paginate(10);         
        }else{
            $pedidos = pedido::EnEspera()->paginate(10);            
        }


        // return dd($pedidos);

       return view("Procesar.Faltantes.index", compact('pedidos')); 
    }
    public function show($id){

    }
    public function store(Request $request){

    }
    public function edit($id){

    }
    public function update(Request $request, $id){

    }
}


// Probando