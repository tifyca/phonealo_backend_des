<?php

namespace App\Http\Controllers\ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
use App\User;
@session_start();

class sliderController extends Controller
{
    public function index()
    {
      return view('ecommerce.slider.index');
    }
    public function create()
    {
      return view('ecommerce.slider.create');
    }
    public function edit($id){
        return view('ecommerce.slider.edit');
    }
     public function destroy($id)
    {

    }
    public function show($id)
    {

    }
    public function store(Request $request)
    {

    }

    public function update(Request $request,$id){

    }
}
