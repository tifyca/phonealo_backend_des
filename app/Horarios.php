<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Horarios extends Model
{
	
    protected $table = 'horarios';
    protected $fillable = ['id','horario','status','status_v'];


    
    public function scopeSearch($query, $scope="")
    {

    	return $query->where('horario','LIKE', "$scope%");
    }
     public function scopeStatus($query, $scope="")
    {
    	return $query->where('status', "$scope");
    }
     public function scopeStatus_v($query, $scope="")
    {
    	return $query->where('status_v', "$scope");

    }
    public function scopeSearch2($query, $status_v="", $status="", $horario="")
    {
    	return $query->where('status_v', "$status_v")
    				 ->where('status', "$status")
    				 ->where('horario','LIKE', "$horario%");
    }
    public function scopeSearch3($query, $status="", $horario="")
    {
    	return $query->where('status', "$status")
    				 ->where('horario','LIKE', "$horario%");
    }
    public function scopeSearch4($query, $status_v="", $horario="")
    {
    	return $query->where('status_v', "$status_v")
    				 ->where('horario','LIKE', "$horario%");
    }
    public function scopeSearch5($query,  $status_v="",$status="")
    {
    	return $query->where('status_v', "$status_v")
    				 ->where('status', "$status");
    }
    

}
