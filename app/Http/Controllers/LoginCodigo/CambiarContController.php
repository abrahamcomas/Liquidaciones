<?php

namespace App\Http\Controllers\LoginCodigo; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use App\FichaFuncionarioCodigo; 
use Illuminate\Support\Facades\Hash;

class CambiarContController extends Controller
{
      public function CambiarContrasenia(Request $request)
    	{ 
        $rules = [
            'passwordActual' => 'required',
            'Contrasenia' => 'required',
            'Comfirmar_Contrasenia' => 'required:Contrasenia|same:Contrasenia|min:6|different:password',
        ];

        $messages = [
            'passwordActual.required' =>'El campo contraseña actual es obligatorio.',
            'Contrasenia.required' =>'El campo contraseña nueva es obligatorio.',
            'Comfirmar_Contrasenia.required' =>'El campo confirmar contraseña es obligatorio y debe ser igual al campo contraseña nueva.'
        ];

        $this->validate($request, $rules, $messages);

        $passwordActual = $request->input('passwordActual'); 
        $Contrasenia = $request->input('Contrasenia');  
 
        $Rut = Auth::guard('Codigo')->user()->Rut;
        $Id_Funcionario = Auth::guard('Codigo')->user()->Id_Funcionario;

		$FuncionarioPassword=FichaFuncionarioCodigo::select('password')->whereRut($Rut)->get()->first();

		if(Hash::check($passwordActual, $FuncionarioPassword->password)){
		        
		          $user = FichaFuncionarioCodigo::find($Id_Funcionario);
	            $user->password = Hash::make($request->Contrasenia);
	            $user->save();

			$resultado='Contraseña Actualizada Correctamente';
		}
		else{

			$resultado='Contraseña actual es incorrecta';
		}
   		
   		return view('Login/Codigo/ContraseniaCambiadaCo')->with('resultado', $resultado);

 	}

}
