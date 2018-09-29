<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\montos_delivery;

use Redirect;
use Illuminate\Support\Facades\Validator;
@session_start();

class Montos_deliveryController extends Controller
{
    
    public function index(Request $request){
    	
          $categoria = $request["Montos_delivery"];

         
          if($categoria!="")
          {
              $Montos_delivery= Montos_delivery::where('monto',$categoria)->orderBy('id','asc')->paginate(10);
          }
          if($categoria=="")
          {
               $Montos_delivery=Montos_delivery::orderBy('id','asc')->paginate(10);

          }
          
            if($request->ajax()){
                  return response()->json(view('Configurar.Delivery.lista',compact('Montos_delivery'))->render());
              }
          
            return view('Configurar.Delivery.index')->with('montos_delivery',$Montos_delivery);

    }

 

    public function store(Request $request){  

       $data=$request->all();

       $rules = array( 'nombre'=>'required|unique:Montos_delivery,categoria', 
                       'tipo'=>'required',
                       'status'=>'required'); 
       $messages = array( 'nombre.required'=>'Nombre de la Categoría es requerido',
                          'tipo.required'=>'El tipo de la Categoría es requerido', 
                          'nombre.unique' => 'La Categoría ya existe', 
                          'status.required'=>'El estatus es requerido' );

       $validator = Validator::make($data, $rules, $messages);


       if($validator->fails()){ 

          $errors = $validator->errors(); 
          return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
          
         }elseif ($validator->passes()){ 

            $categoria= new Montos_delivery;
            $categoria->monto = $request->monto;
            $categoria->save();
            return response()->json($categoria);
        }  
        
    }

  public function editar($monto_id){
    $categoria = Montos_delivery::find($monto_id);
    return response()->json($categoria);
    }

  public function update (Request $request,$monto_id){
        
        $data=$request->all();

        $rules = array( 'montos'=>'required|unique:Montos_delivery,categoria,'.$monto_id); 
        $messages = array( 'montos.required'=>'Monto es requerido');

       $validator = Validator::make($data, $rules, $messages);


       if($validator->fails()){ 

          $errors = $validator->errors(); 
          return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
          
         }elseif ($validator->passes()){ 

        $montosd = Montos_delivery::find($monto_id);
        $montosd->monto     = $request->monto;
        $montosd->save();
        return response()->json($montosd);
     }

   }

    public function destroy($monto_id){

          try
            {

              $montosd = Montos_delivery::destroy($monto_id);
              return response()->json($montosd);

          }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {

                   
                    return response()->json([ 'success' => false ], 400);
        
              } 

          }


    }
   

}