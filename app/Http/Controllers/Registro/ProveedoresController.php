<?php

namespace App\Http\Controllers\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProveedoresController extends Controller
{
    public function index(){
		return view('Registro.Proveedores.index');
	}
	public function store(){
		
	}
	public function show(){
		return view('Registro.Proveedores.show');
	}
	public function update(){
		return view('Registro.Proveedores.edit');
	}
	public function edit(){
		
	}
}
