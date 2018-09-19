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
    $zproveedor = $request["proveedor"];
    $email   = $request["email"];
    $estatus = $request["status"];
    if($zproveedor!="" && $email=="" && $estatus=="")
    {
     
    	$proveedor= Proveedores::search($zproveedor)->orderby('proveedor','asc')->paginate(10);
    }
    if($zproveedor=="" && $email!="" && $estatus=="")
    {
   
      $proveedor= Proveedores::email($email)->orderby('proveedor','asc')->paginate(10);
    }
   if($zproveedor=="" && $email=="" && $estatus!="")
    {
    
      $proveedor= Proveedores::status($estatus)->orderby('proveedor','asc')->paginate(10);
    }
   if($zproveedor!="" && $email=="" && $estatus!="")
    {
      
       
      $proveedor= Proveedores::search2($zproveedor, $estatus)->orderby('proveedor','asc')->paginate(10);
    }
      if($zproveedor!="" && $email!="" && $estatus=="")
    {
   
      $proveedor= Proveedores::search3($zproveedor, $email)->orderby('proveedor','asc')->paginate(10);
    }
 

   if($zproveedor!="" && $email!="" && $estatus!="")
    {
   
      $proveedor= Proveedores::search4($zproveedor, $email, $estatus)->orderby('proveedor','asc')->paginate(10);
    }

   if($zproveedor=="" && $email!="" && $estatus!="")
    {
     
      $proveedor= Proveedores::search5($email, $estatus)->orderby('proveedor','asc')->paginate(10);
    }
   if($zproveedor=="" && $email=="" && $estatus=="")
    {

      $proveedor= Proveedores::join('paises', 'proveedores.id_pais', '=', 'paises.id')
                ->select( 'proveedores.id', 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono', 'proveedores.id_estado')
                ->orderby('proveedor','asc')->paginate(10);
    }


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
                    'email_proveedor'=>'required|email|unique:proveedores,email',
                    'direccion_proveedor'=>'required',
                    'telefono_proveedor'=>'required',
                    'ruc_proveedor' =>'required',
                    'pais_proveedor' =>'required|not_in:0'
                    );

    $messages = array( 'nombre_proveedor.required'=>'Nombre del Proveedor es Requerido', 
                       'nombre_proveedor.unique' => 'El Proveedor ya Existe', 
                       'email_proveedor.required'=>'El Email del Proveedor es Requerido', 
                       'email_proveedor.unique' => 'El Email del Proveedor ya Existe',
                       'email_proveedor.email' => 'El Formato de Email es Incorrecto',
                       'telefono_proveedor.required'=>'El Teléfono del Proveedor es Requerido', 
                       'direccion_proveedor.required'=>'El Dirección del Proveedor es Requerido', 
                       //'telefono_proveedor.unique' => 'El teléfono del proveedor ya existe',
                       'ruc_proveedor' =>'El Ruc del Proveedor es Requerido',
                       'pais_proveedor.required'=>'El Pais del Proveedor es Requerido',
                       'pais_proveedor.not_in'=> 'El Pais del Proveedor es Requerido'
                       );

                      
        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 


      $errors = $validator->errors(); 
      
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 


      $proveedor= new Proveedores; 
      $proveedor->nombres   = ucwords(strtolower($request->nombre_proveedor)); 
      $proveedor->telefono  = $request->telefono_proveedor; 
      $proveedor->direccion = $request->direccion_proveedor;
      $proveedor->email     = ucwords(strtolower($request->email_proveedor)); 
      $proveedor->id_pais   = $request->pais_proveedor; 
      $proveedor->ruc       = $request->ruc_proveedor;
      $proveedor->id_estado = $request->id_estado;
      $proveedor->id_usuario= $request->id_usuario;
      $proveedor->save(); 

         $jsonres['message']="El Proveedor fue  Registrado con Éxito";
         echo json_encode($jsonres);

      }  
		
	}



    public function editar($id_proveedor){
        $proveedor = Proveedores::where('proveedores.id','=', $id_proveedor)
                      ->join('paises', 'proveedores.id_pais', '=', 'paises.id')
                      ->select('proveedores.id','nombres', 'proveedores.id_pais', 'paises.nombre as pais', 'telefono', 'direccion', 'ruc', 'email','proveedores.id_estado', 'proveedores.id_usuario')->first();

        return view('Registro.Proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request,$proveedor_id){
 

    $data=$request->all();

    $rules = array( 'nombre_proveedor'=>'required|unique:proveedores,nombres,' .$proveedor_id,  
                    'email_proveedor'=>'required|email|unique:proveedores,email,' .$proveedor_id,
                    'telefono_proveedor'=>'required',        ///|unique:proveedors,telefono,' .$proveedor_id,
                    'direccion_proveedor'=>'required',
                	'ruc_proveedor' =>'required',
                    'pais_proveedor' =>'required|not_in:0');

    $messages = array( 'nombre_proveedor.required'=>'Nombre del Proveedor es Requerido', 
                       'nombre_proveedor.unique' => 'El Proveedor ya Existe', 
                       'email_proveedor.required'=>'El Email del Proveedor es Requerido', 
                       'email_proveedor.unique' => 'El Email del Proveedor ya Existe',
                       'email_proveedor.email' => 'El Formato de Email es Incorrecto',
                       'direccion_proveedor.required'=>'El Dirección del Proveedor es Requerido', 
                       'telefono_proveedor.required'=>'El Teléfono del Proveedor es Requerido', 
                     //  'telefono_proveedor.unique' => 'El teléfono del proveedor ya existe',
                       'ruc_proveedor' =>'El Ruc del Proveedor es Requerido',
                       'pais_proveedor.required'=>'El Pais del Proveedor es Requerido',
                       'pais_proveedor.not_in'=> 'El Pais del Proveedor es Requerido'
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
      

     $jsonres['message']="El Proveedor fue  Modificado con Éxito";
    echo json_encode($jsonres);

      }  
        
    }


}
