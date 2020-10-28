<?php

namespace App\Http\Livewire; 

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\RecuperarPassword;  
use Illuminate\Support\Str;
 
use App\FichaFuncionario;
use App\FichaFuncionarioCementerio;
use App\FichaFuncionarioCodigo;

class Contrasenia extends Component
{

	public $Email;
	public $C;
	public $resultado=1;

   protected $rules = [
        'Email' => 'required',
        'C' => 'required',
    ];

    protected $messages = [
        'Email.required' => 'El campo Email es obligatorio.',
        'C.required' => 'El campo tipo contrato es obligatorio.',
    ];

	public function Enviarcorreo()
	{

		$validatedData = $this->validate();
		$Email=$this->Email;
		$C=$this->C;

		if ($C==1) { 

			$FPC=DB::table('FichaFuncionario')->where('Email', $Email)->exists(); 

			if ($FPC==1) 
			{
				
				$datos=DB::table('FichaFuncionario')->Select('Id_Funcionario','Nombres','Apellidos')->whereEmail($Email)->first();

				$token1=Str::random(120); 

				$user = FichaFuncionario::find($datos->Id_Funcionario);
				$user->CorreoActivo = 2;  
	            $user->Token = $token1;
	            $user->save();

				$resultado='Funcionario '.$datos->Nombres.' '.$datos->Apellidos.' correo enviado correctamente';
				
				// $token= 'http://liquidaciones.test/ResetearContraseniaF1?id='.$datos->Id_Funcionario.'&token='.$token1;

				// Tengo que cambiar el link
				$token= 'http://liquidaciones.municipalidadcurico.cl/ResetearContraseniaF1?id='.$datos->Id_Funcionario.'&token='.$token1;

				Mail::to($Email)->send(new RecuperarPassword($datos,$token));

				$this->resultado='Email, enviado correctamente';

			}
			else
			{

 				$this->resultado='Error, Email no existe en los registros';
			
			}

		}
		elseif($C==2)
		{ 

			$FCementerio=DB::connection('cementerio')->table('FichaFuncionario')->where('Email', $Email)->exists();

			if ($FCementerio==1) 
			{

				$datos=DB::connection('cementerio')->table('FichaFuncionario')->Select('Id_Funcionario','Nombres','Apellidos')->whereEmail($Email)->first();

	        	$resultado='Funcionario '.$datos->Nombres.' '.$datos->Apellidos.' correo enviado correctamente';
				
				$token1=Str::random(120); 

				$user = FichaFuncionarioCementerio::find($datos->Id_Funcionario);
				$user->CorreoActivo = 2; 
	            $user->Token = $token1;
	            $user->save();

				// $token= 'http://liquidaciones.test/ResetearContraseniaF2?id='.$datos->Id_Funcionario.'&token='.$token1;

				//Tengo que cambiar el link
				$token= 'http://liquidaciones.municipalidadcurico.cl/ResetearContraseniaF2?id='.$datos->Id_Funcionario.'&token='.$token1;
				
				Mail::to($Email)->send(new RecuperarPassword($datos,$token));

				$this->resultado='Email, enviado correctamente';
			}
			else
			{

				$this->resultado='Error, Email no existe en los registros';
			
			}

			

		}
		elseif($C==3)
		{

			$FCodigo=DB::connection('codigo')->table('FichaFuncionario')->where('Email', $Email)->exists();

			if ($FCodigo==1) 
			{
				
				$datos=DB::connection('codigo')->table('FichaFuncionario')->Select('Id_Funcionario','Nombres','Apellidos')->whereEmail($Email)->first();

	        	$resultado='Funcionario '.$datos->Nombres.' '.$datos->Apellidos.' correo enviado correctamente';
				
				$token1=Str::random(120); 

				$user = FichaFuncionarioCodigo::find($datos->Id_Funcionario);
				$user->CorreoActivo = 2; 
	            $user->Token = $token1;
	            $user->save();

				// $token= 'http://liquidaciones.test/ResetearContraseniaF3?id='.$datos->Id_Funcionario.'&token='.$token1;

				//Tengo que cambiar el link
				$token= 'http://liquidaciones.municipalidadcurico.cl/ResetearContraseniaF3?id='.$datos->Id_Funcionario.'&token='.$token1;
			
				Mail::to($Email)->send(new RecuperarPassword($datos,$token));

				$this->resultado='Email, enviado correctamente';
			}
			else
			{
				
				$this->resultado='Error, Email no existe en los registros';

			}

		}
		else{

			  $this->resultado='Error';
		}
 
	}

			

    public function render()
    {
  		$Rut='17486231-1';
        $hola='hol';

        return view('livewire.contrasenia',[


			'user'=>Auth::user(),
			'hola'=>$hola,
			'hola'=>$this->Email,
			'resultado'=>$this->resultado,
        	'FuncionarioCorreo'=>DB::table('FichaFuncionario')->Select('Id_Funcionario')->whereRut($Rut)->get()->first()


        ]);
    }
}
