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
                ->select('clientes.id', 'nombres','telefono', 'telefono2','direccion','email', 'barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion', 'clientes.id_estado')
                ->where('nombres','like', "$scope%");
    }
     public function scopeEmail($query, $scope="")
    {
    	return $query->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                     ->select('clientes.id', 'nombres','telefono', 'telefono2','direccion', 'email','barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion', 'clientes.id_estado')
                     ->where('email','like', "$scope%");
    }
    public function scopeStatus($query, $scope="")
    {
        return $query->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                     ->select('clientes.id', 'nombres','telefono', 'telefono2','direccion', 'email','barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion', 'clientes.id_estado')
                     ->where('clientes.id_estado', "$scope");
    }
     public function scopeSearch2($query, $cliente="", $email="", $status="")
    {
    	return $query->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                     ->select('clientes.id', 'nombres','telefono', 'telefono2','direccion', 'email','barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion', 'clientes.id_estado')
                     ->where('nombres','like', "$cliente%")
                     ->where('email','like', "$email%")
                     ->where('clientes.id_estado', "$status");
    }
     public function scopeSearch3($query, $cliente="",  $status="")
    {
        return $query->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                     ->select('clientes.id', 'nombres','telefono', 'telefono2','direccion', 'email','barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion', 'clientes.id_estado')
                     ->where('nombres','like', "$cliente%")
                     ->where('clientes.id_estado', "$status");
    }
     public function scopeSearch4($query,  $email="", $status="")
    {
        return $query->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                     ->select('clientes.id', 'nombres','telefono', 'telefono2','direccion', 'email','barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion', 'clientes.id_estado')
                     ->where('email','like', "$email%")
                     ->where('clientes.id_estado', "$status");
    }
     public function scopeSearch5($query, $cliente="", $email="")
    {
        return $query->join('ciudades', 'clientes.id_ciudad', '=', 'ciudades.id')
                     ->select('clientes.id', 'nombres','telefono', 'telefono2', 'direccion', 'email','barrio', 'clientes.id_ciudad', 'ciudades.ciudad', 'ubicacion', 'clientes.id_estado')
                     ->where('nombres','like', "$cliente%")
                     ->where('email','like', "$email%");
    }
   


}
