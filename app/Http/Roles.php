<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','descripcion'];
    protected $guarded  = ['id'];
}
