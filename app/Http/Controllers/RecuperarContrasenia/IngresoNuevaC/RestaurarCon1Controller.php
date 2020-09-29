<?php

namespace App\Http\Controllers\RecuperarContrasenia\IngresoNuevaC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurarCon1Controller extends Controller
{
    public function Restaurar(Request $request)
    {
    	$rules = [
            'ContraseniaCO' => 'required', 
            'Confirmar_ContraseniaCO' => 'required|min:6', 
        ]; 

        $messages = [
            'ContraseniaCO.required' =>'El campo contraseña es obligatorio.',
            'Confirmar_ContraseniaCO.required' =>'El campo Confirmar contraseña es obligatorio.'
        ]; 
 
        $this->validate($request, $rules, $messages);
    }
}
