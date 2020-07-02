<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\FichaFuncionario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        $credenciales = $this->validate(request(),[
            'Rut' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credenciales))
        {
            return 'exito';
        }
        else{
            return 'malo';
        }

    }   


    public function registro(Request $request)
    {
        $credenciales = $this->validate(request(),[
            'Rut' => 'required',
            'Contraseña' => 'required|min:6',
            'Comfirmar_Contraseña' => 'required:Contraseña|same:Contraseña|min:6|different:password',
            'Email' => 'required',
        ]);

        $Rut = $request->input('Rut');
        $Email = $request->input('Email');
        $Contraseña = $request->input('Contraseña');

        $ContraseñaE = encrypt($request->Contraseña);

        $Funcionario=FichaFuncionario::where("Rut",$Rut)->get()->count();

        if ($Funcionario==1) 
        {
            
    
            $id=FichaFuncionario::Select('Id_Funcionario')->whereRut($Rut)->first();

            $user = FichaFuncionario::find($id->Id_Funcionario);
            $user->Email = $Email;
            $user->password = $ContraseñaE;
            $user->save();

            return view('Registrado', [
                    'Funcionario' => $Funcionario
                ]);
                
        } 
        else
        {

            return back()
            ->withErrors(['Usuario Sin Autorización De Registro'])
            ->withInput(request(['Rut','Email']));

        }







    }

}
 