<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermisosAdministrativos extends Model
{
    protected $table="PermisosAdministrativos";
    protected $primaryKey="Id_Funcionario";
   
    public $timestamps = false;
}
