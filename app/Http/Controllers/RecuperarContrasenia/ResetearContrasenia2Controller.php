<?php

namespace App\Http\Controllers\RecuperarContrasenia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResetearContrasenia2Controller extends Controller
{
    public function RecuperarCont2(Request $request)
    {
    	$id = $request->input('id');
    	$token = $request->input('token');

    	if (isset($id) AND isset($token)) {
  
				$Datos=DB::connection('cementerio')->table('FichaFuncionario')->Select('Id_Funcionario','Nombres','Apellidos','Token')->where('Id_Funcionario',$id)->first();
    	 
    			if ($Datos->Token==$token){
    				return view('RestaurarContrasenia/TokenValido2')->with('Datos', $Datos);
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
