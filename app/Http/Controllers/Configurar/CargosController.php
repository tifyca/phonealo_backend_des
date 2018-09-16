<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cargos;
use Redirect;
use Illuminate\Support\Facades\Validator;
use DB;




class CargosController extends Controller
{
    public function index(Request $request){

     $cargo = $request["buscarcargos"];
     $status   = $request["selectstatus"];
   
    if($cargo!="" && $status=="" )
    {
        $cargos= Cargos::where('cargo','LIKE', $cargo.'%')->orderBy('cargo','asc')->paginate(10);

    }
    if($cargo=="" && $status!="")
    {
        $cargos=  Cargos::where('status',$status)->paginate(10);
    }
      if($cargo!="" && $status!="")
    {
        $cargos= Cargos::where('cargo','LIKE', $cargo.'%')
                       ->where('status',$status)->orderBy('cargo','ASC')->paginate(10);
    }

    if($cargo=="" && $status=="")
    {
        $cargos= Cargos::orderBy('cargo','ASC')->paginate(10);
    }

            if($request->ajax())
            {
                  return response()->json(view('Configurar.Cargos.lista',compact('cargos'))->render());
            }
             
            return view('Configurar.Cargos.index')->with('cargos',$cargos);
            
    
  } 


  public function store(Request $request){

   $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:cargos,cargo', 
                   'status'=>'required'); 
   $messages = array( 'nombre.required'=>'Nombre del Cargo es Requerido', 
                      'nombre.unique' => 'El Cargo ya Existe', 
                      'status.required'=>'El Estatus es Requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){      
      
      $cargo= new Cargos; 
      $cargo->cargo = ucwords(strtolower($request->nombre)); 
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

    $data=$request->all();

    $rules = array( 'nombre'=>'required|unique:cargos,cargo,'.$cargo_id, 
                    'status'=>'required'); 
    $messages = array( 'nombre.required'=>'Nombre del Cargo es Requerido', 
                       'nombre.unique' => 'El Cargo ya Existe', 
                       'status.required'=>'El Estatus es Requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){      
      
        $cargo = Cargos::find($cargo_id);
        $cargo->cargo = ucwords(strtolower($request->nombre));
        $cargo->status = $request->status;
        $cargo->id_usuario=$request->id_usuario;
        $cargo->save();
        return response()->json($cargo);
     }  
        
    }
  public function destroy($cargo_id){

    try
        {

            $cargo = Cargos::destroy($cargo_id);
            return response()->json($cargo);

         }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {
           
                    return response()->json([ 'success' => false ], 400);
              } 
          }
    }


}
