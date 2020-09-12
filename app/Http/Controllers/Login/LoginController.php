<?php

namespace App\Http\Controllers\Login;
use Redirect;

use Illuminate\Http\Request;
use App\FichaFuncionario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request) 
    { 
        
        $rules = [
            'RUN' => 'required', 
            'password' => 'required|min:6',
        ];

        $messages = [
            'RUN.required' =>'El campo Rut es obligatorio.',
            'password.required' =>'El campo Contraseña es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);

        $RUN = $request->input('RUN'); 
        $password = $request->input('password');   
        $Activo0=0;

        //Agrego 0 a rut menores a 10
        $LargoRun = strlen($RUN);
        if ($LargoRun < 10) {
            $RUN=str_pad($RUN, 10, "0", STR_PAD_LEFT);
        }

        $idLogin=FichaFuncionario::Select('Id_Funcionario','Activo','Rut','password','CorreoActivo')->whereActivo($Activo0)->whereRut($RUN)->first();
        

        if (!empty($idLogin->Id_Funcionario))
        {
            $Id_Funcionario=$idLogin->Id_Funcionario;
        }
        if (!empty($idLogin->Rut) AND !empty($idLogin->password) AND !empty($idLogin->CorreoActivo))
        {

            if(Auth::attempt(['Rut' => $RUN, 'password' => $password, 'Activo' => 0], true))
            { 
                // $usr = FichaFuncionario::where('Rut',$RUN)->first(); 
                // $user = $usr->PermisosAdministrativo()->where('Periodo', $Año)->get();          

                $resultado = DB::table('HistoricoLiquidacion')->where('Id_Funcionario', $Id_Funcionario)->distinct()->get('Ano');
                
                $date=date("Y"); 
                $seis='6';

                $sqlnumerodiassolicitados = DB::table('PermisosAdministrativos')
                ->leftjoin('FichaFuncionario', 'PermisosAdministrativos.Id_Funcionario', '=', 'FichaFuncionario.Id_Funcionario')
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
                ->leftjoin('FichaFuncionario', 'PermisosLegales.Id_Funcionario', '=', 'FichaFuncionario.Id_Funcionario')
                ->where('FichaFuncionario.rut', '=', $RUN)
                ->where('PermisosLegales.Periodo', '=', $date)
                ->first();

                if (!empty($sqlDiasFeriados->NroDias_FeriadosReales)) {
                   
                   $sqlDiasFeriados = $sqlDiasFeriados->NroDias_FeriadosReales;
                }
                else
                {
                   $sqlDiasFeriados = 0; 
                } 

                return view('Sistema/PlantaContrata/Principal')->with('resultado', $resultado)->with('RUN', $RUN)->with('Id_Funcionario', $Id_Funcionario)->with('R_numerodiassolicitados', $R_numerodiassolicitados)->with('sqlDiasFeriados', $sqlDiasFeriados);

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
        $rules = [
            'Rut' => 'required', 
            'Contrasenia' => 'required|min:6',
            'Confirmar_Contrasenia' => 'required:Contrasenia|same:Contrasenia|min:6|different:password',
            'Email' => 'required',
        ];

        $messages = [
            'Rut.required' =>'El campo Rut es obligatorio.',
            'Contrasenia.required' =>'El campo Contraseña es obligatorio.',
            'Confirmar_Contrasenia.required' =>'El campo Confirmar Contraseña es obligatorio.',
            'Email.required' =>'El campo Email es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);

      

        $Rut = $request->input('Rut');
        $Email = $request->input('Email');
        $Contrasenia = $request->input('Contrasenia');
        $Activo0=0;

        //Agrego 0 a rut menores a 10
        $LargoRun = strlen($Rut);
        if ($LargoRun < 10) {
            $Rut=str_pad($Rut, 10, "0", STR_PAD_LEFT);
        }

        $Funcionario=FichaFuncionario::select('Id_Funcionario','Activo','Rut','password')->whereActivo($Activo0)->whereRut($Rut)->first();
        
            if(isset($Funcionario->Activo)) 
                {
                    $Activo=0; 
                }
            else
                {
                    $Activo = 1; 
                }
        
        if (!empty($Funcionario->Id_Funcionario) AND $Activo==0)   
        {
            if (!empty($Funcionario->Id_Funcionario) AND empty($Funcionario->password)) {
                
                $FuncionarioCorreo=DB::table('FichaFuncionario')->where('Email', $Email)->exists();

                if ($FuncionarioCorreo==0) 
                {
                        
                       $id=FichaFuncionario::Select('Id_Funcionario','Activo')->whereRut($Rut)->whereActivo($Activo0)->first();

                        $user = FichaFuncionario::find($id->Id_Funcionario);
                        $user->Email = $Email;
                        $user->password = Hash::make($Contrasenia);
                        $user->CorreoActivo = "1";
                        $user->save();

                        $resultado='Registro Realizado Correctamente';
                }
                else
                {
                        $resultado='Error, Correo Registrado Anteriormente';
                }  
            }
            else
            {
            
                $resultado='Error, Usuario Registrado Anteriormente';
            }
           
            return view('Login/RegistroSend')->with('resultado', $resultado);
        } 
       
        else
        {

            return back()
            ->withErrors(['Usuario Sin Autorización De Registro'])
            ->withInput(request(['Rut','Email']));

        }


    }
 
}
