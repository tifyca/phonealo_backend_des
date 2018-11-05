<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
      protected $table = 'usuarios_ecommerce';
    protected $fillable = ['id','email','nombres','pin','telefono','created_at','updated_at','estado'];


   
}
