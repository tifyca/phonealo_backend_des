<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriasController extends Controller
{
    public function index(){
    	return view('Configurar.Categorias.index');
    }
    public function update(){
    	return view('Configurar.Categorias.edit');
    }
}
