<?php

namespace App\Http\Controllers\Seguridad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\auditoria;

class AuditoriaController extends Controller
{
    public function index(Request $request)
    {
    	$auditoria= auditoria::orderby('fecha','desc')->paginate(20);
    	return view('Seguridad.auditoria.index')->with('auditoria',$auditoria);
    }
    
}
