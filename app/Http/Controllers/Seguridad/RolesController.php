<?php

namespace App\Http\Controllers\Seguridad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use App\autorizacion;
use App\modulo;
use DB;
class RolesController extends Controller
{
          public function index()
	{
		$roles=Roles::orderby('id')->paginate(20);
		return view('Seguridad.roles.index')->with('roles',$roles);
	}
	public function create()
	{
		$roles=Roles::orderby('id')->get();

		return view('Seguridad.roles.create')->with("roles",$roles);
	}
	public function store(Request $request)
	{
	
		try {
			$validator = \Validator::make($request->all(), $rules);
			if ($validator->fails()){
				return back()->withErrors($validator)->withInput();
			}
			//dd($request);
			$roles               = new Roles($request->all());
			$roles->name         = $request["name"];
			$roles->email        = $request["email"];
			$roles->password     = $request["password"];
            $roles->rol_id       = $request["rol_id"];
			$roles->alto_nivel   = $request["altonivel"];
			$roles->contratados  = $request["contratados"];	
			$roles->empleados    = $request["empleados"];	
            $roles->obreros      = $request["obreros"];
            $roles->jubilados    = $request["jubilados"];		
            $roles->save();
			return redirect()->route('roles.edit', $roles->id)->with("notificacion","Se ha guardado correctamente su información");
		} catch (Exception $e) {
			\Log::info('Error creating item: '.$e);
			return \Response::json(['created' => false], 500);
		}
	}
	public function show($id)
	{
        //
	}
	public function edit($id)
	{

		$roles=Roles::find($id);
        //dd($roles);   
        $autorizacion= db::table('autorizaciones as a')->join('modulos as b','a.id_opcion','=','b.ID')  
                       ->select('a.id_opcion','b.descripcion','a.id_rol','a.autorizacion')
                       ->where('a.id_rol',$id)
                       ->orderby('a.id')->get();   
		//$autorizacion=autorizacion::where('id_rol',$id)->get();
		return view('Seguridad.roles.edit')->with('roles',$roles)->with('autorizacion',$autorizacion);
	}
	public function update(Request $request, $id)
	{
		$rules = [
			'email' => 'required|email',
		];
		try {
			$validator = \Validator::make($request->all(), $rules);
			if ($validator->fails()){
				return back()->withErrors($validator)->withInput();
			}
			$roles = Roles::find($id);
            $roles->name        = $request->name;
            $roles->rol_id      = $request->rol_id;
            $roles->alto_nivel  = $alto_nivel;
            $roles->contratados = $request->contratados;
            $roles->empleados   = $request->empleados;
            $roles->obreros     = $request->obreros;
            $roles->jubilados   = $request->jubilados;
            $roles->save();
			return redirect()->route('roles.edit', $id)->with("notificacion","Se ha guardado correctamente su información");
		} catch (Exception $e) {
			\Log::info('Error creating item: '.$e);
			return \Response::json(['created' => false], 500);
		}
	}
	public function destroy($id)
	{
		
		try{
			Roles::find($id)->delete();
			return redirect()->route('roles.index');
		} catch (\Illuminate\Database\QueryException $e) {
			return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
		}
	}
}
