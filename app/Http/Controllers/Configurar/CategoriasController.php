<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categorias;
use App\Subcategorias;
use Redirect;
use Illuminate\Support\Facades\Validator;


class CategoriasController extends Controller
{
    
    public function index(Request $request){
    	

          $categoria = $request["buscarcategoria"];
          $status    = $request["selectstatus"];
          $tipo      = $request["selecttipo"];

         
          if($categoria!="" && $status=="" && $tipo=="" )
          {
              $categorias= Categorias::where('categoria','LIKE', $categoria.'%')->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status!="" && $tipo=="")
          {
               $categorias=Categorias::where('status', $status)->orderBy('categoria','asc')->paginate(10);

          }
          if($categoria=="" && $status=="" && $tipo!="")
          {
               $categorias=Categorias::where('tipo', $tipo)->orderBy('categoria','asc')->paginate(10);
          }
          if($categoria=="" && $status=="" && $tipo=="")
          {
               $categorias=  Categorias::orderBy('categoria','ASC')->paginate(10);
          }

          
            if($request->ajax()){
                  return response()->json(view('Configurar.Categorias.lista',compact('categorias'))->render());
              }
          
            return view('Configurar.Categorias.index')->with('categorias',$categorias);

    }

 /*     public function search (Request $request){

    if($request->ajax())
    {
     
     if(isset($request->search))
     {
      $output="";
      $categorias = DB::table('categorias')->where('categorias','LIKE','%'.$request->search."%")->paginate(10);
     
        if($categorias)
          {
           
          foreach ($categorias as $key => $categoria)
          {
           
                $output.='<tr id="categoria'.$categoria->id.'">'.
                         '<td width="45%" >'.$categoria->categoria.'</td>';

            if ($categoria->status==1 ){
                $output.=  '<td width="45%">'."Activo".'</td>';     
            }else{
                $output.= '<td width="45%">'."Inactivo".'</td>';
            }
                $output.= '<td width="10%" class="text-right"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="'.$categoria->id.'"><i class="fa fa-lg fa-edit"></i></button><button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="'.$categoria->id.'"><i class="fa fa-lg fa-trash"></i></button></div></td>'.
          '</tr>';
     
          }

     return Response($output);

      }

    }elseif (isset($request->valor)) {

        $output="";
        if(($request->valor=="estatus"))
        {
          $categorias= categorias::orderBy('categoria','ASC')->paginate(10);
        }else{
        $categorias= categorias::where('status',$request->valor)->paginate(10);
        }

        if($categorias)
          {
           
          foreach ($categorias as $key => $categoria)
          {
           
                $output.='<tr id="categoria'.$categoria->id.'">'.
                         '<td width="45%" >'.$categoria->categoria.'</td>';

            if ($categoria->status==1 ){
                $output.=  '<td width="45%">'."Activo".'</td>';     
            }else{
                $output.= '<td width="45%">'."Inactivo".'</td>';
            }
                $output.= '<td width="10%" class="text-right"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="'.$categoria->id.'"><i class="fa fa-lg fa-edit"></i></button><button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="'.$categoria->id.'"><i class="fa fa-lg fa-trash"></i></button></div></td>'.
          '</tr>';
     
          }

     return Response($output);

      }
 
   }
 } 
}*/

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
            $categoria->categoria= $request->nombre;
            $categoria->tipo     = $request->tipo;
            $categoria->status   = $request->status;
            $categoria->id_usuario=$request->id_usuario;
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
        $categoria->categoria = $request->nombre;
        $categoria->tipo     = $request->tipo;
        $categoria->status = $request->status;
        $categoria->id_usuario=$request->id_usuario;
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