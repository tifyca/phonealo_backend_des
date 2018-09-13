<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class solped extends Model
{
     protected $table = 'solped';
    protected $fillable = ['id','id_proveedor','fecha','id_estado','nro_documento'];
}
