<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productos_proveedor extends Model
{
      protected $table = 'productos_proveedor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_proveedor','id_producto','codigo','producto','id_usuarios','created_at','updated_at'];
    protected $guarded  = ['id'];
}
