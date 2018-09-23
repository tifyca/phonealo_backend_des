<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proveedores;
use App\solped;
use App\detallesolped;
use App\auxiliar;
use App\Productos;
use App\auditoria;
use App\Estados;
use DB;
@session_start();

class EntradasController extends Controller
{
    public function index(Request $request){
        $documento    = $request->nro_documento;
        $id_proveedor = $request->id_proveedor;
        $fecha        = $request->fecha;
        $tipo="";
        $mensaje="";
        $tipo = $request->tipo;
        $mensaje = $request->mensaje;
    	  $proveedores = Proveedores::where('id_estado','1')->get();
        $estados     = Estados::orderby('id')->get();
        if($id_proveedor!='' && $fecha!=''){
        $solped = DB::table('solped as a')->join('detalle_solped as b','a.id','=','b.id_solped')                 ->join('proveedores as c','a.id_proveedor','=','c.id')->select('a.id','a.fecha','a.nro_documento','a.modificado','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->where('id_proveedor',$id_proveedor)->where('a.fecha',$fecha)->orderby('fecha','desc')->groupBy('a.id')->paginate(10);

        }
        if($id_proveedor!='' && $fecha==''){
        $solped = DB::table('solped as a')->join('detalle_solped as b','a.id','=','b.id_solped')                 ->join('proveedores as c','a.id_proveedor','=','c.id')->select('a.id','a.fecha','a.nro_documento','a.modificado','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->where('a.id_proveedor',$id_proveedor)->orderby('fecha','desc')->groupBy('a.id')->paginate(10);
            
        }
        if($id_proveedor=='' && $fecha!=''){
        $solped = DB::table('solped as a')->join('detalle_solped as b','a.id','=','b.id_solped')                 ->join('proveedores as c','a.id_proveedor','=','c.id')->select('a.id','a.fecha','a.nro_documento','a.modificado','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->where('a.fecha',$fecha)->orderby('fecha','desc')->groupBy('a.id')->paginate(10);
            
        }
        if($id_proveedor=='' && $fecha==''){
        $solped = DB::table('solped as a')
                  ->join('proveedores as c','a.id_proveedor','=','c.id')
                  ->join('detalle_solped as b','a.id','=','b.id_solped')
                  ->select('a.id','a.fecha','a.modificado','a.nro_documento','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->orderby('fecha','desc')
                  ->groupBy('a.id')->paginate(10);
            
        }

  		 
    	//$solped = solped::orderby('created_at','desc')->paginate(10);
    	return view('Inventario.Entradas.index')->with('proveedores',$proveedores)->with('solped',$solped)->with('tipo',$tipo)->with('mensaje',$mensaje)->with('estados',$estados);
    }

    public function show(){
    	$proveedores = proveedores::where('id_estado','1')->get();
    	$fecha = date('Y-m-d');
    	return view('Inventario.Entradas.show')->with('proveedores',$proveedores)->with('fecha',$fecha);
    }

    public function vista($id)
    {
        $solped=solped::find($id);
        $proveedores = proveedores::where('id_estado','1')->get();
        $detallesolped= db::table('detalle_solped as a')->join('productos as b','a.id_producto','=','b.id')->select('b.codigo_producto as codigo','b.descripcion as desprod','a.precio','a.cantidad','a.nfactura','a.cantidad_confirmada','a.precio_confirmado')->where('a.id_solped',$id)->orderby('a.id','asc')->get();
        //$detallesolped = detallesolped::where('id_solped',$id)->get();
        return view('Inventario.Entradas.solped')->with('solped',$solped)->with('proveedores',$proveedores)->with('detalles',$detallesolped);
    }
    public function store(Request $request)
    {
   	        
           $lista = json_decode($request->ListaProd,true);
           
           $nro_documento=$request->nro_documento;
            $solped=solped::where('nro_documento',$nro_documento)->first();
            if($solped){
                $tipo="2";
                $mensaje="Nro de Solicitud de Pedido Ya Existe";
            }
            else{    
            $solped = new solped;
            $solped->id_proveedor   = $request->get('id_proveedor');
            $solped->nro_documento  = $request->get('nro_documento');
            $solped->fecha          = $request->get('fecha_entrada');

            $solped->id_usuario     = $request->get('id_usuario');
            $solped->id_estado      = 1;
            $solped->id_usuario     = $_SESSION["user"];
            $solped->created_at     = date('Y-m-d');
            $solped->updated_at     = date('Y-m-d');
            $solped->save();
            $codigo     = $request->get('cod');
            $cantidad   = $request->get('cant');
            $precio     = $request->get('prec');
            $cont=0;

          foreach ($lista as $deta)
          {   
              $detallesolped= new detallesolped;
              $detallesolped->id_solped = $solped->id;
              $detallesolped->id_producto = $deta["id"];
              $detallesolped->precio      = $deta["precio"];
              $detallesolped->cantidad    = $deta["cantidad"];
              $detallesolped->save();
        }            
            //$detalles = auxiliar::where('documento',$request->get('nro_documento'))->get();
           
            //foreach ($detalles as $det) {
              //  $detallesolped= new detallesolped;
              //  $detallesolped->id_solped = $solped->id;
              //  $detallesolped->id_producto = $det->codigo;
              //  $detallesolped->precio      = $det->precio;
             //   $detallesolped->cantidad    = $det->cantidad;
             //   $detallesolped->save();
             //   $det->delete();

             //    $auditoria = new auditoria();
             //    $auditoria->id_usuario =  $_SESSION["user"];
             //    $auditoria->fecha      = date('Y-m-d');
             //    $auditoria->accion     = "Solicitud de Pedido de Producto:".$solped->id;
             //    $auditoria->id_producto = $det->codigo;
             //    $auditoria->save(); 

            //}

               $tipo="1";
                $mensaje="Solicitud de Pedido Almacenada correctamente";

        }
        $proveedores = Proveedores::where('id_estado','1')->get();
        $estados     = Estados::orderby('id')->get();       
        $solped = DB::table('solped as a')
                  ->join('proveedores as c','a.id_proveedor','=','c.id')
                  ->join('detalle_solped as b','a.id','=','b.id_solped')
                  ->select('a.id','a.fecha','a.nro_documento','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->orderby('a.fecha','desc')
                  ->groupBy('a.id')->paginate(10);
                  
        return view('Inventario.Entradas.index')->with('proveedores',$proveedores)->with('solped',$solped)->with('tipo',$tipo)->with('mensaje',$mensaje)->with('estados',$estados);
    }

    public function anular(Request $request){      
      try
            {
             $id = $request->id;
             $solped= solped::find($id);
              $solped->id_estado = 10;
              $solped->save();
              return response()->json($solped);
          }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {
                 
                    return response()->json([ 'success' => false ], 400);
        
              } 
          }


    }
    public function cargar_detalle(Request $request){

        $data=$request->all();
        $documento  = $request->ndoc;
        $codigo     = $request->idc;
        $descripcion= $request->desc;
        $cantidad   = $request->cant;
        $precio     = $request->prec;
        $detalle = new auxiliar;
        $detalle->documento   = $documento;
        $detalle->codigo      = $codigo;
        $detalle->descripcion = $descripcion;
        $detalle->cantidad    = $cantidad;
        $detalle->precio      = $precio;
        $detalle->save();
        $data["status"]="ok";
        return $data;
    }

    public function eliminar_detalle(Request $request){

        $data=$request->all();
        $documento  = $request->ndoc;
        $codigo     = $request->idc;
        $descripcion= $request->desc;
        $cantidad   = $request->cant;
        $precio     = $request->prec;
        $detalle = auxiliar::where('codigo',$codigo)->where('documento',$documento)->first();

        $detalle->delete(); 
        $data["status"]="ok";
        return $data;
    }


    public function confirmar($id)
    {
        $solped=solped::find($id);
        $proveedores = proveedores::where('id_estado','1')->get();
        $detallesolped= db::table('detalle_solped as a')->join('productos as b','a.id_producto','=','b.id')->select('b.id as idproducto','b.codigo_producto as codigo','b.descripcion as desprod','a.precio','a.cantidad','a.nombre_fiscal','a.pagado','a.cantidad_confirmada','a.precio_confirmado','a.nfactura')->where('a.id_solped',$id)->orderby('a.id','asc')->get();
        //$detallesolped = detallesolped::where('id_solped',$id)->get();
           $deta= db::table('detalle_solped as a')->
                  join('productos as b','a.id_producto','=','b.id')
                  ->select(DB::raw('count(b.id) as cantidad'))->where('a.id_solped',$id)->orderby('a.id','asc')->first();
                  
        $cantidad = $deta->cantidad;  

        return view('Inventario.Entradas.confirmar')->with('solped',$solped)->with('proveedores',$proveedores)->with('detalles',$detallesolped)->with('cant',$cantidad);
    }

    public function carga(Request $request)
    {
        //dd($request);
        $lista = json_decode($request->ListaProd,true);
        $id = $request->idsolped;
        
        $idproducto            = $request->get('idproducto');
        $cantidad_conf         = $request->get('cantidad_conf');
        $precio_conf           = $request->get('precio_conf');
        $nombre_conf           = $request->get('nombre_conf');
        $factura               = $request->get('nfactura');

        $cont=0;
        $cambio = 0;
        while($cont < count($idproducto))
       
          {
            if(!empty($cantidad_conf[$cont]))
            {
                $detallesolped=detallesolped::where('id_solped',$id)->where('id_producto',$idproducto[$cont])->where('pagado',0)->first();
                //dd($detallesolped);
                if($detallesolped){
                 
                  $detallesolped->cantidad_confirmada = $cantidad_conf[$cont];
                  if(!empty($precio_conf[$cont])){
                  
                    $detallesolped->precio_confirmado    = $precio_conf[$cont];
                  }
                  if($detallesolped->precio!=$detallesolped->precio_confirmado || $detallesolped->cantidad!=$detallesolped->cantidad_confirmada)
                  { $cambio++;}   
                  $detallesolped->nombre_fiscal  = $nombre_conf[$cont];
                  $detallesolped->nfactura       = $factura[$cont];
                  $detallesolped->save();
                  //$productos=productos::where('id',$idproducto[$cont])->first();
                  //if($productos){
                  //    $productos->precio_compra = $precio_conf[$cont];
                  //    $productos->stock_activo  = $productos->stock_activo + $cantidad_conf[$cont];
                  //    $productos->save();
                  //  }
                }else{

                }
            }
            $cont++;
          }
          if(!empty($lista))
          {
            foreach ($lista as $deta)
            {   
              $detallesolped= new detallesolped;
              $detallesolped->id_solped = $id;
              $detallesolped->id_producto = $deta["id"];
              $detallesolped->precio      = $deta["precio"];
              $detallesolped->cantidad    = $deta["cantidad"];
              $detallesolped->cantidad_confirmada  =  $deta["cantidad"];
              $detallesolped->precio_confirmado    = $deta["precio"];
              $detallesolped->nombre_fiscal        = $deta["nombre_fiscal"];
              $detallesolped->nfactura             = $deta["nro_factura"];
              $detallesolped->pagado               = 0;
              $detallesolped->save();
           }            
          }

        $solped=solped::find($id);
        $solped->id_estado=7;
        $solped->observaciones = $request->observaciones;
        $solped->fecha_confirmacion = $request->fecha_confirmacion;
        $solped->modificado         = $cambio;
        $solped->save();
        $auditoria             = new auditoria();
        $auditoria->id_usuario =  $_SESSION["user"];
        $auditoria->fecha      = date('Y-m-d');

        $auditoria->accion     = "Confirmación de Pedido de Producto:".$id;
        $auditoria->save(); 
        $tipo=1;
        $mensaje="Confirmación Ejecutada con éxito";
        $proveedores = Proveedores::where('id_estado','1')->get();
        $estados     = Estados::orderby('id')->get();       
          $solped = DB::table('solped as a')
                  ->join('proveedores as c','a.id_proveedor','=','c.id')
                  ->join('detalle_solped as b','a.id','=','b.id_solped')
                  ->select('a.id','a.modificado','a.fecha','a.nro_documento','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->orderby('a.fecha','desc')
                  ->groupBy('a.id')->paginate(10);
                  
        return view('Inventario.Entradas.index')->with('proveedores',$proveedores)->with('solped',$solped)->with('tipo',$tipo)->with('mensaje',$mensaje)->with('estados',$estados);      
    }
}
