<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\montos_delivery;
use App\SubMontos_delivery;
use Redirect;
use Illuminate\Support\Facades\Validator;
@session_start();

class Montos_deliveryController extends Controller
{
    
    public function index(Request $request){
    	
          $categoria = $request["Montos_delivery"];
          $status    = $request["status"];
          $tipo      = $request["tipo"];
          $proveedor = $request["proveedor"];

         
          if($categoria!="" && $status=="" && $tipo=="" && $proveedor=="")
          {
              $Montos_delivery= Montos_delivery::search($categoria)->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status!="" && $tipo=="" && $proveedor=="")
          {
               $Montos_delivery=Montos_delivery::status($status)->orderBy('categoria','asc')->paginate(10);

          }
          if($categoria=="" && $status=="" && $tipo!="" && $proveedor=="")
          {
               $Montos_delivery=Montos_delivery::tipo($tipo)->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status=="" && $tipo=="" && $proveedor!="")
          {
               $Montos_delivery=Montos_delivery::proveedor($proveedor)->orderBy('categoria','asc')->paginate(10);
          }

          if($categoria!="" && $status!="" && $tipo!="" && $proveedor!="")
          {
               $Montos_delivery=Montos_delivery::search2($tipo, $status, $proveedor, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status!="" && $tipo=="" && $proveedor=="")
          {
               $Montos_delivery=Montos_delivery::search3($status, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status=="" && $tipo!="" && $proveedor=="")
          {
               $Montos_delivery=Montos_delivery::search4($tipo, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status=="" && $tipo=="" && $proveedor=="")
          {
               $Montos_delivery=  Montos_delivery::orderBy('categoria','ASC')->paginate(10);
          }
          if($categoria=="" && $status!="" && $tipo!="" && $proveedor=="")
          {
               $Montos_delivery=Montos_delivery::search5($tipo,$status)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status=="" && $tipo=="" && $proveedor!="")
          {
               $Montos_delivery=Montos_delivery::search6($proveedor, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status!="" && $tipo!="" && $proveedor=="")
          {
               $Montos_delivery=Montos_delivery::search7($tipo, $status, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status!="" && $tipo=="" && $proveedor!="")
          {
               $Montos_delivery=Montos_delivery::search8($status, $proveedor)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status=="" && $tipo!="" && $proveedor!="")
          {
               $Montos_delivery=Montos_delivery::search9( $tipo, $proveedor, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status!="" && $tipo=="" && $proveedor!="")
          {
               $Montos_delivery=Montos_delivery::search10($status, $proveedor, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status=="" && $tipo!="" && $proveedor!="")
          {
               $Montos_delivery=Montos_delivery::search11($tipo, $proveedor)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status!="" && $tipo!="" && $proveedor!="")
          {
               $Montos_delivery=Montos_delivery::search12($tipo, $status, $proveedor)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          
            if($request->ajax()){
                  return response()->json(view('Configurar.Montos_delivery.lista',compact('Montos_delivery'))->render());
              }
          
            return view('Configurar.Montos_delivery.index')->with('Montos_delivery',$Montos_delivery);

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
            $categoria->categoria= ucwords(strtolower($request->nombre));
            $categoria->tipo     = $request->tipo;
            $categoria->status   = $request->status;
            $categoria->id_usuario=$request->id_usuario;
            $categoria->proveedor =$request->proveedor;
            $categoria->save();
            return response()->json($categoria);
        }  
        
    }

  public function editar($categoria_id){
    $categoria = Montos_delivery::find($categoria_id);
    return response()->json($categoria);
    }

  public function update (Request $request,$categoria_id){
        
        $data=$request->all();

        $rules = array( 'nombre'=>'required|unique:Montos_delivery,categoria,'.$categoria_id, 
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

        $categoria = Montos_delivery::find($categoria_id);
        $categoria->categoria = ucwords(strtolower($request->nombre));
        $categoria->tipo     = $request->tipo;
        $categoria->status = $request->status;
        $categoria->id_usuario=$request->id_usuario;
        $categoria->proveedor =$request->proveedor;
        $categoria->save();
        return response()->json($categoria);
     }

   }

    public function destroy($categoria_id){

          try
            {

              $categoria = Montos_delivery::destroy($categoria_id);
              return response()->json($categoria);

          }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {

                   
                    return response()->json([ 'success' => false ], 400);
        
              } 

          }


    }
   

}