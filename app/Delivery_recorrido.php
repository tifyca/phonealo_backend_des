<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_recorrido extends Model
{
    protected $table = 'elivery_recorrido';
    protected $fillable = ['id','id_delivery','recorrido'];


}
