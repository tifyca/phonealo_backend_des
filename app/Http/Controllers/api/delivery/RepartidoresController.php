<?php

namespace App\Http\Controllers\api\delivery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Empleados;
use App\Ventas;
use App\Detalle_Ventas;
use App\Remitos;
use App\Roles;
use App\Estados;
use App\Pedidos;
use App\detalle;
use App\Clientes;
use App\delivery_horario;
use App\Detalle_remito;
use App\User;
use App\Estados_remitos;
use App\Notas_Ventas;
use App\Delivery_recorrido;

class RepartidoresController extends Controller
{
  public function ingresar(Request $request)
  {
    $request = json_decode($request->getContent());
        //dd($request);
    $request = get_object_vars($request);
    try {
            //Validaciones
      $errors = [];
      if (!isset($request["email"])) $errors[] = "El email es requerido";
      if (!isset($request["password"])) $errors[] = "El password es requerido";
      if (count($errors) > 0) {
        return ["status" => "fallo", "error" => $errors];
      }
            //fin validaciones
      $email = $request["email"];
      $pass  = $request["password"];

      $usuario = User::where('email', $email)->first();
      if ($usuario) {
        $idusuario=$usuario->id;
        $nombre   = $usuario->name;
        if (password_verify($pass, $usuario->password)){
         if($usuario->rol_id==5){
          return ["status" => "exito", "data" => ["token" => crea_token($idusuario),"idusuario" => $usuario->id, "idempleado"=> $usuario->id_empleado, "nombre" => $nombre]];
        }else{
          return ["status" => "fallo", "error" => ["Usuario no autorizado"]];
        }

      } else {
        return ["status" => "fallo", "error" => ["Password Incorrecto"]];
      }
    } else {
      return ["status" => "fallo", "error" => ["Usuario incorrectos"]];
    }
  } catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
  }

}

public function iniciarjornada(Request $request)
{
 $request = json_decode($request->getContent());
 $request = get_object_vars($request);
 $contador = 0; 
 $total=0;
 $total_entregado = 0;
 try {
            //Validaciones
  $errors = [];
  if (!isset($request["idempleado"])) $errors[] = "El Id del Repartidor es requerido";
  if (count($errors) > 0) {
    return ["status" => "fallo", "error" => $errors];
  }
            //fin validaciones
  $idempleado = $request["idempleado"];
  $empleados = Empleados::where('id', $idempleado)->first();
  if ($empleados) {

    $pedidos= DB::table('remitos as a')
    ->join('detalle_remito as b','a.id','=','b.id_remito')
    ->join('ventas as c','b.id_venta','=','c.id')
    ->join('pedidos as d','c.id_pedido','=','d.id')
    ->join('clientes as e','d.id_cliente','=','e.id')
    ->join('horarios as f','c.id_horario','=','f.id')
    ->join('estados as g','a.id_estado','=','g.id')
//              ->select('b.id_venta','a.id_delivery','a.importe','a.id_estado','f.telefono','e.horario','g.estado')
    ->select('b.id_venta','a.id_delivery','a.importe','a.id_estado','d.id_cliente','e.telefono','f.horario','g.estado')

    ->where('a.id_delivery',$idempleado)->where('a.id_estado','6')->get();                  

    if($pedidos){
      $jornada= new delivery_horario();
      $jornada->id_delivery = $idempleado;
      $jornada->entrada = date("Y-m-d H:i:s");
      $jornada->activo = 1;
      return ["status" => "exito", "data" => ["idempleado"=> $idempleado]];
    }else{
      $jornada= new delivery_horario();
      $jornada->id_delivery = $idempleado;
      $jornada->entrada = date("Y-m-d H:i:s");
      $jornada->activo = 0;
      return ["status" => "exito", "data" => ["idempleado"=> $idempleado]];
    }
  }else{
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];  
  }
} catch (Exception $e) {
  return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
}

}

