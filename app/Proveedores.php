<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Proveedores extends Model
{
	
    protected $table = 'proveedores';
    protected $fillable = [	'id', 'nombres', 'ruc', 'id_pais', 'direccion', 'email', 'telefono', 'id_estado', 'id_usuario'];


    public function scopeSearch($query, $scope="")
    {
    	return $query->join('paises', 'proveedores.id_pais', '=', 'paises.id')
        			 ->select( 'proveedores.id', 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono', 'telefono2','proveedores.id_estado')
        			 ->where('proveedores.nombres','like',"$scope%");
    
    }
     public function scopeEmail($query, $scope="")
    {
    	return $query->join('paises', 'proveedores.id_pais', '=', 'paises.id')
                ->select( 'proveedores.id', 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono', 'telefono2', 'proveedores.id_estado')
                ->where('email','like',"$scope%");
    	
    }
     public function scopeStatus($query, $scope="")
    {
    	return $query->join('paises', 'proveedores.id_pais', '=', 'paises.id')
                ->select( 'proveedores.id', 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono', 'telefono2', 'proveedores.id_estado')
                ->where('id_estado',"$scope");
    
    }
     public function scopeSearch2($query, $scope="", $estatus="")
    {
    	return $query->join('paises', 'proveedores.id_pais', '=', 'paises.id')
                     ->select( 'proveedores.id', 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono', 'telefono2', 'proveedores.id_estado')
      				 ->where('proveedores.nombres','like',"$scope%")
      				 ->where('id_estado',"$estatus");
    }
     public function scopeSearch3($query, $scope="", $email="")
    {
    	return $query->join('paises', 'proveedores.id_pais', '=', 'paises.id')
                     ->select( 'proveedores.id', 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono', 'telefono2', 'proveedores.id_estado')
                     ->where('proveedores.nombres','like',"$scope%")
                     ->where('email','like', "$email%");
    				
    }
     public function scopeSearch4($query, $scope="", $email="", $status="")
    {
    	return $query->join('paises', 'proveedores.id_pais', '=', 'paises.id')
                     ->select( 'proveedores.id', 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono',  'telefono2', 'proveedores.id_estado')
                     ->where('proveedores.nombres','like',"$scope%")
                     ->where('email','like', "$email%")
    				 ->where('id_estado', "$status");
    }
     public function scopeSearch5($query,  $email="", $status="")
    {
    	return $query->join('paises', 'proveedores.id_pais', '=', 'paises.id')
                     ->select( 'proveedores.id', 'paises.nombre as pais', 'proveedores.nombres as proveedor','ruc', 'proveedores.id_pais', 'direccion', 'email', 'telefono', 'telefono2', 'proveedores.id_estado')
                     ->where('email','like', "$email%")
    				 ->where('id_estado', "$status");
    }

}
