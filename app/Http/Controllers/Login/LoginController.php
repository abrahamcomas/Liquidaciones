<?php

namespace App\Http\Controllers\Login;
use Redirect;

use Illuminate\Http\Request;
use App\FichaFuncionario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\RecuperarPassword;
use App\Mail\RegistroCorreo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request) 
    {
        $credenciales = $this->validate(request(),[
            'RUN' => 'required',
            'password' => 'required'
        ]);

        $RUN = $request->input('RUN'); 
        $password = $request->input('password');   

        $idLogin=FichaFuncionario::Select('Id_Funcionario','Rut','password','CorreoActivo')->whereRut($RUN)->first();
        $Id_Funcionario=$idLogin->Id_Funcionario;
        if (!empty($idLogin->Rut) AND !empty($idLogin->password) AND !empty($idLogin->CorreoActivo))
        {

            if(Auth::attempt(['Rut' => $RUN, 'password' => $password], true))
            { 
                // $usr = FichaFuncionario::where('Rut',$RUN)->first(); 
                // $user = $usr->PermisosAdministrativo()->where('Periodo', $Año)->get();          

                $resultado = DB::table('HistoricoLiquidacion')->where('Id_Funcionario', $Id_Funcionario)->distinct()->get('Ano');
                
                $date=date("Y");
                $seis='6';

                $sqlnumerodiassolicitados = DB::table('PermisosAdministrativos')
                ->join('FichaFuncionario', 'PermisosAdministrativos.Id_Funcionario', '=', 'FichaFuncionario.Id_Funcionario')
                ->where('FichaFuncionario.rut', '=', $RUN)
                ->where('PermisosAdministrativos.Periodo', '=', $date)
                ->first();


                $numerodiassolicitados = $sqlnumerodiassolicitados->NroDiasSolicitados;

                
            
                $R_numerodiassolicitados=($seis - $numerodiassolicitados);


                $sqlDiasFeriados = DB::table('PermisosLegales')
                ->join('FichaFuncionario', 'PermisosLegales.Id_Funcionario', '=', 'FichaFuncionario.Id_Funcionario')
                ->where('FichaFuncionario.rut', '=', $RUN)
                ->where('PermisosLegales.Periodo', '=', $date)
                ->first();

                 $sqlDiasFeriados = $sqlDiasFeriados->NroDias_FeriadosReales;

                return view('Sistema/Principal')->with('resultado', $resultado)->with('RUN', $RUN)->with('Id_Funcionario', $Id_Funcionario)->with('R_numerodiassolicitados', $R_numerodiassolicitados)->with('sqlDiasFeriados', $sqlDiasFeriados);

            }
            else
            {
               return back()
                    ->withErrors(['Contraseña Incorrecta'])
                    ->withInput(request(['RUN']));
            }
        }
        elseif(!empty($idLogin->Rut) AND !empty($idLogin->password) AND empty($idLogin->CorreoActivo))
        {
            return back()
                ->withErrors(['Debes Confirmar Correo'])
                ->withInput(request(['RUN']));
        }
        elseif(!empty($idLogin->Rut) AND empty($idLogin->password))
        {

            return back()
                ->withErrors(['Debes Actualizar Contraseña'])
                ->withInput(request(['RUN']));
        }
        else
        {
            return back()
                ->withErrors(['Usuario No Registrado'])
                ->withInput(request(['RUN']));
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

        //$Funcionario=FichaFuncionario::where("Rut",$Rut)->get()->count();

        $Funcionario=FichaFuncionario::select('Rut')->whereRut($Rut)->get()->first();

        if (!empty($Funcionario))   
        {
            
            $id=FichaFuncionario::Select('Id_Funcionario')->whereRut($Rut)->first();

            $user = FichaFuncionario::find($id->Id_Funcionario);
            $user->Email = $Email;
            $user->password = Hash::make($request->Contraseña);
            $user->CorreoActivo = "1";
            $user->save();

            // Mail::to($Email)->send(new RegistroCorreo);

            return view('Login/Registrosend');


            /*return view('Registrado', [
                    'Funcionario' => $Funcionario
                ]);
              */  
        } 
        else
        {

            return back()
            ->withErrors(['Usuario Sin Autorización De Registro'])
            ->withInput(request(['Rut','Email']));

        }
    }

     public function RecuperarContraseña(Request $request)
    {

        $credenciales = $this->validate(request(),[
            'Email' => 'required',
        ]);
        $Email = $request->input('Email');

        Mail::to($Email)->send(new RecuperarPassword);

            return view('Login/Registrosend');


     
       
    
}
 
}
