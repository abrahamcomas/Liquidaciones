<?php

namespace App\Http\Controllers\RecuperarContrasenia;
use App\Http\Controllers\Controller;
use App\Mail\RecuperarPassword;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\FichaFuncionario;
use App\FichaFuncionarioCementerio;
use App\FichaFuncionarioCodigo;


class RContraseniaController extends Controller
{ 
    public function RecuperarCont(Request $request)
    {
 
        $rules = [
            'Email' => 'required',
        ]; 
 
        $messages = [ 
            'Email.required' =>'El campo Email es obligatorio.',
        ]; 

        $this->validate($request, $rules, $messages);

        $Email = $request->input('Email');

 		$FPC=DB::table('FichaFuncionario')->where('Email', $Email)->exists();
        	
		$FCementerio=DB::connection('cementerio')->table('FichaFuncionario')->where('Email', $Email)->exists();

		$FCodigo=DB::connection('codigo')->table('FichaFuncionario')->where('Email', $Email)->exists();

		if ($FPC==1) {  

			$datos=DB::table('FichaFuncionario')->Select('Id_Funcionario','Nombres','Apellidos')->whereEmail($Email)->first();

			$token1=Str::random(120); 

			$user = FichaFuncionario::find($datos->Id_Funcionario);
            $user->Token = $token1;
            $user->save();

			$resultado='Funcionario '.$datos->Nombres.' '.$datos->Apellidos.' correo enviado correctamente';
			
			$token= 'http://liquidaciones.test/ResetearContraseniaF1?id='.$datos->Id_Funcionario.'&token='.$token1;

			// Tengo que cambiar el link
			// $token= 'http://liquidaciones.municipalidadcurico.cl/ResetearContraseniaF1?id='.$datos->Id_Funcionario.'&token='.$token1;
			
			Mail::to($Email)->send(new RecuperarPassword($datos,$token));

			//Ejemplo Respaldo
			// $subject = "Restauración Contraseña";
   			// $for =$Email;
   			// Mail::send('Email/RecuperarPass' ,$request->all(), function($msj) use($subject,$for)
   			// {
   			// $msj->from("tucorreo@gmail.com","Sistema Liquidaciones Curicó");
   			// $msj->subject($subject);
   			// $msj->to($for);
   			// });

		}
		elseif($FCementerio==1){ 

			$datos=DB::connection('cementerio')->table('FichaFuncionario')->Select('Id_Funcionario','Nombres','Apellidos')->whereEmail($Email)->first();

        	$resultado='Funcionario '.$datos->Nombres.' '.$datos->Apellidos.' correo enviado correctamente';
			
			$token1=Str::random(120); 

			$user = FichaFuncionarioCementerio::find($datos->Id_Funcionario);
            $user->Token = $token1;
            $user->save();

			$token= 'http://liquidaciones.test/ResetearContraseniaF2?id='.$datos->Id_Funcionario.'&token='.$token1;

			//Tengo que cambiar el link
			// $token= 'http://liquidaciones.municipalidadcurico.cl/ResetearContraseniaF2?id='.$datos->Id_Funcionario.'&token='.$token1;
			
			Mail::to($Email)->send(new RecuperarPassword($datos,$token));

		}
		elseif($FCodigo==1){

			$Datos=DB::connection('codigo')->table('FichaFuncionario')->Select('Id_Funcionario','Nombres','Apellidos')->whereEmail($Email)->first();

        	$resultado='Funcionario '.$datos->Nombres.' '.$datos->Apellidos.' correo enviado correctamente';
			
			$token1=Str::random(120); 

			$user = FichaFuncionarioCementerio::find($datos->Id_Funcionario);
            $user->Token = $token1;
            $user->save();

			$token= 'http://liquidaciones.test/ResetearContraseniaF3?id='.$datos->Id_Funcionario.'&token='.$token1;

			//Tengo que cambiar el link
			// $token= 'http://liquidaciones.municipalidadcurico.cl/ResetearContraseniaF3?id='.$datos->Id_Funcionario.'&token='.$token1;
			
			Mail::to($Email)->send(new RecuperarPassword($datos,$token));

		}
		else{

			 $resultado='Error, Email no existe en los registros';
		}
 
            return view('Login/Registrosend')->with('resultado', $resultado);
	}
}
 