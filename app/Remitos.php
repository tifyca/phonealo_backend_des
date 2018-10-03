<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remitos extends Model
{
    //jgonzalez
    protected $table = 'remitos';
    protected $fillable = ['id_delivery','importe','fecha','id_estado','id_usuario'];
}
