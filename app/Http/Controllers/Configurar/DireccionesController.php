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
    public function paises(Request $request){

      $pais = $request["buscarpais"];
   
        if($pais!="")
        {
            $paises= Paises::where('nombre','LIKE', $pais.'%')->orderBy('nombre','asc')->paginate(10);

        }
        if($pais=="")
        {
            $paises = Paises::orderBy('nombre', 'ASC')->paginate(10);
        }
    	

       if($request->ajax()){
            return response()->json(view('Configurar.Direcciones.lista_paises',compact('paises'))->render());
        }
    
    	return view('Configurar.Direcciones.paises')->with('paises', $paises);
    }
   
    public function store_paises(Request $request){

    $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:paises,nombre'); 
   $messages = array( 'nombre.required'=>'Nombre del Pais es Requerido', 
                      'nombre.unique' => 'El Pais ya Existe');

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

      $data=$request->all();

      $rules = array( 'nombre'=>'required|unique:paises,nombre,' .$pais_id); 
      $messages = array( 'nombre.required'=>'Nombre del Pais es Requerido', 
                      'nombre.unique' => 'El Pais ya Existe');

      $validator = Validator::make($data, $rules, $messages);


    if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 
        $pais = Paises::find($pais_id);
        $pais->nombre = $request->nombre;
        $pais->id_usuario=$request->id_usuario;
        $pais->save();
        return response()->json($pais);
     }

   }

  public function destroy_paises($pais_id){
      $pais = Paises::destroy($pais_id);
      return response()->json($pais);
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function departamentos(Request $request){

      $dpto = $request["buscardpto"];
   
        if($dpto!="")
        {
            $departamentos= Departamentos::where('nombre','LIKE', $dpto.'%')->orderBy('nombre','asc')->paginate(10);

        }
        if($dpto=="")
        {
            $departamentos = Departamentos::orderBy('nombre', 'ASC')->paginate(10);
        }

    	
       if($request->ajax()){
            return response()->json(view('Configurar.Direcciones.lista_departamentos',compact('departamentos'))->render());
        }
    
    	return view('Configurar.Direcciones.departamentos')->with('departamentos', $departamentos);
    }

    public function store_departamentos(Request $request){

    $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:departamentos,nombre'); 
   $messages = array( 'nombre.required'=>'Nombre del Departamento es Requerido', 
                      'nombre.unique' => 'El Departamento ya Existe');

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

      $data=$request->all();

      $rules = array( 'nombre'=>'required|unique:departamentos,nombre,' .$dpto_id); 
      $messages = array( 'nombre.required'=>'Nombre del Departamento es Requerido', 
                      'nombre.unique' => 'El Departamento ya Existe');

      $validator = Validator::make($data, $rules, $messages);


     if($validator->fails()){ 
       
        $errors = $validator->errors(); 
        return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
      }elseif ($validator->passes()){ 
          $dpto = Departamentos::find($dpto_id);
          $dpto->nombre = $request->nombre;
          $dpto->id_usuario=$request->id_usuario;
          $dpto->save();
          return response()->json($dpto);
      }

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

    public function ciudades(Request $request){

       $departamentos = Departamentos::all();
        $ciudades ='';

       $ciudad = $request["buscarciudad"];

       $id_departamento=$request["id_departamento"];

        if($ciudad!="" && $id_departamento=="")
        {
            $ciudades= Ciudades::where('ciudad','LIKE', $ciudad.'%')->orderBy('ciudad','asc')->get();
            return $ciudades;
             
        }
        if($ciudad!="" && $id_departamento!="")
        {
            $ciudades= Ciudades::where('id_departamento', $id_departamento)
                               ->where('ciudad','LIKE', $ciudad.'%')->orderBy('ciudad','asc')->get();
            return $ciudades;
                 
         } 
        if($ciudad=="" && $id_departamento!="" )
        {
           $ciudades= Ciudades::where('id_departamento', $id_departamento)->orderBy('ciudad','asc')->get();
           return $ciudades;
           
        }
        if($ciudad=="" && $id_departamento="" )
        {
           return view('Configurar.Direcciones.ciudades', compact('departamentos'));

        }

                 
          return view('Configurar.Direcciones.ciudades') ->with('departamentos',$departamentos);

}
    public function store_ciudades(Request $request){

    $data=$request->all();

    $rules = array( 'nombre'=>'required|unique:ciudades,ciudad',
                    'id_dpto'=>'required|not_in:0'); 
    $messages = array( 'nombre.required'=>'Nombre de la Ciudad es Requerido', 
                       'nombre.unique' => 'La Ciudad ya Existe',
                       'id_dpto.required'=>'El Departamento es Requerido',
                       'id_dpto.not_in'=>'El Departamento es Requerido');
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
   
     $data=$request->all();

    $rules = array( 'nombre'=>'required|unique:ciudades,ciudad,' .$ciudad_id); 
    $messages = array( 'nombre.required'=>'Nombre de la Ciudad es Requerido', 
                       'nombre.unique' => 'La Ciudad ya Existe');
    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 

      

                $ciudad = Ciudades::find($ciudad_id);
                $ciudad->ciudad = $request->nombre;
                $ciudad->id_departamento = $request->id_dpto; 
                $ciudad->id_usuario=$request->id_usuario;
                $ciudad->save();
                return response()->json($ciudad);


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


    public function barrios(Request $request){


      $barrio = $request["buscarbarrio"];

       $id_departamento=$request["id_departamento"];
        $id_ciudad=$request["id_ciudad"];


        if($barrio!="" && $id_departamento=="" && $id_ciudad=="")
        {
            $barrios= Barrios::where('barrio','LIKE', $barrio.'%')->orderBy('barrio','asc')->get();
             return $barrios;
        }
        if($barrio=="" && $id_departamento!="" && $id_ciudad=="")
        {
           $barrios= Barrios::join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                              ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                              ->where('ciudades.id_departamento', $id_departamento)->orderBy('barrio','asc')->get();
             return $barrios;
        }
        if($barrio=="" && $id_departamento=="" && $id_ciudad!="")
        {
           $barrios= Barrios::where('id_ciudad', $id_ciudad)->orderBy('barrio','asc')->get();
             return $barrios;
        }
         if($barrio!="" && $id_departamento!="" && $id_ciudad!="")
        {
          $barrios= Barrios::join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                              ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                             ->where('id_ciudad', $id_ciudad)
                            ->where('ciudades.id_departamento', $id_departamento)
                            ->where('barrio','LIKE', $barrio.'%')
                            ->orderBy('barrio','asc')->get();
             return $barrios;
        }
        if($barrio=="" && $id_departamento=="" && $id_ciudad=="")
        {
           return view('Configurar.Direcciones.barrios');
        }

    	
    }

    public function store_barrios(Request $request){

    $data=$request->all();

    $rules = array( 'nombre'=>'required|unique:barrios,barrio',
                    'id_dpto'=>'required|not_in:0', 
                    'id_ciudad'=>'required|not_in:0',
                    'lat'=>'required',
                    'lon'=>'required'); 
    $messages = array( 'nombre.required'=>'Nombre del Barrio es Requerido', 
                       'nombre.unique' => 'El Barrio ya Existe',
                       'id_dpto.required'=>'El Departamento es Requerido',
                       'id_ciudad.required'=>'La Ciudad es Requerida',
                       'id_dpto.not_in'=>'El Departamento es Requerido',
                       'id_ciudad.not_in'=>'La Ciudad es Requerida',
                       'lat.required'=>'La Latitud es Requerida',
                       'lon.required'=>'La Longitud es Requerida'); 

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

        $data=$request->all();

    $rules = array( 'nombre'=>'required|unique:barrios,barrio,' .$barrio_id,
                    'lat'=>'required',
                    'lon'=>'required'); 
    $messages = array( 'nombre.required'=>'Nombre del Barrio es Requerido', 
                       'nombre.unique' => 'El Barrio ya Existe',
                      'lat.required'=>'La Latitud es Requerida',
                      'lon.required'=>'La Longitud es Requerida'); 

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 

        $barrio = Barrios::find($barrio_id);
        $barrio->barrio = $request->nombre;
        $barrio->lat = $request->lat;
        $barrio->lon = $request->lon;
        $barrio->id_usuario=$request->id_usuario;
        $barrio->save();
        return response()->json($barrio);

      }
    }

  public function destroy_barrios($barrio_id){
     
          $barrio = Barrios::destroy($barrio_id);
          return response()->json($barrio); 
      
    }


  public function tablaBarrios($id_ciudad ){
    
      $barrios = Barrios::where('id_ciudad',$id_ciudad)->get();
      return response()->json($barrios);
 
   
    }



}
