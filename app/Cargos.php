<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cargos extends Model
{
	
    protected $table = 'cargos';
    protected $fillable = ['id','cargo','status'];

     public function scopeSearch($query, $scope="")
    {
    	return $query->where('cargo','like', "$scope%");
    }
     public function scopeStatus($query, $scope="")
    {
    	return $query->where('status', "$scope");
    }
    public function scopeAmbos($query, $scope="",$scope2="" )
    {
    	return $query->where('cargo','like', "$scope%")
    				 ->where('status', "$scope2");
    }



}
