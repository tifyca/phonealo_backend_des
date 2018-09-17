<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    protected $table = 'ciudades';
    protected $fillable = ['id','ciudad','id_departamento'];

    public function scopeSearch($query, $scope="")
    {
    	return $query->join('departamentos', 'departamentos.id', '=', 'ciudades.id_departamento')
                                ->select('id_departamento', 'departamentos.nombre', 'ciudades.id', 'ciudad', 'status','ciudades.id_usuario')
                                ->where('ciudad','LIKE', "$scope%");
    	
    }
     public function scopeDpto($query, $scope="")
    {
    	return $query->join('departamentos', 'departamentos.id', '=', 'ciudades.id_departamento')
                                ->select('id_departamento', 'departamentos.nombre', 'ciudades.id', 'ciudad', 'status', 'ciudades.id_usuario')
                                ->where('id_departamento', "$scope");
    
    }
   	public function scopeSearch2($query, $ciudad="", $id_departamento="")
    {
    	return $query->join('departamentos', 'departamentos.id', '=', 'ciudades.id_departamento')
                                ->select('id_departamento', 'departamentos.nombre', 'ciudades.id', 'ciudad', 'status','ciudades.id_usuario')
                                ->where('ciudad','LIKE', "$ciudad%")
                                ->where('id_departamento', "$id_departamento");

    }
}
