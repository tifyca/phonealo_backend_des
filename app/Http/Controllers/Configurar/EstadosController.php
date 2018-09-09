<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Estados;

class EstadosController extends Controller
{
    public function index(Request $request){
    	$estados= Estados::paginate(10);
        if($request->ajax()){
            return response()->json(view('Configurar.Estados.lista',compact('estados'))->render());
        }

    	return view('Configurar.Estados.index')->with('estados',$estados);
    }

    public function editar($estado_id){
    $estado = Estados::find($estado_id);
    return response()->json($estado);
    }

    public function update (Request $request,$estado_id){
        $estado = Estados::find($estado_id);
        $estado->estado = $request->nombre;
        $estado->id_usuario=$request->id_usuario;
        $estado->save();
        return response()->json($estado);
    }


}
