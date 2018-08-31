<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cargos;
use Redirect;
use Illuminate\Support\Facades\Validator;




class CargosController extends Controller
{
    public function index(){
    	$cargos= Cargos::all();
    	return view('Configurar.Cargos.index')->with('cargos',$cargos);

    }

  public function store(Request $request){

    $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:cargos,cargo', 
                   'status'=>'required'); 
   $messages = array( 'nombre.required'=>'Nombre del cargo es requerido', 
                      'nombre.unique' => 'El cargo ya existe', 
                      'status.required'=>'El estatus es requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
      $cargo= new Cargos; 
      $cargo->cargo = $request->nombre; 
      $cargo->status =$request->status; 
      $cargo->id_usuario=$request->id_usuario;
      $cargo->save(); 
      return response()->json($cargo);

      }  
        
    }

  public function editar($cargo_id){
    $cargo = Cargos::find($cargo_id);
    return response()->json($cargo);
    }

  public function update (Request $request,$cargo_id){
        $cargo = Cargos::find($cargo_id);
        $cargo->cargo = $request->nombre;
        $cargo->status = $request->status;
        $cargo->id_usuario=$request->id_usuario;
        $cargo->save();
        return response()->json($cargo);
    }

  public function destroy($cargo_id){
      $cargo = Cargos::destroy($cargo_id);
      return response()->json($cargo);
    }

}
