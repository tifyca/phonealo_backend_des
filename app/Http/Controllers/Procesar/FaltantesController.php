<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pedido;
use DB;

class FaltantesController extends Controller
{
    public function index(Request $request){

        // $pedidos = DB::table('pedidos')
            // ->leftjoin('clientes', 'pedidos.id_cliente', 'clientes.id')
            // ->leftjoin('detalle_pedidos', 'pedidos.id', 'detalle_pedidos.id_pedido')
            // ->leftjoin('productos', 'detalle_pedidos.id_producto', 'productos.id')
            // ->leftjoin('categorias', 'productos.id_categoria', 'categorias.id')
            // ->leftjoin('empleados', 'pedidos.id_usuario', 'empleados.id')
            // ->leftjoin('ventas', 'pedidos.id', 'ventas.id_pedido')
            // ->select('clientes.nombres', 'clientes.telefono', 'productos.codigo_producto', 'productos.descripcion', 'productos.stock_activo', 'categorias.categoria', 'detalle_pedidos.cantidad', 'empleados.nombres as nombresEmpleado', 'pedidos.id_usuario', 'ventas.fecha')
            // ->where('pedidos.id_estado', 5)
            // ->paginate(10);

        $pedidos = pedido::enEspera()->paginate(10);
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