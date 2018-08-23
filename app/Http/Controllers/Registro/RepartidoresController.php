<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepartidoresController extends Controller
{
    public function index(){
		return view('Registro.Repartidores.index');
	}
	public function show(){
		return view('Registro.Repartidores.show');
	}
	public function update(){
		return view('Registro.Repartidores.edit');
	}
	public function pagos(){
		return view('Registro.Repartidores.pagos');
	}
	public function gastos(){
		return view('Registro.Repartidores.gastos');
	}
}
