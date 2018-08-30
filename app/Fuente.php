<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Fuente extends Model
{
	
    protected $table = 'fuente_financiamiento';
    protected $fillable = ['id','fuente','status'];

}
