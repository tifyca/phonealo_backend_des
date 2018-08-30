<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categorias;
use Redirect;
use Illuminate\Support\Facades\Validator;


class CategoriasController extends Controller
{
    
    public function index(){
    	
      $categorias= Categorias::all();
   
     
      return view('Configurar.Categorias.index')->with('categorias',$categorias);

    }

  public function store(Request $request){  

    $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:categorias,categoria', 
                   'status'=>'required'); 
   $messages = array( 'nombre.required'=>'Nombre de la Categoria es requerido', 
                      'nombre.unique' => 'La Categoria ya existe', 
                      'status.required'=>'El estatus es requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 

        $categoria= new Categorias;
        $categoria->categoria= $request->nombre;
        $categoria->tipo     = $request->tipo;
        $categoria->status   = $request->status;
        $categoria->save();
        return response()->json($categoria);
    }  
        
    }

  public function editar($categoria_id){
    $categoria = Categorias::find($categoria_id);
    return response()->json($categoria);
    }

  public function update (Request $request,$categoria_id){
        $categoria = Categorias::find($categoria_id);
        $categoria->categoria = $request->nombre;
        $categoria->tipo     = $request->tipo;
        $categoria->status = $request->status;
        $categoria->save();
        return response()->json($categoria);
    }

  public function destroy($categoria_id){
      $categoria = Categorias::destroy($categoria_id);
      return response()->json($categoria);
    }

}