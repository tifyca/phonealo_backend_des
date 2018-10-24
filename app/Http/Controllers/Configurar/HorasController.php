<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Horarios;


class HorasController extends Controller
{
    public function index(Request $request){


     $horario = $request["hora"];
     $status_v   = $request["selectven"];
     $status   = $request["status"];
   
    if($horario!="" && $status=="" &&  $status_v=="" )
    {
        $horarios= Horarios::search($horario)->orderBy('horario','asc')->paginate(10);

    }
    if($horario=="" && $status!="" &&  $status_v=="")
    {
        $horarios=  Horarios::status($status)->orderBy('horario','asc')->paginate(10);
    }
    if($horario=="" && $status=="" && $status_v!="")
    {
        $horarios=  Horarios::status_v($status_v)->orderBy('horario','asc')->paginate(10);
        
    }
    if($horario!="" && $status!="" && $status_v!="")
    {
        $horarios=  Horarios::search2($status_v, $status, $horario)->orderBy('horario','asc')->paginate(10);
        
    }
     if($horario!="" && $status!="" && $status_v=="")
    {
        $horarios=  Horarios::search3($status, $horario)->orderBy('horario','asc')->paginate(10);
        
    }
     if($horario!="" && $status=="" && $status_v!="")
    {
        $horarios=  Horarios::search4($status_v, $horario)->orderBy('horario','asc')->paginate(10);
        
    }
    if($horario=="" && $status=="" && $status_v=="")
    {
        $horarios= Horarios::orderBy('horario','ASC')->paginate(10);
    }
     if($horario=="" && $status!="" && $status_v!="")
    {
        $horarios=  Horarios::search5($status_v,$status)->orderBy('horario','asc')->paginate(10);
        
    }

    
            if($request->ajax())
            {
                  return response()->json(view('Configurar.Horas.lista',compact('horarios'))->render());
            }
             
            return view('Configurar.Horas.index')->with('horarios',$horarios);
            
    
  } 
    	

    public function store(Request $request){  

      $data=$request->all();

      $rules = array( 'nombre'=>'required|unique:horarios,horario',
                      'status_v'=> 'required|not_in:""',
                      'status'=>'required'); 
      $messages = array( 'nombre.required'=>'El Horario  es Requerido', 
                      'nombre.unique' => 'El Horario ya Existe', 
                      'status_v.required'=>'El Estatus de la Venta es Requerido',
                       'status_v.not_in'=>'El Estatus de la Venta es Requerido',
                      'status.required'=>'El Estatus es Requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 

        $horario= new Horarios;
        $horario->status_v = $request->status_v;
        $horario->horario= ucwords(strtolower($request->nombre));  
        $horario->status   = $request->status;
        $horario->id_usuario=$request->id_usuario;
        $horario->save();
        return response()->json($horario);
      }  
        
    }


  public function editar($hora_id){
    $horario = Horarios::find($hora_id);

    return response()->json($horario);
    }


   public function update (Request $request,$hora_id){

      $data=$request->all();
      $rules = array( 'nombre'=>'required|unique:horarios,horario,' .$hora_id ,
                      'status_v'=> 'required|not_in:""',
                      'status'=>'required'); 
      $messages = array( 'nombre.required'=>'El Horario  es Requerido', 
                      'nombre.unique' => 'El Horario ya Existe', 
                      'status_v.required'=>'El Estatus de la Venta es Requerido',
                       'status_v.not_in'=>'El Estatus de la Venta es Requerido',
                      'status.required'=>'El Estatus es Requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 

        $horario = Horarios::find($hora_id);
        $horario->status_v = $request->status_v;
        $horario->horario= ucwords(strtolower($request->nombre));  
        $horario->status   = $request->status;
        $horario->id_usuario=$request->id_usuario;
        $horario->save();
        return response()->json($horario);
    }

  }

  public function destroy($hora_id){
      $horario = Horarios::destroy($hora_id);

      return response()->json($horario);
    }

   
}
