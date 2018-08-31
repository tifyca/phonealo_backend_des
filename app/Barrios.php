<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barrios extends Model
{
   protected $table = 'barrios';
    protected $fillable = ['id','barrio','lat', 'lon'];

}
