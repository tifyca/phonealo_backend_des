<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Clientes;
use Mapper;


class ClientesController extends Controller
{
	public function index(Request $request){
    $cliente = $request["cliente"];
    $email   = $request["email"];
    $estatus = $request["status"];
   
    if($cliente!="" && $email=="" && $estatus=="" )
    {
      
      $clientes= Clientes::search($cliente)->orderby('nombres','asc')->paginate(10);

    }
    if($cliente=="" && $email!="" && $estatus=="")
    {
        
         $clientes= Clientes::email($email)->orderby('nombres','asc')->paginate(10);
    }
    if($cliente=="" && $email=="" && $estatus!="")
    {
        
         $clientes= Clientes::status($estatus)->orderby('nombres','asc')->paginate(10);
    }
    if($cliente!="" && $email!="" && $estatus!="")
    {
        
         $clientes= Clientes::search2($cliente,$email, $estatus )->orderby('nombres','asc')->paginate(10);
    }
    
    if($cliente=="" && $email=="" && $estatus=="")
    {
         $clientes= Clientes::join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                ->select('clientes.id', 'nombres','telefono','direccion', 'barrio', 'email','clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion', 'clientes.id_estado')->orderby('nombres','asc')->paginate(10);
    }
     if($cliente!="" && $email=="" && $estatus!="")
    {
        
         $clientes= Clientes::search3($cliente,$estatus )->orderby('nombres','asc')->paginate(10);
    }
     if($cliente=="" && $email!="" && $estatus!="")
    {
        
         $clientes= Clientes::search4($email, $estatus )->orderby('nombres','asc')->paginate(10);
    }
    if($cliente!="" && $email!="" && $estatus=="")
    {
        
         $clientes= Clientes::search5($cliente,$email )->orderby('nombres','asc')->paginate(10);
    }

    if($request->ajax())
    {
       return response()->json(view('Registro.Clientes.lista',compact('clientes'))->render());
    }
       
    	return view('Registro.Clientes.index')->with('clientes',$clientes);
	
	}
	
	public function show(){
		return view('Registro.Clientes.show');
	}

