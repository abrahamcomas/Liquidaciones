<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AñosLiquidacion extends Model
{
    protected $table="ano_liquidacion";
    protected $primaryKey="id_ano";
        public $timestamps = false;
}
