<?php

namespace App\Http\Controllers\Login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\FichaFuncionario;
use Illuminate\Support\Facades\Hash; 

class CambiarCorreoController extends Controller
{
        public function CambiarCorreo(Request $request)
    	{ 
    		$rules = [
            'passwordActual' => 'required',
            'Correo' => 'required',
        ];

        $messages = [
            'passwordActual.required' =>'El campo contraseña actual es obligatorio.',
            'Correo.required' =>'El campo Email es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);
 
        $passwordActual = $request->input('passwordActual'); 
        $Correo = $request->input('Correo'); 


        $Rut = Auth::user()->Rut;
        $Id_Funcionario = Auth::user()->Id_Funcionario;

		$FuncionarioPassword=FichaFuncionario::select('password')->whereRut($Rut)->get()->first();

		if(Hash::check($passwordActual, $FuncionarioPassword->password)){
		        
                $FuncionarioCorreo=DB::table('FichaFuncionario')->where('Email', $Correo)->exists();
                
                if ($FuncionarioCorreo==0) {
                    
                    $user = FichaFuncionario::find($Id_Funcionario);
                    $user->Email = $request->Correo;
                    $user->save();

                    $resultado='Email Actualizado Correctamente';
                }
                else
                {
                    $resultado='Error, Email Registrado Anteriormente';
                }  
		}
		else{

			$resultado='Contraseña actual es incorrecta';
		}
   		
   		return view('Login/ContraseniaCambiada')->with('resultado', $resultado);

 	}
}
 