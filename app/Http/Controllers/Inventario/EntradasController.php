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
use Barryvdh\DomPDF\Facade as PDF;
@session_start();

class EntradasController extends Controller
{
    public function index(Request $request){

        $documento    = $request->nro_documento;
        $estado       = $request->id_estado;
        $id_proveedor = $request->id_proveedor;
        $fecha        = $request->fecha;
        $tipo="";
        $mensaje="";
        $tipo = $request->tipo;
        $mensaje = $request->mensaje;
    	  $proveedores = Proveedores::where('id_estado','1')->get();
        $estados     = Estados::orderby('id')->get();
        //dd($estado);
        if($id_proveedor!='' && $fecha!='' &&$estado!=''){
        $solped = DB::table('solped as a')->join('detalle_solped as b','a.id','=','b.id_solped')                 ->join('proveedores as c','a.id_proveedor','=','c.id')->select('a.id','a.fecha','a.nro_documento','a.modificado','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->where('id_proveedor',$id_proveedor)->where('a.fecha',$fecha)->where('a.id_estado',$estado)->orderby('fecha','desc')->groupBy('a.id')->paginate(10);

        }
        if($id_proveedor!='' && $fecha=='' && $estado!=''){
        $solped = DB::table('solped as a')->join('detalle_solped as b','a.id','=','b.id_solped')                 ->join('proveedores as c','a.id_proveedor','=','c.id')->select('a.id','a.fecha','a.nro_documento','a.modificado','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->where('a.id_proveedor',$id_proveedor)->where('a.id_estado',$estado)->orderby('fecha','desc')->groupBy('a.id')->paginate(10);
            
        }
        if($id_proveedor=='' && $fecha!='' && $estado!=''){
        $solped = DB::table('solped as a')->join('detalle_solped as b','a.id','=','b.id_solped')                 ->join('proveedores as c','a.id_proveedor','=','c.id')->select('a.id','a.fecha','a.nro_documento','a.modificado','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->where('a.fecha',$fecha)->where('a.id_estado',$estado)->orderby('fecha','desc')->groupBy('a.id')->paginate(10);
            
        }
        if($id_proveedor=='' && $fecha=='' && $estado!=''){
        $solped = DB::table('solped as a')->join('detalle_solped as b','a.id','=','b.id_solped')                 ->join('proveedores as c','a.id_proveedor','=','c.id')->select('a.id','a.fecha','a.nro_documento','a.modificado','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->where('a.id_estado',$estado)->orderby('fecha','desc')->groupBy('a.id')->paginate(10);
            
        }

        if($id_proveedor=='' && $fecha=='' && $estado==''){
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
        $detallesolped= db::table('detalle_solped as a')->join('productos as b','a.id_producto','=','b.id')->select('b.codigo_producto as codigo','b.descripcion as desprod','a.precio','a.cantidad','a.nfactura','a.cantidad_confirmada','a.precio_confirmado','a.condicion')->where('a.id_solped',$id)->orderby('a.id','asc')->get();
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
         //dd($lista);
          foreach ($lista as $deta)
          {   
              $detallesolped= new detallesolped;
              $detallesolped->id_solped = $solped->id;
              $detallesolped->id_producto = $deta["id"];
              $detallesolped->precio      = $deta["precio"];
              $detallesolped->cantidad    = $deta["cantidad"];
              //$detallessolped->pagado     = 0;
              //$detallessolped->condicion  = 1;
              
              $detallesolped->save();
        }            
          
               $tipo="1";
                $mensaje="Solicitud de Pedido Almacenada correctamente";

        }
        $proveedores = Proveedores::where('id_estado','1')->get();
        $estados     = Estados::orderby('id')->get();       
        $solped = DB::table('solped as a')
                  ->join('proveedores as c','a.id_proveedor','=','c.id')
                  ->join('detalle_solped as b','a.id','=','b.id_solped')
                  ->select('a.id','a.fecha','a.modificado','a.nro_documento','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->orderby('a.fecha','desc')
                  ->groupBy('a.id')->paginate(10);
                  
        return view('Inventario.Entradas.index')->with('proveedores',$proveedores)->with('solped',$solped)->with('tipo',$tipo)->with('mensaje',$mensaje)->with('estados',$estados);
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
        //$detallessolped->pagado = 0;
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

    public function edit($id)
    {
        $solped=solped::find($id);
        $proveedores = proveedores::where('id_estado','1')->get();
        $detallesolped= db::table('detalle_solped as a')->join('productos as b','a.id_producto','=','b.id')->select('b.id as idproducto','b.codigo_producto as codigo','b.descripcion as desprod','a.precio','a.cantidad','a.nombre_fiscal','a.pagado','a.cantidad_confirmada','a.precio_confirmado','a.nfactura')->where('a.id_solped',$id)->orderby('a.id','asc')->get();
        //$detallesolped = detallesolped::where('id_solped',$id)->get();
           $deta= db::table('detalle_solped as a')->
                  join('productos as b','a.id_producto','=','b.id')
                  ->select(DB::raw('count(b.id) as cantidad'))->where('a.id_solped',$id)->orderby('a.id','asc')->first();
                  
        $cantidad = $deta->cantidad;  

        return view('Inventario.Entradas.editar')->with('solped',$solped)->with('proveedores',$proveedores)->with('detalles',$detallesolped)->with('cant',$cantidad);
    }



    public function carga(Request $request)
    {
        $lista = json_decode($request->ListaProd,true);
        $id = $request->idsolped;     
        $idproducto            = $request->get('idproducto');   
        $cont=0;
        $z = 0;
       
        while($cont < count($idproducto)) 
          { 
            if(isset($idproducto[$cont]["cf"]))
            {
                $detallesolped=detallesolped::where('id_solped',$id)->where('id_producto',$idproducto[$cont]["id"])->first();
                
                if($detallesolped){
                 
                  $detallesolped->cantidad_confirmada = $idproducto[$cont]["cf"];
                  if(!empty($idproducto[$cont]["pf"])){
                  
                    $detallesolped->precio_confirmado    = $idproducto[$cont]["pf"];
                  }
                  if($detallesolped->precio!=$detallesolped->precio_confirmado || $detallesolped->cantidad!=$detallesolped->cantidad_confirmada)
                  { $z++;  //$detallessolped->condicion      = 2;}   
                  $detallesolped->nombre_fiscal  = $idproducto[$cont]["nombre"];
                  $detallesolped->nfactura       = $idproducto[$cont]["factura"];
                  //$detallessolped->pagado        = 0;
                  $detallesolped->save();
                 
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
              //$detallessolped->pagado     = 0;
              $detallesolped->cantidad_confirmada  =  $deta["cantidad"];
              $detallesolped->precio_confirmado    = $deta["precio"];
              $detallesolped->nombre_fiscal        = $deta["nombre_fiscal"];
              $detallesolped->nfactura             = $deta["nro_factura"];
              //$detallesolped->pagado               = 0;
              //$detallessolped->condicion      = 2;
              $detallesolped->save();
               $z++;
           }            
          }
          //dd($cambio);

        $solped=solped::find($id);
        $solped->id_estado=7;
        $solped->observaciones = $request->observaciones;
        $solped->fecha_confirmacion = $request->fecha_confirmacion;
        $solped->modificado         = $z;
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

    public function update(Request $request)
    {

        $lista = json_decode($request->ListaProd,true);
        $id = $request->idsolped;     
        $idproducto           = $request->get('idproducto');   
        $cont=0;
        $z = 0;
        while($cont < count($idproducto))    
          {           
                $detallesolped=detallesolped::where('id_solped',$id)->where('id_producto',$idproducto[$cont]["id"])->where('pagado',NULL)->first();
                if($detallesolped){
                  if(isset($idproducto[$cont]["cantidad"]))
                  {
                  $detallesolped->cantidad  = $idproducto[$cont]["cantidad"];
                  $detallesolped->precio    = $idproducto[$cont]["precio"];
                  //$detallessolped->pagado     = 0;
                  //$detallessolped->condicion =2;
                  $detallesolped->save();

                  }
                 
                }
                  $cont++;
          }
          //dd($lista);
          if(!empty($lista))
          {
            $cond="2";
            //dd($cond);
            foreach ($lista as $deta)
            {   
              $deta2 = detallesolped::where('id_solped',$id)->where('id_producto', $deta["id"])->first();
              if(!$deta2){
              $detallesolped= new detallesolped;
              $detallesolped->id_solped = $id;
              $detallesolped->id_producto = $deta["id"];
              $detallesolped->precio      = $deta["precio"];
              $detallesolped->cantidad    = $deta["cantidad"];
              //$detallesolped->pagado      = 0;
              //$detallessolped->procesa  = $deta["condicion"];;
              $detallesolped->save();
               $z++;
              }
           }   
                   


          }
          //dd($cambio);
        
        $solped=solped::find($id);
        $solped->id_estado=11;
        $solped->observaciones = $request->observaciones;
        $solped->fecha_confirmacion = $request->fecha_confirmacion;
        $solped->modificado         = $z;
        $solped->save();
        $auditoria             = new auditoria();
        $auditoria->id_usuario =  $_SESSION["user"];
        $auditoria->fecha      = date('Y-m-d');

        $auditoria->accion     = "Modificación de Pedido de Producto:".$id;
        $auditoria->save(); 
        $tipo=1;
        $mensaje="Modificación Ejecutada con éxito";
        $proveedores = Proveedores::where('id_estado','1')->get();
        $estados     = Estados::orderby('id')->get();       
        $solped = DB::table('solped as a')
                  ->join('proveedores as c','a.id_proveedor','=','c.id')
                  ->join('detalle_solped as b','a.id','=','b.id_solped')
                  ->select('a.id','a.modificado','a.fecha','a.nro_documento','a.fecha','a.id_proveedor','c.nombres',DB::raw('sum(b.precio * b.cantidad) as monto'),DB::raw('sum(b.precio_confirmado * b.cantidad_confirmada) as montoc'),'a.id_estado','a.created_at')->orderby('a.fecha','desc')
                  ->groupBy('a.id')->paginate(10);
                  
        return view('Inventario.Entradas.index')->with('proveedores',$proveedores)->with('solped',$solped)->with('tipo',$tipo)->with('mensaje',$mensaje)->with('estados',$estados);      
    }

  public function anular(Request $request){      
      //dd($request);
      try
            {
             $id = $request->id;
             $solped= solped::find($id);
              $solped->id_estado = 10;
              $solped->modificado =0;
              $solped->save();
              return response()->json($solped);
          }catch(\Illuminate\Database\QueryException $e)
          {
           
              if($e->getCode() === '23000') {
                 
                    return response()->json([ 'success' => false ], 400);
        
              } 
          }


    }

    public function pdf($id)
    {
        $solped=solped::where('id',$id)->get();
        $proveedores = proveedores::where('id_estado','1')->get();
        $detallesolped= db::table('detalle_solped as a')->join('productos as b','a.id_producto','=','b.id')->select('b.id as idproducto','b.codigo_producto as codigo','b.descripcion as desprod','a.precio','a.cantidad','a.nombre_fiscal','a.pagado','a.cantidad_confirmada','a.precio_confirmado','a.nfactura')->where('a.id_solped',$id)->orderby('a.id','asc')->get();
        //$detallesolped = detallesolped::where('id_solped',$id)->get();
           $deta= db::table('detalle_solped as a')->
                  join('productos as b','a.id_producto','=','b.id')
                  ->select(DB::raw('count(b.id) as cantidad'))->where('a.id_solped',$id)->orderby('a.id','asc')->first();
                  
        $cantidad = $deta->cantidad;  
        $pdf = PDF::loadView('pdf.solped',compact('solped','proveedores','detallesolped'));
        $namefile = "solped".$id.".pdf";
         return $pdf->download($namefile);
    }

  
}
