<?php

namespace App\Http\Controllers\api\ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clientes;
use App\Ventas;
use App\Categorias;
use App\Productos;
use App\Usuarios;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UsuariosController extends Controller
{

	private $SMS_SENDER = "Sample";
	private $RESPONSE_TYPE = 'json';
	private $SMS_USERNAME = 'Your username';
	private $SMS_PASSWORD = 'Your password';


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
			$pin   = rand(1000, 9999);
			$pass  = password_hash($request["clave"], PASSWORD_DEFAULT);

            //dd($request);
			$nuevo           = new Usuarios();
			$nuevo->pin      = $pin;
			$nuevo->name     = $name;
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
			$phone_number = $request->telefono;
			$message = "Hola, Bienvenido a Conexpar Ecommerce, Tu PIN de Validación es:".$pin;
			//$this->initiateSmsActivation($phone_number, $message);


			return ["status" => "exito", "data" => ["token" => crea_token($idusuario), "idusuario" => $idusuario, "codigo" => codifica($idusuario)]];
		} catch (Exception $e) {
			return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
		}

	}

    public function validar_pin(Request $request)
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
	  $usuario = Usuario::where('email', $email)->where('pin', $pin)->first();
	   if ($usuario) {
	      $usuario->estatus = 1;
	      $usuario->save(); 
	      $result = ["status" => "exito", "data" => ["token" => crea_token($usuario->id), "codigo" => codifica($usuario->id), "idusuario" => $usuario->id] ];
	        //$usuario->update(['estatus' => '1']);
	    return $result;
	  }  else {
	    $errors ="Excuse, PIN Incorrect";
	    $result = ["status" => "fallo", "error" => $errors];
	    return $result;
	  }
 }
 


public function initiateSmsActivation($phone_number, $message){
		$isError = 0;
		$errorMessage = true;

        //Preparing post parameters
		$postData = array(
			'username' => $this->SMS_USERNAME,
			'password' => $this->SMS_PASSWORD,
			'message' => $message,
			'sender' => $this->SMS_SENDER,
			'mobiles' => $phone_number,
			'response' => $this->RESPONSE_TYPE
		);

		$url = "http://portal.bulksmsnigeria.net/api/";

		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
		));
 //Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
		$output = curl_exec($ch);


        //Print error if any
		if (curl_errno($ch)) {
			$isError = true;
			$errorMessage = curl_error($ch);
		}
		curl_close($ch);
		if($isError){
			return array('error' => 1 , 'message' => $errorMessage);
		}else{
			return array('error' => 0 );
		}

		public function initiateSmsGuzzle($phone_number, $message)
		{
			$client = new Client();

			$response = $client->post('http://portal.bulksmsnigeria.net/api/?', [
				'verify'    =>  false,
				'form_params' => [
					'username' => $this->SMS_USERNAME,
					'password' => $this->SMS_PASSWORD,
					'message' => $message,
					'sender' => $this->SMS_SENDER,
					'mobiles' => $phone_number,
				],
			]);


			$response = json_decode($response->getBody(), true);
		}
	}
