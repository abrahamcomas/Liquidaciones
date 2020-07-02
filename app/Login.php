<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{

	protected $table="Usuarios_Liquidacion";
    protected $primaryKey="";
 
    /*public function fichaFuncionario()
    {

        return $this->hasOne('App\FichaFuncionario','Id_Funcionario','Id_Funcionario');
    }
*/
}
