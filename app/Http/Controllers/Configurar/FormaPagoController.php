<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forma_pago;
use Redirect;
use Illuminate\Support\Facades\Validator;
use DB;




class FormaPagoController extends Controller
{
    public function index(Request $request){

     $forma = $request["formas"];
     $status   = $request["status"];
   
    if($forma!="" && $status=="" )
    {
        $formas= Forma_pago::search($forma)->orderBy('forma_pago','asc')->paginate(10);

    }
    if($forma=="" && $status!="")
    {
        $formas=  Forma_pago::status($status)->paginate(10);
    }
      if($forma!="" && $status!="")
    {
        $formas= Forma_pago::ambos($forma,$status)->orderBy('forma_pago','ASC')->paginate(10);
    }

    if($forma=="" && $status=="")
    {
        $formas= Forma_pago::orderBy('forma_pago','ASC')->paginate(10);
    }

            if($request->ajax())
            {
                  return response()->json(view('Configurar.Formas.lista',compact('formas'))->render());
            }
             
            return view('Configurar.Formas.index')->with('formas',$formas);
            
    
  } 


  public function store(Request $request){

   $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:forma_pago,forma_pago', 
                   'status'=>'required'); 
   $messages = array( 'nombre.required'=>'El Nombre de la Forma de Pago es Requerida', 
                      'nombre.unique' => 'La Forma de Pago ya Existe', 
                      'status.required'=>'El Estatus es Requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){      
      
      $forma= new Forma_pago; 
      $forma->forma_pago = ucwords(strtolower($request->nombre)); 
      $forma->status =$request->status; 
      $forma->id_usuario=$request->id_usuario;
      $forma->save(); 
      return response()->json($forma);

      }  
        
    }

  public function editar($forma_id){
    $forma = Forma_pago::find($forma_id);
    return response()->json($forma);
    }

  public function update (Request $request,$forma_id){

    $data=$request->all();

    $rules = array( 'nombre'=>'required|unique:forma_pago,forma_pago,'.$forma_id, 
                    'status'=>'required'); 
    $messages = array( 'nombre.required'=>'El Nombre de la Forma de Pago es Requerida', 
                      'nombre.unique' => 'La Forma de Pago ya Existe', 
                      'status.required'=>'El Estatus es Requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){      
      
        $forma = Forma_pago::find($forma_id);
        $forma->forma_pago = ucwords(strtolower($request->nombre));
        $forma->status = $request->status;
        $forma->id_usuario=$request->id_usuario;
        $forma->save();
        return response()->json($forma);
     }  
        
    }
  public function destroy($forma_id){

    try
        {

            $forma = Forma_pago::destroy($forma_id);
            return response()->json($forma);

         }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {
           
                    return response()->json([ 'success' => false ], 400);
              } 
          }
    }


}
