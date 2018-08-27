<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpleadosController extends Controller
{
    public function index(){
    	return view('Registro.Empleados.index');
    }
    public function show(){
    	return view('Registro.Empleados.show');
    }
    public function update(){
    	return view('Registro.Empleados.edit');
    }
}
