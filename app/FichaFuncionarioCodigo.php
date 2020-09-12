<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class FichaFuncionarioCodigo extends Model
{
	protected $connection = 'codigo';
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
    
    public $timestamps = false;
} 