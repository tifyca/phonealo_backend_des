<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pedido;

class FaltantesController extends Controller
{
    public function index(Request $request){
        $pedidos = pedido::orderBy('id', 'ASC')->where('id_estado', 5)->paginate(10);
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