<?php

namespace App\Http\Controllers\Login; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\FichaFuncionario;
use Illuminate\Support\Facades\Hash;

class CambiarContController extends Controller
{
      public function CambiarContrasenia(Request $request)
    	{ 
    		 $credenciales = $this->validate(request(),[
            'passwordActual' => 'required',
            'Contrasenia' => 'required',
            'Comfirmar_Contrasenia' => 'required:Contrasenia|same:Contrasenia|min:6|different:password',
        ]);

        $passwordActual = $request->input('passwordActual'); 
        $Contrasenia = $request->input('Contrasenia');  

        $Rut = Auth::user()->Rut;
        $Id_Funcionario = Auth::user()->Id_Funcionario;

		$FuncionarioPassword=FichaFuncionario::select('password')->whereRut($Rut)->get()->first();

		if(Hash::check($passwordActual, $FuncionarioPassword->password)){
		        
		          $user = FichaFuncionario::find($Id_Funcionario);
	            $user->password = Hash::make($request->Contrasenia);
	            $user->save();

			$resultado='Contraseña Actualizada Correctamente';
		}
		else{

			$resultado='Contraseña actual es incorrecta';
		}
   		
   		return view('Login/ContraseniaCambiada')->with('resultado', $resultado);

 	}

}
