<?php

namespace App\Http\Controllers\api\ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clientes;
use App\Ventas;
use App\Categorias;
use App\Productos;
use App\Usuarios;
use DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UsuariosController extends Controller
{


	public function registrar(Request $request)
	{
		$request = json_decode($request->getContent());
		$request = get_object_vars($request);
		try {
            //Validaciones
			$errors = [];
			if (!isset($request["email"])) $errors[] = "El email es requerido";
			if (!isset($request["nombres"])) $errors[] = "Los nombres son requeridos";
			if (!isset($request["clave"])) $errors[] = "La clave es requerida";
			if (!isset($request["ruc"])) $errors[] = "El RUC es requerido";
			if (!isset($request["telefono"])) $errors[] = "El telefono es requerido";
            //Validaciones filtro de profanidad
			if (count($errors) > 0) {
				return ["status" => "fallo", "error" => $errors];
			}
            //fin validaciones
			$email    = $request["email"];
			$ruc      = $request["ruc"];
			$telefono = $request["telefono"];
			$name     = $request["nombres"];
			if (Usuarios::where('email', $email)->first()) {
				return ["status" => "fallo", "error" => ["El email ya se encuentra registrado"]];
			}
			if (Clientes::where('ruc_ci', $ruc)->first()) {
				return ["status" => "fallo", "error" => ["El ruc ya se encuentra registrado"]];
			}
			if (Clientes::where('telefono', $telefono)->first()) {
				return ["status" => "fallo", "error" => ["El telefono ya se encuentra registrado"]];
			}
			//$pin   = rand(1000, 9999);
			//pin fijo mientras se configura el envio de sms
			$pin = "1620";
			$pass  = password_hash($request["clave"], PASSWORD_DEFAULT);

            //dd($request);
			$nuevo           = new Usuarios();
			$nuevo->pin      = $pin;
			$nuevo->nombres     = $name;
			$nuevo->email    = $email;
			$nuevo->clave    = $pass;
			$nuevo->pin      = $pin;
			$nuevo->created_at     = date("Y-m-d H:i:s");
			$nuevo->updated_at     = date("Y-m-d H:i:s");            
			$nuevo->save();
			$idusuario       = $nuevo->id;
			$data= [
				"email"         => $email,
				"pin"           => $pin
			];
			$idusuario         = $nuevo->id;
			$cliente           = new Clientes();
			$cliente->email    = $email;
			$cliente->ruc_ci   = $ruc;
			$cliente->telefono = $telefono;
			$cliente->nombres  = $name;
			$cliente->id_tipo  = 1;
			$cliente->save();
              //Enviar sms a cliente
			$phone_number = $telefono;
			$message = "Hola, Bienvenido a Conexpar Ecommerce, Tu PIN de Validación es:".$pin;
			//$this->initiateSmsActivation($phone_number, $message);
			return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "idusuario" => $idusuario,"nombre" => $name]];
		} catch (Exception $e) {
			return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
		}

	}

	public function validarpin(Request $request)
	{

		$errors = [];
		if (!isset($request["email"])) $errors[] = "Email is required";
		if (!isset($request["pin"])) $errors[] = "Pin is required";
		if (count($errors) > 0) {
			$result = ["status" => "fallo", "error" => $errors];
			return $result;
		}
            //fin validaciones
		$email = $request["email"];
		$pin   = $request["pin"];
		$usuario = Usuarios::where('email', $email)->where('pin', $pin)->first();
		if ($usuario) {
			$usuario->id_estado = 1;
			$telefono = $usuario->telefono;
			$nombres  = $usuario->nombres;
			$usuario->save();
			$clientes = Clientes::where('email', $email)->where('telefono', $telefono)->first(); 

			if($clientes){
				$clientes->id_estado = 1;
				$result = ["status" => "exito", "data" => ["token" => crea_token($usuario->id), "codigo" => codifica($usuario->id), "idusuario" => $usuario->id] ];

			}else{
				$result = ["status" => "fallo", "error" => $errors];
			}
	        //$usuario->update(['estatus' => '1']);
			return $result;
		}  else {
			$errors ="Excuse, PIN Incorrect";
			$result = ["status" => "fallo", "error" => $errors];
			return $result;
		}
	}

	public function ingresar(Request $request)
	{

		try {
            //Validaciones
			$errors = [];
			if (!isset($request["email"])) $errors[] = "Email es requerido";
			if (!isset($request["clave"])) $errors[] = "Clave es requerida";
			if (count($errors) > 0) {
				return ["status" => "fallo", "error" => $errors];
			}
            //fin validaciones
			$email = $request["email"];
			$usuario = Usuarios::where('email', $email)->where('id_estado',1)->first();
			$pass    = $request->clave;

      //dd($pass);
			if ($usuario) {
				$idusuario = $usuario->id;
				$resultado= password_verify($pass, $usuario->clave);
				if ($resultado) {
					$nombres = $usuario->nombres;
					$productos=Productos::join('categorias','productos.id_categoria','=','categorias.id')->select('productos.id','productos.descripcion','productos.home','productos.precio_oferta','productos.banner_oferta','categorias.categoria','productos.precio_ideal')->where('categorias.tipo','Productos')->orderby('home','desc')->orderby('precio_oferta','desc')->get();
					return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "idusuario" => $idusuario, "codigo" => codifica($idusuario),"nombres" => $nombres,"productos"=>$productos]];
				} else {
					return ["status" => "fallo", "error" => ["Clave es incorrecta"]];
				}
			} else {
				return ["status" => "fallo", "error" => ["Usario o clave incorrecta"]];
			}
		} catch (Exception $e) {
			return ['status' => 'fallo', 'error' => ["Ha ocurrido un error"]];
		}

	}
}
