<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados_remitos extends Model
{
     protected $table = 'estados_remitos';
    protected $fillable = ['id','descripcion'];


    public function scopeSearch($query, $scope="")
    {
    	return $query->where('estado','like', "$scope%");
    }
}
