<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
     protected $table = 'paises';
    protected $fillable = ['id','nombre'];


    public function scopeSearch($query, $scope="")
    {
    	return $query->where('nombre','like', "$scope%");
    }
}
