<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Categorias extends Model
{
	
    protected $table = 'categorias';
    protected $fillable = ['id','categoria','tipo', 'status' ];

    public function scopeSearch($query, $scope="")
    {
    	return $query->where('categoria','like', "$scope%");
    }
     public function scopeStatus($query, $scope="")
    {
    	return $query->where('status', "$scope");
    }
     public function scopeTipo($query, $scope="")
    {
    	return $query->where('tipo', "$scope");
    }
     public function scopeProveedor($query, $scope="")
    {
    	return $query->where('proveedor', "$scope");
    }
   	public function scopeSearch2($query, $tipo="", $status="", $proveedor="", $categoria="")
    {
    	return $query->where('categoria','like', "$categoria%")
    				->where('status', "$status")
    				->where('tipo', "$tipo")
    				->where('proveedor', "$proveedor");
    }
    public function scopeSearch3($query, $status="", $categoria="" )
    {
    	return $query->where('categoria','like', "$categoria%")
    				->where('status', "$status");
    }
    public function scopeSearch4($query, $tipo="", $categoria="")
    {
    	return $query->where('categoria','like', "$categoria%")
    				 ->where('tipo', "$tipo");
    }
    public function scopeSearch5($query,  $tipo="", $status="")
    {
    	return $query->where('status', "$status")
    				->where('tipo', "$tipo");
    }
    public function scopeSearch6($query, $proveedor="", $categoria="")
    {
    	return $query->where('categoria','like', "$categoria%")
    				 ->where('proveedor', "$proveedor");
    }
    public function scopeSearch7($query, $tipo="", $status="", $categoria="")
    {
    	return $query->where('categoria','like', "$categoria%")
    				->where('status', "$status")
    				->where('tipo', "$tipo");
    }
    public function scopeSearch8($query, $status="", $proveedor="")
    {
    	return $query->where('status', "$status")
    				->where('proveedor', "$proveedor");
    }
    public function scopeSearch9($query, $tipo="", $proveedor="", $categoria="")
    {
    	return $query->where('categoria','like', "$categoria%")
    				->where('tipo', "$tipo")
    				->where('proveedor', "$proveedor");
    }
    public function scopeSearch10($query, $status="", $proveedor="", $categoria="")
    {
    	return $query->where('categoria','like', "$categoria%")
    				->where('status', "$status")
    				->where('proveedor', "$proveedor");
    }
    public function scopeSearch11($query, $tipo="", $proveedor="")
    {
    	return $query->where('tipo', "$tipo")
    				->where('proveedor', "$proveedor");
    }
    public function scopeSearch12($query, $tipo="", $status="", $proveedor="")
    {
    	return $query->where('status', "$status")
    				->where('tipo', "$tipo")
    				->where('proveedor', "$proveedor");
    }
}
