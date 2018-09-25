<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Estados extends Model
{
	
    protected $table = 'estados';
    protected $fillable = ['id','estado'];


    public function scopeSearch($query, $scope="")
    {
    	return $query->where('estado','like', "$scope%");
    }
}