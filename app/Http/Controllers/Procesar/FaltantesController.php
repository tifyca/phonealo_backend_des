<?php

namespace App\Http\Controllers\Procesar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaltantesController extends Controller
{
    public function index(Request $request){
       return view("Procesar.Faltantes.index"); 
    }
    public function show($id){

    }
    public function store(Request $request){

    }
    public function edit($id){

    }
    public function update(Request $request, $id){

    }
}


// Probando