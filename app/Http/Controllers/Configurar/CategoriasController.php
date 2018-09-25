<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categorias;
use App\Subcategorias;
use Redirect;
use Illuminate\Support\Facades\Validator;
@session_start();

class CategoriasController extends Controller
{
    
    public function index(Request $request){
    	
          $categoria = $request["categorias"];
          $status    = $request["status"];
          $tipo      = $request["tipo"];
          $proveedor = $request["proveedor"];

         
          if($categoria!="" && $status=="" && $tipo=="" && $proveedor=="")
          {
              $categorias= Categorias::search($categoria)->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status!="" && $tipo=="" && $proveedor=="")
          {
               $categorias=Categorias::status($status)->orderBy('categoria','asc')->paginate(10);

          }
          if($categoria=="" && $status=="" && $tipo!="" && $proveedor=="")
          {
               $categorias=Categorias::tipo($tipo)->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status=="" && $tipo=="" && $proveedor!="")
          {
               $categorias=Categorias::proveedor($proveedor)->orderBy('categoria','asc')->paginate(10);
          }

          if($categoria!="" && $status!="" && $tipo!="" && $proveedor!="")
          {
               $categorias=Categorias::search2($tipo, $status, $proveedor, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status!="" && $tipo=="" && $proveedor=="")
          {
               $categorias=Categorias::search3($status, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status=="" && $tipo!="" && $proveedor=="")
          {
               $categorias=Categorias::search4($tipo, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status=="" && $tipo=="" && $proveedor=="")
          {
               $categorias=  Categorias::orderBy('categoria','ASC')->paginate(10);
          }
          if($categoria=="" && $status!="" && $tipo!="" && $proveedor=="")
          {
               $categorias=Categorias::search5($tipo,$status)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status=="" && $tipo=="" && $proveedor!="")
          {
               $categorias=Categorias::search6($proveedor, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status!="" && $tipo!="" && $proveedor=="")
          {
               $categorias=Categorias::search7($tipo, $status, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status!="" && $tipo=="" && $proveedor!="")
          {
               $categorias=Categorias::search8($status, $proveedor)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status=="" && $tipo!="" && $proveedor!="")
          {
               $categorias=Categorias::search9( $tipo, $proveedor, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria!="" && $status!="" && $tipo=="" && $proveedor!="")
          {
               $categorias=Categorias::search10($status, $proveedor, $categoria)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status=="" && $tipo!="" && $proveedor!="")
          {
               $categorias=Categorias::search11($tipo, $proveedor)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status!="" && $tipo!="" && $proveedor!="")
          {
               $categorias=Categorias::search12($tipo, $status, $proveedor)
                                     ->orderBy('categoria','asc')->paginate(10);
          }
          
            if($request->ajax()){
                  return response()->json(view('Configurar.Categorias.lista',compact('categorias'))->render());
              }
          
            return view('Configurar.Categorias.index')->with('categorias',$categorias);

    }

 

    public function store(Request $request){  

       $data=$request->all();

       $rules = array( 'nombre'=>'required|unique:categorias,categoria', 
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

            $categoria= new Categorias;
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
    $categoria = Categorias::find($categoria_id);
    return response()->json($categoria);
    }

  public function update (Request $request,$categoria_id){
        
        $data=$request->all();

        $rules = array( 'nombre'=>'required|unique:categorias,categoria,'.$categoria_id, 
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

        $categoria = Categorias::find($categoria_id);
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

              $categoria = Categorias::destroy($categoria_id);
              return response()->json($categoria);

          }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {

                   
                    return response()->json([ 'success' => false ], 400);
        
              } 

          }


    }
   

}