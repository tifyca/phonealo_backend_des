<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Forma_pago extends Model
{
	
    protected $table = 'forma_pago';
    protected $fillable = ['id','forma_pago','status','id_usuario'];

}