////////////////////////////////////////////////////////////////
// Endpoint de HOME de APPDelivery
//////////////////////////////////////////////////////////
public function pedidos_asignados(Request $request){

       //$request = json_decode($request->getContent());
       //$request = get_object_vars($request);
  $total = 0;
  try {
            //Validaciones
    $errors = [];
    if(isset($request["id_estado"]))
      { $id_estado=$request["id_estado"];}
    if (!isset($request["idempleado"])) $errors[] = "El Id del Repartidor es requerido";
    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
            //fin validaciones

    $idempleado = $request["idempleado"];
    $empleados = Empleados::where('id', $idempleado)->first();
    $importe=0;
    $total_entregado=0;
    $total_asignado=0;
    $total_pendiente=0;
    $total_cancelado=0;
    $promedio = 0;
    $lunes=10;
    $martes=20;
    $miercoles=30;
    $jueves=35;
    $viernes=40;
    
    if ($empleados) {

      $pedidos= DB::table('remitos as a')
      ->join('detalle_remito as b','a.id','=','b.id_remito')
      ->join('ventas as c','b.id_venta','=','c.id')
      ->join('pedidos as d','c.id_pedido','=','d.id')
      ->join('horarios as e','c.id_horario','=','e.id')
      ->join('clientes as f','d.id_cliente','=','f.id')
      ->join('estados as g','a.id_estado','=','g.id')
      ->join('estados_remitos as h','b.id_estado','=','h.id')
      ->select('b.id_venta','a.id_delivery','a.importe','b.id_estado','f.telefono','e.horario','h.descripcion as estadoremito','g.estado')
      ->where('a.id_delivery',$idempleado)->where('a.id_estado','6')->get();                  
      if($pedidos){
     $grafica[]=[
            "lunes"=>$lunes,
            "martes"=>$martes,
            "miercoles"=>$miercoles,
            "jueves"=>$jueves,
            "viernes"=>$viernes 
          ];
        $data1=[];

        foreach($pedidos as $ped){
          $data1[]=[
          "id_venta"    => $ped->id_venta,
          "id_empleado" => $ped->id_delivery,
          "telefono"    => $ped->telefono,
          "horario"     => $ped->horario,
          "id_estado"   => $ped->id_estado,
          "estado"      => $ped->estadoremito];
          
          $total++;
          $total_asignado    = $total_asignado + $ped->importe;
          if($ped->id_estado=='1') $total_pendiente = $total_entregado + $ped->importe;
          if($ped->id_estado=='2') $total_entregado    = $total_entregado + $ped->importe;
          if($ped->id_estado=='3') $total_pendiente = $total_entregado + $ped->importe;
          if($ped->id_estado=='4') $total_cancelado = $total_cancelado + $ped->importe;
          }

         $data[]=[
          "pedidos" =>$data1,
          "grafica" =>$grafica,
          "total_entregado" =>$total_entregado,
          "total_asignado" => $total_asignado,
          "total_cancelado" =>$total_cancelado,
          "total_pendiente" =>$total_pendiente
         ];
        return ["status" => "exito", "data" => $data];                
      }else{
        return ["status" => "exito", "data" => ["idempleado"=> $idempleado]];
      }
    }else{
      return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];  
    }
  } catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
  }



}


