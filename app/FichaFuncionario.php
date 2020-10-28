<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaFuncionario extends Model
{
    protected $connection = 'sqlsrv';
	//referencia a una tabla
    protected $table="FichaFuncionario";
    protected $primaryKey="Id_Funcionario";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"Email",
    	"password",
    	"CorreoActivo",
        "remember_token"
    ]; 

    /*
    inset multiples    
    protected $guarded=[

    		//pongo los caampos que no se pueden insertar

    	"sasasa",
    	"sddsdsd",
    	"wsasasa"


    ]

    */



//  public function PermisosAdministrativo()
// {
//     return $this->hasOne('App\PermisosAdministrativos', 'Id_Funcionario','Id_Funcionario');
// }
    public $timestamps = false;

}
 