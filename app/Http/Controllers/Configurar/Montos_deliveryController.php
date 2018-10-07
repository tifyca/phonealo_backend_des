<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Montos_delivery;
use Auth;
use Redirect;
use App\Detalles_Ventas;
use Illuminate\Support\Facades\Validator;
@session_start();

class Montos_deliveryController extends Controller
{
    
    public function index(Request $request){

          $tipo="";
          $mensaje="";
    	    $montos    = $request["buscarmonto"];
          
         
          if($montos!="")
          {
            $Montos_delivery= Montos_delivery::where('monto',$montos)->orderBy('monto','asc')->paginate(10);
          }
          if($montos=="")
          {
            $Montos_delivery=Montos_delivery::orderBy('monto','asc')->paginate(10);
          }
          
            if($request->ajax()){
                  return response()->json(view('Configurar.Montos_delivery.lista',compact('Montos_delivery'))->render());
              }
            $id_usuario=Auth::user()->id;         
            return view('Configurar.Delivery.index')->with('montos_delivery',$Montos_delivery)->with("id_usuario",$id_usuario)->with("tipo",$tipo)->with("mensaje",$mensaje);

    }

    public function create(Request $request){


    }

    public function store(Request $request){  
       
       
       $monto      = $request->monto_delivery;
       $id_usuario = $request->id_usuario;
       
      if(empty($monto)){
            $mensaje = "No se pueden Registrar Montos vacios";
            $tipo    = 2;
      }
      else{

          $montos_delivery=Montos_delivery::where('monto',$monto)->first();
          
          if($montos_delivery){
            $mensaje = "Monto Ya Registrado";
            $tipo    = 2;

          }
          else{
             $montos_delivery= new Montos_delivery;
             $montos_delivery->monto = $monto;
             $montos_delivery->id_usuario = $id_usuario;
             $montos_delivery->created_at = date('Y-m-d');
             $montos_delivery->updated_at = date('Y-m-d');
             $montos_delivery->save();
              $mensaje = "Monto Registrado con Éxito";
            $tipo    = 1;
                    
          }  
      }
      $Montos_delivery=Montos_delivery::orderBy('monto','asc')->paginate(10);       
      $id_usuario=Auth::user()->id;         
      return view('Configurar.Delivery.index')->with('montos_delivery',$Montos_delivery)->with("id_usuario",$id_usuario)->with("tipo",$tipo)->with("mensaje",$mensaje);
    
    }

  public function editar($montos_id)
  {
    $montos = Montos_delivery::find($montos_id);
    return response()->json($montos);
   }

public function show(Request $request)
{
 try
      {
       //$id = $request->id;
   
   $id = $request->id;
   $montos = Montos_delivery::find($id);

   $montos->destroy($id);
   $Montos_delivery=Montos_delivery::orderBy('monto','asc')->paginate(10);       
   $id_usuario=Auth::user()->id;         
   $mensaje="Se ha Eliminado correctamente";
   $tipo="2";

       return response()->json($Montos_delivery);
     }catch(\Illuminate\Database\QueryException $e)
     {

      if($e->getCode() === '23000') {

        return response()->json([ 'success' => false ], 400);
        
      } 
    }


}
public function anular(Request $request)
{

 //dd($id);
 try
      {
       //$id = $request->id;

   $montos = Montos_delivery::find($id);

   $montos->destroy($id);
   $Montos_delivery=Montos_delivery::orderBy('monto','asc')->paginate(10);       
   $id_usuario=Auth::user()->id;         
   $mensaje="Se ha Eliminado correctamente";
   $tipo="2";

       return response()->json($Montos_delivery);
     }catch(\Illuminate\Database\QueryException $e)
     {

      if($e->getCode() === '23000') {

        return response()->json([ 'success' => false ], 400);
        
      } 
    }



}
 

   

   

}