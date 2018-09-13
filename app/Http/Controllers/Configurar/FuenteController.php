<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Fuente;
use Redirect;
use Illuminate\Support\Facades\Validator;




class FuenteController extends Controller
{
    public function index(Request $request){

      $fuente = $request["buscarfuente"];
     $status   = $request["selectstatus"];
   
    if($fuente!="" && $status=="" )
    {
        $fuentes= Fuente::where('fuente','LIKE', $fuente.'%')->orderBy('fuente','asc')->paginate(10);

    }
    if($fuente=="" && $status!="")
    {
        $fuentes=  Fuente::where('status',$status)->paginate(10);
    }
     if($fuente!="" && $status!="")
    {
        $fuentes=  Fuente::where('status',$status)
                         ->where('fuente','LIKE', $fuente.'%')->orderBy('fuente','asc')->paginate(10);
    }
  

    if($fuente=="" && $status=="")
    {
        $fuentes= Fuente::orderBy('fuente','ASC')->paginate(10);
    }      
    	
      if($request->ajax()){
            return response()->json(view('Configurar.Fuente.lista',compact('fuentes'))->render());
        }

    	return view('Configurar.Fuente.index')->with('fuentes',$fuentes);
    	
    }

    public function store(Request $request){

    $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:fuente_financiamiento,fuente', 
                   'status'=>'required'); 
   $messages = array( 'nombre.required'=>'Nombre de la Fuente de Financiamiento es Requerido', 
                      'nombre.unique' => 'La Fuente de Financiamiento ya Existe', 
                      'status.required'=>'El Estatus es Requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
      $fuente= new Fuente; 
      $fuente->fuente = $request->nombre; 
      $fuente->status =$request->status;
      $fuente->id_usuario=$request->id_usuario; 
      $fuente->save(); 


      return response()->json($fuente);

      }  
        
    }

  public function editar($fuente_id){
    $fuente = Fuente::find($fuente_id);
    return response()->json($fuente);
    }

  public function update (Request $request,$fuente_id){

     $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:fuente_financiamiento,fuente,' .$fuente_id, 
                   'status'=>'required'); 
   $messages = array( 'nombre.required'=>'Nombre de la Fuente de Financiamiento es Requerido', 
                      'nombre.unique' => 'La Fuente de Financiamiento ya Existe', 
                      'status.required'=>'El Estatus es Requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
        $fuente = Fuente::find($fuente_id);
        $fuente->fuente = $request->nombre;
        $fuente->status = $request->status;
        $fuente->id_usuario=$request->id_usuario;
        $fuente->save();
        return response()->json($fuente);
    }

  }

  public function destroy($fuente_id){
      $fuente = Fuente::destroy($fuente_id);
      return response()->json($fuente);
    }

}
