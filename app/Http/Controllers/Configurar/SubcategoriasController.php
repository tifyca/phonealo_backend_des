<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categorias;
use App\Subcategorias;
use Redirect;
use Illuminate\Support\Facades\Validator;


class SubcategoriasController extends Controller
{
    public function index(Request $request){

    	$categorias = Categorias::where('status',1)
                ->select('categoria','id')->get();

        $subcategorias= Subcategorias::join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')
        				->select('sub_categorias.id', 'categoria','sub_categoria','sub_categorias.status')->paginate(10);

                 if($request->ajax()){
            return response()->json(view('Configurar.Subcategorias.lista',compact('subcategorias'))->render());
        }
    
    	return view('Configurar.Subcategorias.index',compact('categorias', 'subcategorias'));
    }
    
    public function store(Request $request){  

         $data=$request->all();

   $rules = array( 'nombre'=>'required|unique:sub_categorias,sub_categoria', 
                   'status'=>'required'); 
   $messages = array( 'nombre.required'=>'Nombre de la Subcategoría es requerido', 
                      'nombre.unique' => 'La Subcategoría ya existe', 
                      'status.required'=>'El estatus es requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 

        $subcategoria= new Subcategorias;
        $subcategoria->id_categoria = $request->categoria;
        $subcategoria->sub_categoria= $request->nombre;  
        $subcategoria->status   = $request->status;
        $subcategoria->id_usuario=$request->id_usuario;
        $subcategoria->save();
        return response()->json($subcategoria);
      }  
        
    }

  public function editar($subcategoria_id){
    $subcategoria = Subcategorias::find($subcategoria_id);

    return response()->json($subcategoria);
    }

  public function update (Request $request,$subcategoria_id){
        $subcategoria = Subcategorias::find($subcategoria_id);
        $subcategoria->sub_categoria = $request->nombre;
        $subcategoria->id_categoria = $request->categoria;
        $subcategoria->status = $request->status;
        $subcategoria->id_usuario=$request->id_usuario;
        $subcategoria->save();
        return response()->json($subcategoria);
    }

  public function destroy($subcategoria_id){
      $subcategoria = Subcategorias::destroy($subcategoria_id);

      return response()->json($subcategoria);
    }

    public function tipocat($cat){
      $cat = Categorias::where('id', '=', $cat)
      ->select('id', 'categoria')->first();
     
      return response()->json($cat);
    }


}
