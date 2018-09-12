<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Horarios extends Model
{
	
    protected $table = 'horarios';
    protected $fillable = ['id','horario','status','status_v'];

}
