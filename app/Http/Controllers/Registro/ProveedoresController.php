<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\Proveedores;

class ProveedoresController extends Controller
{
  
  public function index(Request $request){

    	$proveedor= Proveedores::join('paises', 'proveedores.id_pais', '=', 'paises.id')
        				->select( 'proveedores.id', 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono')->paginate(10);
      if($request->ajax()){
            return response()->json(view('Registro.Proveedores.lista',compact('proveedor'))->render());
        }
       
    	return view('Registro.Proveedores.index')->with('proveedor',$proveedor);
	
	}
  
  public function show(){
    return view('Registro.Proveedores.show');
  }

	public function create(Request $request){

		$data=$request->all();

    $rules = array( 'nombre_proveedor'=>'required|unique:proveedores,nombres', 
                   // 'email_proveedor'=>'required|unique:proveedores,email',
                    'direccion_proveedor'=>'required',
                    'telefono_proveedor'=>'required',
                    'ruc_proveedor' =>'required',
                    'pais_proveedor' =>'required|not_in:0'
                    );

    $messages = array( 'nombre_proveedor.required'=>'Nombre del proveedor es requerido', 
                       'nombre_proveedor.unique' => 'El proveedor ya existe', 
                     //  'email_proveedor.required'=>'El email del proveedor es requerido', 
                     //  'email_proveedor.unique' => 'El email del proveedor ya existe',
                       'telefono_proveedor.required'=>'El teléfono del proveedor es requerido', 
                       //'telefono_proveedor.unique' => 'El teléfono del proveedor ya existe',
                       'ruc_proveedor' =>'El ruc del proveedor es requerido',
                       'pais_proveedor.required'=>'El pais del proveedor es requerido',
                       'pais_proveedor.not_in'=> 'El pais del proveedor es requerido'
                      );

                      
        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 


      $errors = $validator->errors(); 
      
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 


      $proveedor= new Proveedores; 
      $proveedor->nombres   = $request->nombre_proveedor; 
      $proveedor->telefono  = $request->telefono_proveedor; 
      $proveedor->direccion = $request->direccion_proveedor;
      $proveedor->email     = $request->email_proveedor; 
      $proveedor->id_pais   = $request->pais_proveedor; 
      $proveedor->ruc       = $request->ruc_proveedor;
      $proveedor->id_estado = $request->id_estado;
      $proveedor->id_usuario= $request->id_usuario;
      $proveedor->save(); 

       $trues="El proveedor fue Creado Exitosamente!!";
      return response()->json([ 'success' => true, 'message' => json_decode($trues) ], 200);

      }  
		
	}



    public function editar($id_proveedor){
        $proveedor = Proveedores::where('proveedores.id','=', $id_proveedor)
                      ->join('paises', 'proveedores.id_pais', '=', 'paises.id')
                      ->select('proveedores.id','nombres', 'proveedores.id_pais', 'paises.nombre as pais', 'telefono', 'direccion', 'ruc', 'email','id_estado', 'proveedores.id_usuario')->first();

        return view('Registro.Proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request,$proveedor_id){
 

    $data=$request->all();

    $rules = array( 'nombre_proveedor'=>'required|unique:proveedores,nombres,' .$proveedor_id,  
                    'email_proveedor'=>'required ',          //|unique:proveedors,email,' .$proveedor_id,
                    'telefono_proveedor'=>'required',        ///|unique:proveedors,telefono,' .$proveedor_id,
                    'direccion_proveedor'=>'required',
                	'ruc_proveedor' =>'required',
                    'pais_proveedor' =>'required|not_in:0');

    $messages = array( 'nombre_proveedor.required'=>'Nombre del proveedor es requerido', 
                       'nombre_proveedor.unique' => 'El proveedor ya existe', 
                       'email_proveedor.required'=>'El email del proveedor es requerido', 
                      // 'email_proveedor.unique' => 'El email del proveedor ya existe',
                       'telefono_proveedor.required'=>'El teléfono del proveedor es requerido', 
                     //  'telefono_proveedor.unique' => 'El teléfono del proveedor ya existe',
                       'ruc_proveedor' =>'El ruc del proveedor es requerido',
                       'pais_proveedor.required'=>'El pais del proveedor es requerido',
                       'pais_proveedor.not_in'=> 'El pais del proveedor es requerido'
                       );

        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 


      $errors = $validator->errors(); 
      
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 


      $proveedor = Proveedores::find($proveedor_id);
      $proveedor->nombres   = $request->nombre_proveedor; 
      $proveedor->telefono  = $request->telefono_proveedor; 
      $proveedor->direccion = $request->direccion_proveedor;
      $proveedor->email     = $request->email_proveedor; 
      $proveedor->id_pais   = $request->pais_proveedor; 
      $proveedor->ruc       = $request->ruc_proveedor;
      $proveedor->id_estado = $request->id_estado;
      $proveedor->id_usuario= $request->id_usuario;
      $proveedor->save(); 
      

      $trues="El proveedor fue Modificado Exitosamente!!";
     return response()->json([ 'success' => true, 'message' => json_decode($trues) ], 200);

      }  
        
    }


}
