<?php

namespace App\Http\Controllers\RecuperarContrasenia\IngresoNuevaC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\FichaFuncionario;

class RestaurarCon1Controller extends Controller
{
    public function Restaurar(Request $request)
    {
    	$rules = [ 
            'ContraseniaCO' => 'required|min:6', 
            'Confirmar_ContraseniaCO' => 'required:ContraseniaCO|same:ContraseniaCO|min:6|different:password', 
        ]; 

        $messages = [  
            'ContraseniaCO.required' =>'El campo contraseña es obligatorio.',
            'Confirmar_ContraseniaCO.required' =>'El campo Confirmar contraseña es obligatorio.'
        ];  
 
        $this->validate($request, $rules, $messages);

        $Id_Funcionario = $request->input('Id_Funcionario');
        $ContraseniaCO = $request->input('ContraseniaCO');

        $user = FichaFuncionario::find($Id_Funcionario);
        $user->CorreoActivo = 1;
        $user->password = Hash::make($ContraseniaCO);
        $user->save();

        $resultado='Contraseña restaurada correctamente';

        return view('Login/Registrosend')->with('resultado', $resultado);
    }
}