public function detalle_venta(Request $request){
        //$request = json_decode($request->getContent());
        //$request = get_object_vars($request);
  try {
            //Validaciones
    $errors = [];
    if (!isset($request["idventa"])) $errors[] = "El Id de Venta es requerido";
    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
            //fin validaciones
    $idventa = $request["idventa"];

$pedidos = Ventas::join('pedidos as d','ventas.id_pedido','=','d.id')
                    ->join('detalle_ventas as j','ventas.id','=','j.id_venta')
                    ->join('productos as k','j.id_producto','=','k.id')
                    ->select('ventas.id','k.codigo_producto','k.descripcion','j.cantidad','j.precio')
                    ->where('ventas.id',$idventa)->get();                  

$maestro = Ventas::join('pedidos as d','ventas.id_pedido','=','d.id')
          ->join('horarios as e','ventas.id_horario','=','e.id')
          ->join('clientes as f','d.id_cliente','=','f.id')
          ->join('estados as g','ventas.id_estado','=','g.id')
          ->join('users','ventas.id_usuario','=','users.id')
          ->select('ventas.id','f.telefono','f.direccion','users.name','ventas.notas')
           ->where('ventas.id',$idventa)->get();                  

    if($pedidos){
      
      $data=[];
      $cantidad=0;
      $detallev=[];
      $cantidad=0;
      foreach($pedidos as $ped){
        $detallev[]=["codigo_producto" => $ped->codigo_producto,
        "descripcion"  => $ped->descripcion,
        "cantidad" => $ped->cantidad,
        "precio"  => $ped->precio,
        "importe"    => $ped->cantidad * $ped->precio];
      }

      foreach($maestro as $ped){
        $data[]=[
        "id_venta"  => $ped->id,
        "telefono"  => $ped->telefono,
        "direccion" => $ped->direccion,
        "vendedor"  => $ped->name,
        "observaciones" => $ped->notas];
      }
      $data1[]=[
        "venta" => $data,
        "detalle" => $detallev
      ];
      return ["status" => "exito", "data" => $data1];                
    }else{
      return ["status" => "exito", "data" => ["idempleado"=> $idempleado]];
    }
  } catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
  }
}

public function marca_entrega(Request $request){
  try {
            //Validaciones
    $errors = [];
    if (!isset($request["idventa"])) $errors[] = "El Id de Venta es requerido";
    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
    $idventa=$request["idventa"];
    $detalle_remito=Detalle_remito::where('id_venta',$idventa)->first();
    if($detalle_remito){
      $detalle_remito->id_estado = 2;
      $detalle_remito->save();
      $ventas=Ventas::where('id',$idventa)->first();
      if($ventas){
        $ventas->id_estado=8;
        $ventas->save();
        return ["status" => "Exito","mensaje"=>"Pedido Entregado"];
      }
    }else{
      return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
    }
  } catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
  }      

}

public function observaciones(Request $request){
  try {
            //Validaciones
    $errors = [];
    if (!isset($request["idventa"])) $errors[] = "El Id de Venta es requerido";
    if (!isset($request["idempleado"])) $errors[] = "El Id de Delivery es requerido";
    if (!isset($request["observaciones"])) $errors[] = "observaciones requeridas";
    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
    $idventa       = $request["idventa"];
    $idempleado    = $request["idempleado"];
    $observaciones = $request["observaciones"];
    $Notas_Ventas  = new Notas_Ventas();
    $Notas_Ventas->id_usuario = $idempleado;
    $Notas_Ventas->id_venta   = $idventa;
    $Notas_Ventas->nota       = $observaciones;
    $Notas_Ventas->save();
    if($Notas_Ventas){
      return ["status" => "exito"];
    }else{
      return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
    }
  } catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
  }      

}

public function pedido_noentregado(Request $request){
  try {
            //Validaciones
    $errors = [];
    if (!isset($request["idventa"])) $errors[] = "El Id de Venta es requerido";
    if (!isset($request["idempleado"])) $errors[] = "El Id de Delivery es requerido";
    if (!isset($request["observaciones"])) $errors[] = "observaciones requeridas";

            if (isset($request["imagen"])) {
                $imagen = $request["imagen"];
                if ($imagen <> '') {
                    list($tipo, $Base64Img) = explode(';', $foto);
                    $extensio = $tipo == 'data:image/png' ? '.png' : '.jpg';
                    $request["imagen"] = (string)(date("YmdHis")) . (string)(rand(1, 9)) . $extensio;
                    //list(, $Base64Img) = explode(',', $Base64Img);
                    //$image = base64_decode($Base64Img);
                    $filepath = 'delivery/' . $request["imagen"];
                    $s3 = S3Client::factory(config('app.s3'));
                    $result = $s3->putObject(array(
                        'Bucket' => config('app.s3_bucket'),
                        'Key' => $filepath,
                        'SourceFile' => $foto,
                        'ContentType' => 'image',
                        'ACL' => 'public-read',
                    ));
                }
            }



    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
    $idventa       = $request["idventa"];
    $idempleado    = $request["idempleado"];
    $observaciones = $request["observaciones"];
    $Notas_Ventas  = new Notas_Ventas();
    $Notas_Ventas->id_usuario = $idempleado;
    $Notas_Ventas->id_venta   = $idventa;
    $Notas_Ventas->nota       = $observaciones;
    $Notas_Ventas->save();
    if($Notas_Ventas){
      return ["status" => "exito"];
    }else{
      return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
    }
  } catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
  }      

}


