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

     $estado = $request["buscarestado"];
     
   
    if($estado!="")
    {
        $estados= Estados::where('estado','LIKE', $estado.'%')->orderBy('estado','asc')->paginate(10);

    }
    if($estado=="")
    {
        $estados=  Estados::orderBy('estado','ASC')->paginate(10);
    }
  
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

   $data=$request->all();
   $rules = array( 'nombre'=>'required|unique:estados,estado,' .$estado_id); 
   $messages = array( 'nombre.required'=>'Nombre del Estado es Requerido', 
                      'nombre.unique' => 'El Estado ya Existe' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
        $estado = Estados::find($estado_id);
        $estado->estado = ucwords(strtolower($request->nombre));
        $estado->id_usuario=$request->id_usuario;
        $estado->save();
        return response()->json($estado);
    }

  }

}
