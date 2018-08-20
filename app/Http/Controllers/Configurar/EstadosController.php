<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstadosController extends Controller
{
    public function index(){
    	return view('Configurar.Estados.index');
    }
}
