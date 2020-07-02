<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaFuncionario extends Model
{
	//referencia a una tabla
    protected $table="FichaFuncionario";
    protected $primaryKey="Id_Funcionario";

    /*inset multiples
    protected $fillable=[

    		//pongo los caampos para permitir insert multiple

    	"sasasa",
    	"sddsdsd",
    	"wsasasa"


    ]; 


    inset multiples
    protected $guarded=[

    		//pongo los caampos que no se pueden insertar

    	"sasasa",
    	"sddsdsd",
    	"wsasasa"


    ]

    */

}
 