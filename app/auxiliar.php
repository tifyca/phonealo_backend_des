<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class auxiliar extends Model
{
    protected $table = 'auxiliar';
    protected $fillable = ['documento','codigo','descripcion','precio','cantidad','id_proveedor'];
}
