<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\User;
use App\Empleados;
use App\Ventas;
use App\Detalle_Ventas;
use App\Remitos;
use App\Roles;
use App\Estados;
use App\Pedidos;
use App\detalle;
use App\Clientes;
use App\Detalle_remito;

class RepartidoresController extends Controller
{
    public function ingresar(Request $request)
    {
          try {
            //Validaciones
    $errors = [];
    if (!isset($request["usuario"])) $errors[] = "Usuario es requerido";
    if (!isset($request["contrasena"])) $errors[] = "Contraseña es requerida";
    if (count($errors) > 0) {
      return ["status" => "fallo", "error" => $errors];
    }
            //fin validaciones
    $usuario    = $request["usuario"];
    $repartidor = User::where('email', $usuario)->where('rol_id',5)->where('id_estado',1)->first();
    if(!$repartidor)
    {
        return ["status" => "fallo", "error" => ["Usuario no Activo"]]; 
    }else{

	    $pass    = $request->password;

	      $idusuario = $repartidor->id;
	      $resultado= password_verify($pass, $repartidor->password);
	      if ($resultado) {
	        return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "idusuario" => $idusuario, "codigo" => codifica($idusuario)]];
	      } else {
	        return ["status" => "fallo", "error" => ["Contraseña Incorrecta"]];
	      }
   }
  } catch (Exception $e) {
    return ['status' => 'fallo', 'error' => ["Ha ocurrido un Error"]];
  }

    }
    
    public function iniciar_jornada(Request as $request)
    {
      
    }
    
    public function pedidos_asignados(Request $request){
      $id_repartidor = $request->id_repartidor;  
      $remitos=Remitos::where('id_delivery',$id_repartidor)->get();
    }
    
    public function total_asignados(Request $request){

    }

    public function detalle_venta(Request $request){

    }

    public function marca_entrega(Request $request){

    }

    public function observaciones(Request $request){

    }

}
