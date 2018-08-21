<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoriasController extends Controller
{
    public function index(){
    	return view('Configurar.Subcategorias.index');
    }
    public function update(){
    	return view('Configurar.Subcategorias.edit');
    }

}
