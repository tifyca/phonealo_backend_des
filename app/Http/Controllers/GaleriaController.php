<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    public function index(){
		return view('Galeria.index');
	}
	public function new(){
		return view('Galeria.new');
	}
	public function update(){
		return view('Galeria.edit');
	}
}
