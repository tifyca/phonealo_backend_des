<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modulo extends Model
{
    protected $table = 'modulos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','descripcion'];
    protected $guarded  = ['id'];

}
