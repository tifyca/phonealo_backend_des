<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Redirect;
use App\Paises;
use App\Departamentos;
use App\Ciudades;
use App\Barrios;

class DireccionesController extends Controller
{
    public function paises(){
    	$paises = Paises::paginate(6);
    	return view('Configurar.Direcciones.paises')->with('paises', $paises);
    }
   
    public function store_paises(Request $request){

    $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:paises,nombre'); 
   $messages = array( 'nombre.required'=>'Nombre del pais es requerido', 
                      'nombre.unique' => 'El pais ya existe');

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
      $pais= new Paises; 
      $pais->nombre = $request->nombre; 
      $pais->id_usuario=$request->id_usuario;
      $pais->save(); 
      return response()->json($pais);

      }  
        
    }

  public function editar_paises($pais_id){
    $pais = Paises::find($pais_id);
    return response()->json($pais);
    }

  public function update_paises (Request $request,$pais_id){
        $pais = Paises::find($pais_id);
        $pais->nombre = $request->nombre;
        $pais->id_usuario=$request->id_usuario;
        $pais->save();
        return response()->json($pais);
    }

  public function destroy_paises($pais_id){
      $pais = Paises::destroy($pais_id);
      return response()->json($pais);
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function departamentos(){
    	$departamentos = Departamentos::paginate(6);
    	return view('Configurar.Direcciones.departamentos')->with('departamentos', $departamentos);
    }

    public function store_departamentos(Request $request){

    $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:departamentos,nombre',
                    'dpto'=>'required|not_in:0'); 
   $messages = array( 'nombre.required'=>'Nombre del departamento es requerido', 
                      'nombre.unique' => 'El departamento ya existe',
                      'dpto.required'=>'El departamento es requerido');

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
      $dpto= new Departamentos; 
      $dpto->nombre = $request->nombre; 
      $dpto->id_usuario=$request->id_usuario;
      $dpto->save(); 
      return response()->json($dpto);

      }  
        
    }

  public function editar_departamentos($dpto_id){
    $dpto = Departamentos::find($dpto_id);
    return response()->json($dpto);
    }

  public function update_departamentos (Request $request,$dpto_id){
        $dpto = Departamentos::find($dpto_id);
        $dpto->nombre = $request->nombre;
        $dpto->id_usuario=$request->id_usuario;
        $dpto->save();
        return response()->json($dpto);
    }

  public function destroy_departamentos($dpto_id){

    try
            {

               $dpto = Departamentos::destroy($dpto_id);
                return response()->json($dpto);
              
          }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {

                   
                    return response()->json([ 'success' => false ], 400);
        
              } 

          }
     
    }



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function ciudades(){

    	return view('Configurar.Direcciones.ciudades');
    }

    public function store_ciudades(Request $request){

    $data=$request->all();

    $rules = array( 'nombre'=>'required|unique:ciudades,ciudad',
                    'id_dpto'=>'required|not_in:0'); 
    $messages = array( 'nombre.required'=>'Nombre de la ciudad es requerido', 
                       'nombre.unique' => 'La ciudad ya existe',
                       'id_dpto.required'=>'El departamento es requerido',
                       'id_dpto.not_in'=>'El departamento es requerido');
    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
      $ciudad= new Ciudades; 
      $ciudad->ciudad = $request->nombre; 
      $ciudad->id_departamento = $request->id_dpto; 
      $ciudad->id_usuario=$request->id_usuario;
      $ciudad->save(); 
      return response()->json($ciudad);

      }  
        
    }

  public function editar_ciudades($ciudad_id){
    $ciudad = Ciudades::find($ciudad_id);
    return response()->json($ciudad);
    }

  public function update_ciudades (Request $request,$ciudad_id){

       try
            {

                $ciudad = Ciudades::find($ciudad_id);
                $ciudad->ciudad = $request->nombre;
                $ciudad->id_departamento = $request->id_dpto; 
                $ciudad->id_usuario=$request->id_usuario;
                $ciudad->save();
                return response()->json($ciudad);
              
          }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {

                   
                    return response()->json([ 'success' => false ], 400);
        
              } 

          }
        
    }

  public function destroy_ciudades($ciudad_id){

    try
            {

               $ciudad = Ciudades::destroy($ciudad_id);
               return response()->json($ciudad);
              
          }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {

                   
                    return response()->json([ 'success' => false ], 400);
        
              } 

          }
      
    }

     public function tablaCiudades($id_departamento ){
    
      $ciudades = Ciudades::where('id_departamento',$id_departamento)->get();
     
      return response()->json($ciudades);
 
   
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function barrios(){
    	return view('Configurar.Direcciones.barrios');
    }

    public function store_barrios(Request $request){

    $data=$request->all();

    $rules = array( 'nombre'=>'required|unique:barrios,barrio',
                    'id_dpto'=>'required|not_in:0', 
                    'id_ciudad'=>'required|not_in:0',
                    'lat'=>'required',
                    'lon'=>'required'); 
    $messages = array( 'nombre.required'=>'Nombre del barrio es requerido', 
                       'nombre.unique' => 'El barrio ya existe',
                       'id_dpto.required'=>'El barrio es requerido',
                       'id_ciudad.required'=>'La ciudad es requerida',
                       'id_dpto.not_in'=>'El barrio es requerido',
                       'id_ciudad.not_in'=>'La ciudad es requerida',
                       'lat.required'=>'La latitud es requerida',
                       'lon.required'=>'La longitud es requerida'); 

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
      $barrio= new Barrios; 
      $barrio->barrio = $request->nombre; 
      $barrio->id_ciudad = $request->id_ciudad; 
      $barrio->lat = $request->lat;
      $barrio->lon = $request->lon;
      $barrio->id_usuario=$request->id_usuario;
      $barrio->save(); 
      return response()->json($barrio);

      }  
        
    }

  public function editar_barrios($barrio_id){
    $barrio = Barrios::find($barrio_id);
    return response()->json($barrio);
    }

  public function update_barrios (Request $request,$barrio_id){

 

        $barrio = Barrios::find($barrio_id);
        $barrio->barrio = $request->nombre;
        $barrio->id_ciudad = $request->id_ciudad; 
        $barrio->lat = $request->lat;
        $barrio->lon = $request->lon;
        $barrio->id_usuario=$request->id_usuario;
        $barrio->save();
        return response()->json($barrio);

      
    }

  public function destroy_barrios($barrio_id){
     

    try
       {

          $barrio = Barrios::destroy($barrio_id);
          return response()->json($barrio);
              
        }catch(\Illuminate\Database\QueryException $e)
        {
           
            if($e->getCode() === '23000') {

               return response()->json([ 'success' => false ], 400);
        
              } 

        }
      
    }


  public function tablaBarrios($id_ciudad ){
    
      $barrios = Barrios::where('id_ciudad',$id_ciudad)->get();
     
      return response()->json($barrios);
 
   
    }



}
