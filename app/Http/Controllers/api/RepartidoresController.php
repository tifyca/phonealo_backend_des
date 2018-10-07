<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\User;
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
}
