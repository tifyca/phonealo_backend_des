<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $mes=date('m');
      
      /*$canreem =reembolso::select(DB::raw('count(cedben) as cantidad'))
              ->whereMonth('fecha',$mes)
              ->first();*/
        return view('inicio');
        
    }
}
