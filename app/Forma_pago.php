<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forma_pago extends Model
{

    protected $table = 'forma_pago';
    protected $fillable = ['id','forma_pago','status','id_usuario'];

     public function scopeSearch($query, $scope="")
    {
    	return $query->where('forma_pago','like', "$scope%");
    }
     public function scopeStatus($query, $scope="")
    {
    	return $query->where('status', "$scope");
    }
    public function scopeAmbos($query, $scope="",$scope2="" )
    {
    	return $query->where('forma_pago','like', "$scope%")
    		         ->where('status', "$scope2");
    }

}
