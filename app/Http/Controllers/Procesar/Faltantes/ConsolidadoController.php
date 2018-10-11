<?php

namespace App\Http\Controllers\Procesar\Faltantes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pedido;

class ConsolidadoController extends Controller
{
    public function index(Request $request){
        $producto = $request->producto;
        if ( $producto ) {
            $pedidos = pedido::Consolidado()
                ->where(function($query) use ($producto){
                    $query->where('productos.codigo_producto', 'like', '%'.$producto.'%')
                    ->orWhere('productos.descripcion', 'like', '%'.$producto.'%');
                })
                ->paginate(10);
        }else{
            $pedidos = pedido::Consolidado()->paginate(10);            
        }

        return view('Procesar.Faltantes.Consolidado.index', compact('pedidos'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return $id;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
}