public function recorrido(Request $request){
 $request = json_decode($request->getContent());
 $request = get_object_vars($request);
 try {
            //Validaciones
  $errors = [];
  if (!isset($request["idempleado"])) $errors[] = "El Id del Repartidor es requerido";
  if (!isset($request["recorrido"])) $errors[] = "El Recorrido es requerido";
  if (count($errors) > 0) {
    return ["status" => "fallo", "error" => $errors];
  }
            //fin validaciones
      $idempleado=$request["idempleado"];
      $recorrido=$request["recorrido"];
      $delivery_recorrido= new Delivery_Recorrido();
      $delivery_recorrido->id_delivery = $idempleado;
      $delivery_recorrido->recorrido  = $recorrido;
      $delivery_recorrido->fecha = date("Y-m-d H:i:s");
      $delivery_recorrido->created_at = date("Y-m-d H:i:s");
      $delivery_recorrido->updated_at = date("Y-m-d H:i:s");
      $delivery_recorrido->save();
      return ["status" => "exito", "data" => ["idempleado"=> $idempleado]];
   }
  
 catch (Exception $e) {
  return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
}
   


}

public function cerrar_jornada(Request $request){
 try {
            //Validaciones
    $errors = [];
    if (!isset($request["idempleado"])) $errors[] = "El Id de Repartidor es requerido";
    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
    $remitos=Remitos::join('detalle_remito as b','remitos.id','=','b.id_remito')->where('id_estado',1)->where('remitos.id_delivery',$idempleado)->get();
    if($remitos){
      $errors[]="Tiene Pedidos Pendientes, No se puede cerrar la Jornada";
     return ["status" => "fallo", "error" => $errors]; 
    }else{
      $jornada=delivery_horario::where('id_delivery',$id_empleado)->where('activo',1)->first();
      if($jornada){
        $jornada->salida=date("Y-m-d H:i:s");
        $jornada->activo = 0;
        $jornada->save();
        return ["status" => "exito", "data" => ["Mensaje"=> "Jornada Cerrada"]];
      }else{
      $errors[]="Ha ocurrido un error de validación de datos";
       return ["status" => "fallo", "error" => $errors];    
      }
    }


}catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
  }    
}

public function cancelar(Request $request){
  try {
            //Validaciones
    $errors = [];
    if (!isset($request["idventa"])) $errors[] = "El Id de Venta es requerido";
    if (!isset($request["informe"])) $errors[] = "El Informe es requerido";
    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
    $idventa=$request["idventa"];
    $informe=$request["informe"];
    $detalle_remito=Detalle_remito::where('id_venta',$idventa)->first();
    if($detalle_remito){
      $detalle_remito->id_estado = 3;
      $detalle_remito->observaciones=$informe;
      $detalle_remito->save();
      $ventas=Ventas::where('id',$idventa)->first();
      if($ventas){
        $ventas->id_estado=8;
        $ventas->save();
        return ["status" => "Exito","mensaje"=>"Pedido Cancelado"];
      }
    }else{
      return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
    }
  } catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
  }      


}
public function recordinado(Request $request){
if (!isset($request["idventa"])) $errors[] = "El Id de Venta es requerido"; 

}

public function solucionar(Request $request){

}

}
