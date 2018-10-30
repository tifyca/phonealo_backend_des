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
                $data=[];
                foreach($pedidos as $ped){
                  $data["id_venta"]    = $ped->id_venta;
                  $data["id_empleado"] = $ped->id_delivery;
                  $data["telefono"]    = $ped->telefono;
                  $data["horario"]     = $ped->horario;
                  $data["id_estado"]   = $ped->id_estado;
                  $data["estado"]      = $ped->estado;
                  $total++;
                  $total_entregado    = $total_entregado + $ped->importe;
                }
                return ["status" => "exito", "data" => $data, "total_asignados" => $total, "total_entregado" => $total_entregado];                
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
    
    public function pedidos_asignados(Request $request){
    
       //$request = json_decode($request->getContent());
       //$request = get_object_vars($request);
        $total = 0;
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
            $importe=0;
            $total_entregado=0;
            $promedio = 0;
            if ($empleados) {
              $pedidos= DB::table('remitos as a')
              ->join('detalle_remito as b','a.id','=','b.id_remito')
              ->join('ventas as c','b.id_venta','=','c.id')
              ->join('pedidos as d','c.id_pedido','=','d.id')
              ->join('horarios as e','c.id_horario','=','e.id')
              ->join('clientes as f','d.id_cliente','=','f.id')
              ->join('estados as g','a.id_estado','=','g.id')
              ->select('b.id_venta','a.id_delivery','a.importe','a.id_estado','f.telefono','e.horario','g.estado')
              ->where('a.id_delivery',$idempleado)->where('a.id_estado','6')->get();                  
             if($pedidos){
               
                $data=[];
                
                foreach($pedidos as $ped){
                  $data["id_venta"]    = $ped->id_venta;
                  $data["id_empleado"] = $ped->id_delivery;
                  $data["telefono"]    = $ped->telefono;
                  $data["horario"]     = $ped->horario;
                  $data["id_estado"]   = $ped->id_estado;
                  $data["estado"]      = $ped->estado;
                  $total++;
                  $total_entregado    = $total_entregado + $ped->importe;
                }
                return ["status" => "exito", "data" => $data,"total_asignados" => $total,"total_entregado"=>$total_entregado, "promedio"=>$promedio];                
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
    
    public function total_asignados(Request $request){

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
              $pedidos= DB::table('ventas as c')
              ->join('pedidos as d','c.id_pedido','=','d.id')
              ->join('horarios as e','c.id_horario','=','e.id')
              ->join('clientes as f','d.id_cliente','=','f.id')
              ->join('estados as g','c.id_estado','=','g.estado')
              ->join('users as h','c.id_usuario','=','h.id')
              ->join('detalle_ventas as j','c.id','=','j.id_venta')
              ->join('productos as k','j.id_producto','=','k.id')
              ->select('c.id','f.telefono','f.direccion','h.name','c.notas','k.descripcion','j.cantidad','j.precio')
              ->where('c.id',$idventa)->where('c.id_estado','6')->get();                  
             if($pedidos){
                $data=[];
                $cantidad=0;
                foreach($pedidos as $ped){
                  $data["id_venta"]  = $ped->id;
                  $data["telefono"]  = $ped->telefono;
                  $data["direccion"] = $ped->direccion;
                  $data["vendedor"]  = $ped->name;
                  $data["producto"]  = $ped->descripcion;
                  $data["cantidad"]  = $ped->cantidad;
                  $data["precio"]    = $ped->precio;
                  $data["observaciones"]    = $ped->notas;
                  $cantidad++;
                }
                return ["status" => "exito", "data" => $data, "total" => $cantidad];                
             }else{
                return ["status" => "exito", "data" => ["idempleado"=> $idempleado]];
             }
        } catch (Exception $e) {
            return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }

    public function marca_entrega(Request $request){

    }

    public function observaciones(Request $request){

    }

}
