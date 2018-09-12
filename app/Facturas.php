<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Facturas extends Model
{
	
    protected $table = 'facturas';
    protected $fillable = ['id','nombres','direccion','ruc_ci'];

}