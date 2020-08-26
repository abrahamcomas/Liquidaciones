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


                if (!empty($sqlnumerodiassolicitados->NroDiasSolicitados)) {
                  $numerodiassolicitados = $sqlnumerodiassolicitados->NroDiasSolicitados;
                }
                else{
                    $numerodiassolicitados = 0;
                }
              

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
                ->withErrors(['Debes registrarte'])
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
            'Contrasenia' => 'required|min:6',
            'Comfirmar_Contrasenia' => 'required:Contrasenia|same:Contrasenia|min:6|different:password',
            'Email' => 'required',
        ]);

        $Rut = $request->input('Rut');
        $Email = $request->input('Email');
        $Contrasenia = $request->input('Contrasenia');

        //$Funcionario=FichaFuncionario::where("Rut",$Rut)->get()->count();

        $Funcionario=FichaFuncionario::select('Rut')->whereRut($Rut)->get()->first();

        if (!empty($Funcionario))   
        {
            $FuncionarioCorreo=DB::table('FichaFuncionario')->where('Email', $Email)->exists();

            if ($FuncionarioCorreo==0) {
                    
                   $id=FichaFuncionario::Select('Id_Funcionario')->whereRut($Rut)->first();

                    $user = FichaFuncionario::find($id->Id_Funcionario);
                    $user->Email = $Email;
                    $user->password = Hash::make($request->Contrasenia);
                    $user->CorreoActivo = "1";
                    $user->save();

                    $resultado='Registro Realizado Correctamente';
            }
            else
            {
                    $resultado='Error, Correo Registrado Anteriormente';
            }  

            return view('Login/Registrosend')->with('resultado', $resultado);
        } 
        else
        {

            return back()
            ->withErrors(['Usuario Sin Autorización De Registro'])
            ->withInput(request(['Rut','Email']));

        }


    }
 
}
