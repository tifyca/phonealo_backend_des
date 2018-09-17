<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
     protected $table = 'departamentos';
    protected $fillable = ['id','nombre'];


    public function scopeSearch($query, $scope="")
    {
    	return $query->where('nombre','like', "$scope%");
    }

}
