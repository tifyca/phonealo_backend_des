<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Clientes extends Model
{
	
    protected $table = 'clientes';
    protected $fillable = ['id','nombres','telefonos','direccion'];

     public function scopeSearch($query, $scope="")
    {
    	return $query->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                ->select('clientes.id', 'nombres','telefono','direccion','email', 'barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion')->where('nombres','like', "$scope%");
    }
     public function scopeEmail($query, $scope="")
    {
    	return $query->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                     ->select('clientes.id', 'nombres','telefono','direccion', 'email','barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion')->where('email','like', "$scope%");
    }
     public function scopeSearch2($query, $cliente="", $email="")
    {
    	return $query->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                     ->select('clientes.id', 'nombres','telefono','direccion', 'email','barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion')
                     ->where('nombres','like', "$cliente%")
                     ->where('email','like', "$email%");
    }
   


}
