<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remisa extends Model
{
    protected $table = 'remisa';
    protected $filable = ['id_venta', 'id_delivery'];
}
 