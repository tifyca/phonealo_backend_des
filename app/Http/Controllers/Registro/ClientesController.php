<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientesController extends Controller
{
	public function index(){
		return view('Registro.Clientes.index');
	}
	public function store(){
		
	}
	public function show(){
		return view('Registro.Clientes.show');
	}
	public function update(){
		return view('Registro.Clientes.edit');
	}
	public function edit(){
		
	}
    
}
