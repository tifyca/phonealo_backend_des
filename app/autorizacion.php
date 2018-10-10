<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class autorizacion extends Model
{
   protected $table = 'autorizaciones';
    protected $fillable = ['id','descripcion'];
}
