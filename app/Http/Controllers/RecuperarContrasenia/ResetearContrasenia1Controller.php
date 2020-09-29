<?php

namespace App\Http\Controllers\RecuperarContrasenia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResetearContrasenia1Controller extends Controller
{
    public function RecuperarCont1(Request $request)
    {

    	$id = $request->input('id');
    	$token = $request->input('token');

    	if (isset($id) AND isset($token)) {
  
				$Datos=DB::table('FichaFuncionario')->Select('Id_Funcionario','Nombres','Apellidos','Token')->where('Id_Funcionario',$id)->first();
    	 
    			if ($Datos->Token==$token){
    				return view('RestaurarContrasenia/TokenValido1')->with('Datos', $Datos);
    			}	 
    			else{
					return view('RestaurarContrasenia/ErrorValidarToken')->with('Datos', $Datos);
    			} 
		}
		else{
			return view('RestaurarContrasenia/ErrorTokenEditado');
		}
    }
}