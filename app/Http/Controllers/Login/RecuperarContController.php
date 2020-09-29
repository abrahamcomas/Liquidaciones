<?php

namespace App\Http\Controllers\Login;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecuperarContController extends Controller
{
    public function RecuperarCont(Request $request)
    {
 
        $credenciales = $this->validate(request(),[
            'Email' => 'required',
        ]); 
        $Email = $request->input('Email');



 		$FuncionarioCorreo=DB::table('FichaFuncionario')->where('Email', $Email)->exists();
        	if ($FuncionarioCorreo==1) 
        	{
        		
        		$api_token=Str::random(60),
                   
                Mail::to($Email)->send(new RecuperarPassword); 
            }
            else
            {
                $resultado='Error, Email no existe en los registros';
            }  

            return view('Login/Registrosend')->with('resultado', $resultado);
	}
}
