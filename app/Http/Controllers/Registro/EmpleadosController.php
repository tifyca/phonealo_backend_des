<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Empleados;

class EmpleadosController extends Controller
{
     public function index(Request $request){

    $empleado = $request["empleado"];
    $email   = $request["email"];
    $estatus = $request["estatus"];
    if($empleado!="" && $email=="" && $estatus=="")
    {
      $empleado = $empleado."%"; 
      $empleados= Empleados::where('nombres','like',$empleado)->orderby('nombres','asc')->paginate(10);
    }
    if($empleado=="" && $email!="" && $estatus=="")
    {
         $email = $email."%";
         $empleados= Empleados::where('email','like',$email)->orderby('nombres','asc')->paginate(10);
     }
    if($empleado=="" && $email=="" && $estatus!="")
    {
         $email = $email."%";
         $empleados= empleados::where('id_estado',$estatus)->orderby('nombres','asc')->paginate(10);
    }

    if($empleado=="" && $email=="" && $estatus=="")
    {
         $empleados= Empleados::orderby('nombres','asc')->paginate(10);
    }

       if($request->ajax()){
            return response()->json(view('Registro.Empleados.lista',compact('empleados'))->render());
        }
       
    	return view('Registro.Empleados.index')->with('empleados',$empleados);
	
	}
    	
    
    public function show(){
    	return view('Registro.Empleados.show');
    }
   
   public function create(Request $request){

		$data=$request->all();

    $rules = array( 'nombre_empleado'=>'required|unique:empleados,nombres', 
                    'email_empleado'=>'required|unique:empleados,email',
                    'direccion_empleado'=>'required',
                    'telefono_empleado'=>'required',
                    'ci_empleado' =>'required|unique:empleados,ci',
                    
                    );

    $messages = array( 'nombre_empleado.required'=>'Nombre del Empleado es Requerido', 
                       'nombre_empleado.unique' => 'El Empleado ya Existe', 
                      'email_empleado.required'=>'El Email del Empleado es Requerido', 
                      'email_empleado.unique' => 'El Email del Empleado ya Existe',
                       'telefono_empleado.required'=>'El Teléfono del Empleado es Requerido', 
                       //'telefono_empleado.unique' => 'El teléfono del empleado ya existe',
                       'ci_empleadoci_empleado.required' =>'El CI del Empleado es Requerido',
                       'ci_empleadoci_empleado.unique' =>'El CI del Empleado ya Existe',
                      );

                      
        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 


      $errors = $validator->errors(); 
      
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 


      $empleado= new Empleados; 
      $empleado->nombres   = $request->nombre_empleado; 
      $empleado->telefono  = $request->telefono_empleado; 
      $empleado->direccion = $request->direccion_empleado;
      $empleado->email     = $request->email_empleado; 
      $empleado->id_cargo  = $request->cargo_empleado;
      $empleado->ci        = $request->ci_empleado;
      $empleado->id_estado = $request->id_estado;
      $empleado->id_usuario= $request->id_usuario;
      $empleado->save(); 

       $trues="El empleado fue Creado Exitosamente!!";
      return response()->json([ 'success' => true, 'message' => json_decode($trues) ], 200);

      }  
		
	}



    public function editar($id_empleado){
        $empleado = Empleados::where('empleados.id','=', $id_empleado)
                      ->join('cargos', 'empleados.id_cargo', '=', 'cargos.id')
                      ->select( 'empleados.id', 'id_cargo', 'nombres', 'cargos.cargo', 'usuario','telefono', 'direccion', 'ci', 'email', 'empleados.id_estado', 'empleados.id_usuario')->first();
        return view('Registro.Empleados.edit', compact('empleado'));
    }

    public function update(Request $request,$empleado_id){
 

    $data=$request->all();

    $rules = array( 'nombre_empleado'=>'required|unique:empleados,nombres,' .$empleado_id,  
                    'email_empleado'=>'required|unique:empleados,email,' .$empleado_id,
                    'telefono_empleado'=>'required',        ///|unique:empleados,telefono,' .$empleado_id,
                    'direccion_empleado'=>'required',
                	  'ci_empleado' =>'required|unique:empleados,ci,' .$empleado_id,
                   );

    $messages = array( 'nombre_empleado.required'=>'Nombre del Empleado es Requerido', 
                       'nombre_empleado.unique' => 'El Empleado ya Existe', 
                      'email_empleado.required'=>'El Email del Empleado es Requerido', 
                      'email_empleado.unique' => 'El Email del Empleado ya Existe',
                       'telefono_empleado.required'=>'El Teléfono del Empleado es Requerido', 
                       //'telefono_empleado.unique' => 'El teléfono del empleado ya existe',
                       'ci_empleado.required' =>'El CI del Empleado es Requerido',
                       'ci_empleado.unique' =>'El CI del Empleado ya Existe',
                       );

        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 


      $errors = $validator->errors(); 
      
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 


      $empleado = Empleados::find($empleado_id);
      $empleado->nombres   = $request->nombre_empleado; 
      $empleado->telefono  = $request->telefono_empleado; 
      $empleado->direccion = $request->direccion_empleado;
      $empleado->email     = $request->email_empleado; 
      $empleado->id_cargo  = $request->cargo_empleado;
      $empleado->ci        = $request->ci_empleado;
      $empleado->id_estado = $request->id_estado;
      $empleado->id_usuario= $request->id_usuario;
      $empleado->save(); 
     
	$trues="El Empleado fue Modificado Exitosamente!!";
     return response()->json([ 'success' => true, 'message' => json_decode($trues) ], 200);

      }  
        
    }

     public function destroy($id_empleado){
      $empleado = Empleados::destroy($id_empleado);
      return response()->json($empleado);
    }



}
