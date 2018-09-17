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

      $pais = $request["scope"];
   
        if($pais!="")
        {   
            $paises= Paises::search($pais)->orderBy('nombre','asc')->paginate(10);

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
      $pais->nombre = ucwords(strtolower($request->nombre)); 
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
        $pais->nombre = ucwords(strtolower($request->nombre));
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

      $dpto = $request["scope"];
   
        if($dpto!="")
        {
            $departamentos= Departamentos::search($dpto)->orderBy('nombre','asc')->paginate(10);

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
      $dpto->nombre = ucwords(strtolower($request->nombre)); 
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
          $dpto->nombre = ucwords(strtolower($request->nombre));
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

      
       // $ciudades ='';

       $ciudad = $request["ciudad"];

       $id_departamento=$request["dpto"];

        if($ciudad!="" && $id_departamento=="")
        {
            $ciudades= Ciudades::search($ciudad)->orderBy('ciudad','asc')->paginate(10);
           // return $ciudades;
             
        }
        if($ciudad!="" && $id_departamento!="")
        {
            $ciudades= Ciudades::search2($ciudad, $id_departamento )->orderBy('ciudad','asc')->paginate(10);
           // return $ciudades;
                 
         } 
        if($ciudad=="" && $id_departamento!="" )
        {
           $ciudades= Ciudades::dpto($id_departamento)->orderBy('ciudad','asc')->paginate(10);
          // return $ciudades;
           
        }
        if($ciudad=="" && $id_departamento=="" )
        {
            $ciudades = Ciudades::join('departamentos', 'departamentos.id', '=', 'ciudades.id_departamento')
                                ->select('id_departamento', 'departamentos.nombre', 'ciudades.id', 'ciudad', 'status', 'ciudades.id_usuario')
                                  ->orderBy('ciudad', 'ASC')->paginate(10);

        }

        $departamentos = Departamentos::orderBy('nombre','asc')->get();


        if($request->ajax()){
            return response()->json(view('Configurar.Direcciones.lista_ciudades',compact('ciudades', 'departamentos'))->render());
        }
      // return view('Configurar.Direcciones.ciudades', compact('departamentos', 'ciudades'));
                 
     return view('Configurar.Direcciones.ciudades') ->with('departamentos',$departamentos)->with('ciudades',$ciudades);

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
      $ciudad->ciudad = ucwords(strtolower($request->nombre)); 
      $ciudad->id_departamento = $request->id_dpto; 
      $ciudad->id_usuario=$request->id_usuario;
      $ciudad->save(); 
      return response()->json($ciudad);

      }  
        
    }

  public function editar_ciudades($ciudad_id){
    $ciudad = Ciudades::where('ciudades.id', $ciudad_id)
                       ->join('departamentos', 'departamentos.id', '=', 'ciudades.id_departamento')
                       ->select('ciudades.id_departamento', 'departamentos.nombre', 'ciudades.id', 'ciudad', 'ciudades.status', 'ciudades.id_usuario')->first();
    
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
                $ciudad->ciudad = ucwords(strtolower($request->nombre));
                $ciudad->id_departamento = $request->id_departamento; 
                $ciudad->status = $request->status; 
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

     public function tablaCiudades($ciudad_id ){
    
     $ciudades = Ciudades::where('ciudades.id', $ciudad_id)
                       ->join('departamentos', 'departamentos.id', '=', 'ciudades.id_departamento')
                       ->select('ciudades.id_departamento', 'departamentos.nombre', 'ciudades.id', 'ciudad', 'ciudades.status', 'ciudades.id_usuario')->get();
     
      return response()->json($ciudades);
 
   
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function barrios(Request $request){


      $barrio = $request["barrio"];

       $id_departamento=$request["dpto"];
        $id_ciudad=$request["ciudad"];


        if($barrio!="" && $id_departamento=="" && $id_ciudad=="")
        {
            $barrios= Barrios::search($barrio)->orderBy('barrio','asc')->paginate(10);
            
        }
        if($barrio=="" && $id_departamento!="" && $id_ciudad=="")
        {
           $barrios= Barrios::dpto($id_departamento)->orderBy('barrio','asc')->paginate(10);
             
        }
        if($barrio=="" && $id_departamento=="" && $id_ciudad!="")
        {
           $barrios= Barrios::ciudad($id_ciudad)->orderBy('barrio','asc')->paginate(10);
             
        }
         if($barrio!="" && $id_departamento!="" && $id_ciudad!="")
        {
          $barrios= Barrios::search2($barrio, $id_departamento, $id_ciudad )
                            ->orderBy('barrio','asc')->paginate(10);
            
        }
        if($barrio!="" && $id_departamento!="" && $id_ciudad=="")
        {
          $barrios= Barrios::search3($barrio, $id_departamento )
                           ->orderBy('barrio','asc')->paginate(10);
            
        }
         if($barrio!="" && $id_departamento=="" && $id_ciudad!="")
        {
          $barrios= Barrios::search4($barrio, $id_ciudad)
                            ->orderBy('barrio','asc')->paginate(10);
           
        }
        if($barrio=="" && $id_departamento=="" && $id_ciudad=="")
        {
           $barrios= Barrios::join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                            ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                            ->Select('barrios.id', 'barrios.id_ciudad', 'barrio', 'departamentos.nombre','ciudades.ciudad','lat', 'lon', 'barrios.id_usuario')
                            ->orderBy('barrio','asc')->paginate(10);
        }
         if($barrio=="" && $id_departamento!="" && $id_ciudad!="")
        {
          $barrios= Barrios::search5( $id_departamento,$id_ciudad)
                            ->orderBy('barrio','asc')->paginate(10);
          
        }

    // $departamentos = Departamentos::orderBy('nombre','asc')->get();
     
        if($request->ajax()){
            return response()->json(view('Configurar.Direcciones.lista_barrios',compact('barrios'))->render());
        }
       // return view('Configurar.Direcciones.ciudades', compact('departamentos', 'ciudades'));
                 
      return view('Configurar.Direcciones.barrios')->with('barrios',$barrios);

    	
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
      $barrio->barrio = ucwords(strtolower($request->nombre)); 
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
        $barrio->barrio = ucwords(strtolower($request->nombre));
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


  public function tablaBarrios($id_barrio){

      $barrios= Barrios::where('barrios.id',$id_barrio)
                       ->join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                       ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                       ->Select('barrios.id', 'barrios.id_ciudad', 'barrio', 'departamentos.nombre','ciudades.ciudad','lat', 'lon', 'barrios.id_usuario')
                       ->orderBy('barrio','asc')->get();
       return response()->json($barrios);
 
   
    }



}
