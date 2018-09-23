<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;
use App\Subcategorias;
use App\solped;
use App\Categorias;
use App\detallesolped;
class ProductosAjax extends Controller
{
    public function productos_list(Request $request){
    	$producto = $request['producto'];
    	$cadena = $producto.'%';

    	$productos = Productos::where('descripcion', 'LIKE', $cadena)->orderBy('descripcion', 'asc')->get();

    	return $productos;
    }

    public function producto(Request $request){
    	$id_producto = $request['id_producto'];

    	$productos = Productos::where('id', $id_producto)->first();

    	return $productos;
    }

    public function subcategorias_list(Request $request)
    {
        $id_categoria = $request["idc"];
        $subcategorias = Subcategorias::where('id_categoria',$id_categoria)->where('status','1')->orderby('sub_categoria','asc')->get();
        return $subcategorias;
    }

    public function solicitudes_list(Request $request)
    {
        $id_proveedor = $request["idc"];
        $solicitudes = solped::where('id_proveedor',$id_proveedor)->where('id_estado','7')->get();
        return $solicitudes;
    }

    public function solped_monto(Request $request)
    {
        $id = $request["idc"];
        $detallesolped = detallesolped::where('id_solped',$id)->get();
        $total=0;
        $calculo = 0;
        foreach($detallesolped as $deta){
           $calculo = $deta->precio_confirmado * $deta->cantidad_confirmada;
           $total = $total + $calculo;

        }
        
        return $total;
    }

 public function solped_comprobantes(Request $request)
    {
        $id = $request["idc"];
        $detallesolped = detallesolped::where('id_solped',$id)->groupby('id_solped','nfactura')->get();
        return $detallesolped;
    }

 public function verificar_detalle(Request $request)
    {
        $id = $request["idc"];
        $idproducto = $request["idp"];
        $detallesolped = detallesolped::where('id_solped',$id)->where("id_producto",$idproducto)->first();
        //dd($idproducto);
        if($detallesolped) 
          $encontrado=1;
        else 
          $encontrado=0;        
        return $encontrado;
    }

    public function solped_factura(Request $request)
    {
        $id      = $request["ids"];
        $factura = $request["factura"];
        $detallesolped = detallesolped::where('id_solped',$id)->where("nfactura","like",$factura)->get();
      if(!$detallesolped){
               $data["status"]='No';
               $data["total"]=0;
                
      }      
      else{ 
        $total=0;
        $calculo = 0;
        $pagado=0;
        foreach($detallesolped as $deta){
          if($deta->pagado==1)
          {
            $pagado++;
          }
          else{  
           $calculo = $deta->precio_confirmado * $deta->cantidad_confirmada;
           $total = $total + $calculo;}
        }
        if($pagado>0){
         $data["status"]='Pagado';
         $data["total"]=0;

        }else{
         $data["status"]='Ok';
         $data["total"]=$total;
        }
       }

       return $data;
    }


    public function categorias_list(Request $request)
    {
        $id_categoria = $request["idc"];
        $categorias = categorias::where('id',$id_categoria)->where('proveedor',1)->first();
        if($categorias)
        $data["status"]='OK';
       else
        $data["status"]='NO';
        return $data;
    }

}
