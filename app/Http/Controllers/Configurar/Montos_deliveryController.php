<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\montos_delivery;
use App\SubMontos_delivery;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Validator;
@session_start();

class Montos_deliveryController extends Controller
{
    
    public function index(Request $request){
    	
          $montos    = $request["Montos"];
         
          if($montos!="")
          {
            $Montos_delivery= Montos_delivery::where('monto',$montos)->orderBy('montos','asc')->paginate(10);
          }
          if($montos=="")
          {
            $Montos_delivery=Montos_delivery::orderBy('monto','asc')->paginate(10);
          }
          
            if($request->ajax()){
                  return response()->json(view('Configurar.Montos_delivery.lista',compact('Montos_delivery'))->render());
              }
            $id_usuario=Auth::user()->id;         
            return view('Configurar.Delivery.index')->with('montos_delivery',$Montos_delivery)->with("id_usuario",$id_usuario);

    }

    public function show(Request $request){
    	dd($request);
    }

    public function store(Request $request){  
       dd($request);
       $data=$request->all();
      
       $rules = array( 'monto'=>'required|unique:Montos_delivery'); 
       $messages = array( 'monto.required'=>'Monto es requerido');

       $validator = Validator::make($data, $rules, $messages);


       if($validator->fails()){ 

          $errors = $validator->errors(); 
          return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
          
         }elseif ($validator->passes()){ 

            $monto= new Montos_delivery;
            $montos->monto    = $request->monto;
            $montos->id_usuario=$request->id_usuario;
            $montos->save();
            return response()->json($montos);
        }  
        
    }

  public function editar($montos_id){
    $montos = Montos_delivery::find($montos_id);
    return response()->json($montos);
    }

  public function update (Request $request,$montos_id){
        
        $data=$request->all();

        $rules = array( 'monto'=>'required|unique:Montos_delivery,montos,'.$montos_id); 
        $messages = array( 'monto.required'=>'Monto es requerido' );

       $validator = Validator::make($data, $rules, $messages);


       if($validator->fails()){ 

          $errors = $validator->errors(); 
          return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
          
         }elseif ($validator->passes()){ 

        $montos = Montos_delivery::find($montos_id);
        $montos->monto     = $request->monto;
        $montos->id_usuario=$request->id_usuario;
        $montos->save();
        return response()->json($montos);
     }

   }

    public function destroy($montos_id){

          try
            {

              $montos = Montos_delivery::destroy($montos_id);
              return response()->json($montos);

          }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {

                   
                    return response()->json([ 'success' => false ], 400);
        
              } 

          }


    }
   

}