  public function create_cliente(Request $request){

    $data=$request->all();

    $rules = array( 'nombre_cliente'=>'required|unique:clientes,nombres', 
                    'email_cliente'=>'required|email|unique:clientes,email',
                    'telefono_cliente'=>'required|unique:clientes,telefono',
                    'departamento_cliente'=>'required|not_in:0',
                    'ciudad_cliente'=>'required|not_in:0',
                    'barrio_cliente'=>'required|not_in:0',
                    'direccion_cliente'=>'required');

    $messages = array( 'nombre_cliente.required'=>'Nombre del Cliente es Requerido', 
                       'nombre_cliente.unique' => 'El Cliente ya Existe', 
                       'email_cliente.required'=>'El Email del Cliente es Requerido', 
                       'email_cliente.unique' => 'El Email del Cliente ya Existe',
                       'email_cliente.email' => 'El Formato de Email es Incorrecto',
                       'telefono_cliente.required'=>'El Teléfono del Cliente es Requerido', 
                       'telefono_cliente.unique' => 'El Teléfono del Cliente ya Existe',
                       'departamento_cliente.required'=>'El Departamento del Cliente es Requerido',
                       'departamento_cliente.not_in'=> 'El Departamento del Cliente es Requerido',
                       'ciudad_cliente.required'=> 'La Ciudad del Cliente es Requerida',
                       'ciudad_cliente.not_in'=> 'La Ciudad del Cliente es Requerida',
                       'barrio_cliente.required'=> 'El Barrio del Cliente es Requerido',
                       'barrio_cliente.not_in'=> 'El Barrio del Cliente es Requerido',
                       'direccion_cliente.required'=>'La Dirección del Cliente es Requerida',
                       'direccion_cliente.not_in'=>'La Dirección del Cliente es Requerida');

        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 


      $errors = $validator->errors(); 
      
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 


      $cliente= new Clientes; 
      $cliente->nombres   = ucwords(strtolower($request->nombre_cliente)); 
      $cliente->telefono  = $request->telefono_cliente; 
      $cliente->direccion = $request->direccion_cliente;
      $cliente->barrio    = $request->barrio_cliente;
      $cliente->id_ciudad = $request->ciudad_cliente;
      $cliente->id_departamento=$request->departamento_cliente;
      $cliente->ruc_ci    = $request->ruc_cliente;
      $cliente->email     = ucwords(strtolower($request->email_cliente));
      $cliente->ubicacion = $request->ubicacion_cliente;
      $cliente->id_tipo   = $request->tipo_cliente;
      $cliente->notas     = $request->nota_cliente;
      $cliente->id_estado= $request->id_estado;
      $cliente->id_usuario= $request->id_usuario;
      $cliente->save(); 


        $jsonres['message']="El Cliente fue  Registrado con Éxito";
         echo json_encode($jsonres);

      }  
        
    }

  public function editar($id_cliente){
    $cliente = Clientes::where('clientes.id','=',$id_cliente)
                      ->join('departamentos', 'clientes.id_departamento', '=', 'departamentos.id')
                      ->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id' )
                      ->select('clientes.id','nombres', 'departamentos.nombre as departamento', 'ciudades.ciudad as ciudad','telefono', 'direccion', 'barrio', 'clientes.id_ciudad as id_ciudad', 'clientes.id_departamento as id_departamento', 'ruc_ci', 'email', 'ubicacion', 'id_tipo', 'notas', 'id_estado', 'clientes.id_usuario')->first();

        return view('Registro.Clientes.edit', compact('cliente'));
    }



	public function update(Request $request,$cliente_id){
 

    $data=$request->all();

    $rules = array( 'nombre_cliente'=>'required|unique:clientes,nombres,' .$cliente_id,  
                    'email_cliente'=>'required|email|unique:clientes,email,' .$cliente_id,
                    'telefono_cliente'=>'required|unique:clientes,telefono,' .$cliente_id,
                    'departamento_cliente'=>'required|not_in:0',
                    'ciudad_cliente'=>'required|not_in:0',
                    'barrio_cliente'=>'required|not_in:0',
                    'direccion_cliente'=>'required');

    
    $messages = array( 'nombre_cliente.required'=>'Nombre del Cliente es Requerido', 
                       'nombre_cliente.unique' => 'El Cliente ya Existe', 
                       'email_cliente.required'=>'El Email del Cliente es Requerido', 
                       'email_cliente.unique' => 'El Email del Cliente ya Existe',
                       'email_cliente.email' => 'El Formato de Email es Incorrecto',
                       'telefono_cliente.required'=>'El Teléfono del Cliente es Requerido', 
                       'telefono_cliente.unique' => 'El Teléfono del Cliente ya Existe',
                       'departamento_cliente.required'=>'El Departamento del Cliente es Requerido',
                       'departamento_cliente.not_in'=> 'El Departamento del Cliente es Requerido',
                       'ciudad_cliente.required'=> 'La Ciudad del Cliente es Requerida',
                       'ciudad_cliente.not_in'=> 'La Ciudad del Cliente es Requerida',
                       'barrio_cliente.required'=> 'El Barrio del Cliente es Requerido',
                       'barrio_cliente.not_in'=> 'El Barrio del Cliente es Requerido',
                       'direccion_cliente.required'=>'La Dirección del Cliente es Requerida',
                       'direccion_cliente.not_in'=>'La Dirección del Cliente es Requerida');

        $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 


      $errors = $validator->errors(); 
      
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 


      $cliente = Clientes::find($cliente_id);
      $cliente->nombres   = ucwords(strtolower($request->nombre_cliente)); 
      $cliente->telefono  = $request->telefono_cliente; 
      $cliente->direccion = $request->direccion_cliente;
      $cliente->barrio    = $request->barrio_cliente;
      $cliente->id_ciudad = $request->ciudad_cliente;
      $cliente->id_departamento=$request->departamento_cliente;
      $cliente->ruc_ci    = $request->ruc_cliente;
      $cliente->email     = ucwords(strtolower($request->email_cliente));
      $cliente->ubicacion = $request->ubicacion_cliente;
      $cliente->id_tipo   = $request->tipo_cliente;
      $cliente->notas     = $request->nota_cliente;
      $cliente->id_estado= $request->id_estado;
      $cliente->id_usuario= $request->id_usuario;
      $cliente->save(); 

	       $jsonres['message']="El Cliente fue  Modificado con Éxito";
         echo json_encode($jsonres);


      }  
        
    }


  public function gmaps($ubicacion)
  {

$data = explode(",", $ubicacion);      

   
        $lat=$data[0];
        $lon=$data[1];

        Mapper::map($lat,$lon, [
                   "zoom"           => 16,
                   "draggable"               =>  true,
                   "marker"            => true,
                   "eventAfterLoad"      => 'circleListener(maps[0].shapes[0].circle_0);'
                 ]

);



    

        return view('Registro.Clientes.gmaps');
  }
}
