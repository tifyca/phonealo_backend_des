<?php

namespace App\Http\Controllers\Configurar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoClienteController extends Controller
{
    public function index(){
    	return view('Configurar.TipoCliente.index');
    }
}
