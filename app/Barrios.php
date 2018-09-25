<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barrios extends Model
{
   protected $table = 'barrios';
    protected $fillable = ['id','barrio','lat', 'lon'];

    public function scopeSearch($query, $scope="")
    {
    	return $query->join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                     ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                     ->where('barrio','LIKE', "$scope%")
                     ->Select('barrios.id', 'barrios.id_ciudad', 'barrio', 'departamentos.nombre','ciudades.ciudad','lat', 'lon', 'barrios.id_usuario');
    	
    }
     public function scopeDpto($query, $scope="")
    {
    	return $query->join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                     ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                     ->where('ciudades.id_departamento', "$scope")
                     ->Select('barrios.id', 'barrios.id_ciudad', 'barrio', 'departamentos.nombre','ciudades.ciudad','lat', 'lon', 'barrios.id_usuario');
                                
    
    }
    public function scopeCiudad($query, $scope="")
    {
    	return $query->join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                     ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                     ->where('id_ciudad', "$scope")
                     ->Select('barrios.id', 'id_ciudad', 'barrio', 'departamentos.nombre','ciudades.ciudad','lat', 'lon', 'barrios.id_usuario');
    }
   	public function scopeSearch2($query, $barrio="", $id_departamento="", $id_ciudad="")
    {
    	return $query->join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                     ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                     ->where('id_ciudad', "$id_ciudad")
                     ->where('ciudades.id_departamento', "$id_departamento")
                     ->where('barrio','LIKE', "$barrio%")
                     ->Select('barrios.id', 'barrios.id_ciudad', 'barrio', 'departamentos.nombre','ciudades.ciudad','lat', 'lon', 'barrios.id_usuario');

    }
    public function scopeSearch3($query, $barrio="", $id_departamento="")
    {
    	return $query->join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                     ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                     ->where('ciudades.id_departamento', "$id_departamento")
                     ->where('barrio','LIKE', "$barrio%")
                     ->Select('barrios.id', 'barrios.id_ciudad', 'barrio', 'departamentos.nombre','ciudades.ciudad','lat', 'lon', 'barrios.id_usuario');

    }
    public function scopeSearch4($query, $barrio="",  $id_ciudad="")
    {
    	return $query->join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                     ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                     ->where('id_ciudad', "$id_ciudad")
                     ->where('barrio','LIKE', "$barrio%")
                     ->Select('barrios.id', 'barrios.id_ciudad', 'barrio', 'departamentos.nombre','ciudades.ciudad','lat', 'lon', 'barrios.id_usuario');

    }
      	public function scopeSearch5($query, $id_departamento="", $id_ciudad="")
    {
    	return $query->join('ciudades', 'barrios.id_ciudad', '=', 'ciudades.id')
                     ->join('departamentos','departamentos.id', '=', 'ciudades.id_departamento' )
                     ->where('id_ciudad', "$id_ciudad")
                     ->where('ciudades.id_departamento', "$id_departamento")
                     ->Select('barrios.id', 'barrios.id_ciudad', 'barrio', 'departamentos.nombre','ciudades.ciudad','lat', 'lon', 'barrios.id_usuario');

    }

}
