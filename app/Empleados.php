<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Empleados extends Model
{
	
    protected $table = 'empleados';
    protected $fillable = [	'id', 'id_cargo', 'usuario',  'ci', 'clave', 'nombres',  'direccion', 'email', 'telefono', 'id_estado', 'id_usuario'];

    public function scopeSearch($query, $scope="")
    {
    	return $query->where('nombres','like', "$scope%");
    }
     public function scopeEmail($query, $scope="")
    {
    	return $query->where('email','like', "$scope%");
    }
     public function scopeStatus($query, $scope="")
    {
    	return $query->where('id_estado', "$scope");
    }
     public function scopeSearch2($query, $empleado="", $estatus="")
    {
    	return $query->where('nombres','like', "$empleado%")
    				 ->where('id_estado', "$estatus");
    }
     public function scopeSearch3($query, $empleado="", $email="")
    {
    	return $query->where('nombres','like', "$empleado%")
    				 ->where('email','like', "$email%");
    }
     public function scopeSearch4($query, $empleado="", $email="", $status="")
    {
    	return $query->where('nombres','like', "$empleado%")
    				 ->where('email','like', "$email%")
    				 ->where('id_estado', "$status");
    }
     public function scopeSearch5($query,  $email="", $status="")
    {
    	return $query->where('email','like', "$email%")
    				 ->where('id_estado', "$status");
    }

}
