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

      $subcategoria = $request["subcat"];
      $status       = $request["status"];
      $categoria    =$request["cat"];
   
    if($subcategoria!="" && $status=="" && $categoria=="" )
    {
     
      $subcategorias= Subcategorias::search( $subcategoria)
                                   ->orderBy('sub_categoria','asc')
                                   ->paginate(10);

    }
    if($subcategoria=="" && $status!="" && $categoria=="")
    {
         $subcategorias= Subcategorias::status($status)
                                      ->orderBy('sub_categoria','asc')
                                      ->paginate(10);
    }
    if($subcategoria=="" && $status=="" && $categoria!="")
    {
         $subcategorias= Subcategorias::categoria($categoria)
                                      ->orderBy('sub_categoria','asc')
                                      ->paginate(10);
    }
    if($subcategoria!="" && $status!="" && $categoria!="")
    {
         $subcategorias= Subcategorias::search2($categoria, $status, $subcategoria)
                                      ->orderBy('sub_categoria','asc')
                                      ->paginate(10);
    }
   
 if($subcategoria!="" && $status!="" && $categoria=="")
    {
         $subcategorias= Subcategorias::search3($status, $subcategoria)
                                      ->orderBy('sub_categoria','asc')
                                      ->paginate(10);
    }
    if($subcategoria!="" && $status=="" && $categoria!="")
    {
         $subcategorias= Subcategorias::search4($categoria, $subcategoria)
                                      ->orderBy('sub_categoria','asc')
                                      ->paginate(10);
    }

    if($subcategoria=="" && $status=="" && $categoria=="")
    {
         $subcategorias= Subcategorias::join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')
                ->select('sub_categorias.id', 'categoria','sub_categoria','sub_categorias.status')
                ->orderBy('sub_categoria','asc')
                ->paginate(10);
    }
    if($subcategoria=="" && $status!="" && $categoria!="")
    {
         $subcategorias= Subcategorias::search5($categoria, $status)
                                      ->orderBy('sub_categoria','asc')
                                      ->paginate(10);
    }


    	  $categorias = Categorias::where('status',1)
                      ->select('categoria','id')->orderBy('categoria','asc')->get();


                 if($request->ajax()){
            return response()->json(view('Configurar.Subcategorias.lista',compact('subcategorias'))->render());
        }
    
    	return view('Configurar.Subcategorias.index',compact('categorias', 'subcategorias'));
    }
    
    public function store(Request $request){  

      $data=$request->all();

      $rules = array( 'nombre'=>'required|unique:sub_categorias,sub_categoria',
                      'categoria'=> 'required|not_in:0',
                      'status'=>'required'); 
      $messages = array( 'nombre.required'=>'Nombre de la Subcategoría es requerido', 
                      'nombre.unique' => 'La Subcategoría ya existe', 
                      'categoria.required'=>'La Categoria es Requerida',
                       'categoria.not_in'=>'La Categoria es Requerida',
                      'status.required'=>'El estatus es requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 

        $subcategoria= new Subcategorias;
        $subcategoria->id_categoria = $request->categoria;
        $subcategoria->sub_categoria= ucwords(strtolower($request->nombre));  
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

      $data=$request->all();
      $rules = array( 'nombre'=>'required|unique:sub_categorias,sub_categoria,' .$subcategoria_id,
                      'categoria'=> 'required|not_in:0',
                      'status'=>'required'); 
      $messages = array( 'nombre.required'=>'Nombre de la Subcategoría es requerido', 
                      'nombre.unique' => 'La Subcategoría ya existe', 
                      'categoria.required'=>'La Categoria es Requerida',
                       'categoria.not_in'=>'La Categoria es Requerida',
                      'status.required'=>'El estatus es requerido' );

    $validator = Validator::make($data, $rules, $messages);


   if($validator->fails()){ 

      $errors = $validator->errors(); 
      return response()->json([ 'success' => false, 'message' => json_decode($errors) ], 400);
      
     }elseif ($validator->passes()){ 

        $subcategoria = Subcategorias::find($subcategoria_id);
        $subcategoria->sub_categoria = ucwords(strtolower($request->nombre));
        $subcategoria->id_categoria = $request->categoria;
        $subcategoria->status = $request->status;
        $subcategoria->id_usuario=$request->id_usuario;
        $subcategoria->save();
        return response()->json($subcategoria);
    }

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
