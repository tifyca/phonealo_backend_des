<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleados;
class RegistroController extends Controller
{
    public function empleados_list(Request $request)
    {
       $id_rol = $request->id_rol;
       if($id_rol=='5'){
       	$empleados=Empleados::where('id_cargo','4')->where('id_estado','1')->get();
       }else{
       	 $empleados=Empleados::where('id_cargo','!=','4')->where('id_estado','1')->get();
       }
       
       return $empleados;
    }
}
