<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Fuente extends Model
{
	
    protected $table = 'fuente_financiamiento';
    protected $fillable = ['id','fuente','status'];

    public function scopeSearch($query, $scope="")
    {
    	return $query->where('fuente','like', "$scope%");
    }
     public function scopeStatus($query, $scope="")
    {
    	return $query->where('status', "$scope");
    }
   	public function scopeSearch2($query, $status="", $fuente="")
    {
    	return $query->where('fuente','like', "$fuente%")
    	    		 ->where('status', "$status");
    }

}
