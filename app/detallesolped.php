<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detallesolped extends Model
{
    protected $table = 'detalle_solped';
    protected $fillable = ['id','id_solped','id_producto','precio','cantidad'];
}
