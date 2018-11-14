<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoreos extends Model
{
       protected $table = 'monitoreo';
       protected $fillable = ['id','nombre','fecha', 'id_usuario'];

}