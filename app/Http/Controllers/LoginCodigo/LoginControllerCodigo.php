<?php

namespace App\Http\Controllers\LoginCodigo;
use Redirect;
 
use Illuminate\Http\Request;
use App\FichaFuncionarioCodigo;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 


class LoginControllerCodigo extends Controller 
{
    public function loginCodigo(Request $request) 
    {
        
        $rules = [
            'RUNCO' => 'required', 
            'passwordCO' => 'required|min:6', 
        ]; 

        $messages = [
            'RUNCO.required' =>'El campo Rut es obligatorio.',
            'passwordCO.required' =>'El campo Contraseña es obligatorio.'
        ]; 
 
        $this->validate($request, $rules, $messages);

        $RUN = $request->input('RUNCO');   
        $password = $request->input('passwordCO');     
        $Activo0=0; 

        //Agrego 0 a rut menores a 10
        $LargoRun = strlen($RUN);
        if ($LargoRun < 10) {
            $RUN=str_pad($RUN, 10, "0", STR_PAD_LEFT);
        }

        $idLogin=FichaFuncionarioCodigo::Select('Id_Funcionario','Activo','Rut','password','CorreoActivo')->whereActivo($Activo0)->whereRut($RUN)->first();

        if (!empty($idLogin->Id_Funcionario)) 
        { 
            $Id_Funcionario=$idLogin->Id_Funcionario; 
        }  
        
        if (!empty($idLogin->Rut) AND !empty($idLogin->password) AND !empty($idLogin->CorreoActivo))
        {

            if(Auth::guard('Codigo')->attempt(['Rut' => $RUN, 'password' => $password, 'Activo' => 0], true))

            {         
                $resultado = DB::connection('codigo')->table('HistoricoLiquidacion')->where('Id_Funcionario', $Id_Funcionario)->distinct()->get('Ano');
                
                $date=date("Y");
                $seis='6';

                $sqlnumerodiassolicitados = DB::connection('codigo')->table('PermisosAdministrativos')
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
 

                $sqlDiasFeriados = DB::connection('codigo')->table('PermisosLegales')
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

                return view('Sistema/Codigo/PrincipalCodigo')->with('resultado', $resultado)->with('RUN', $RUN)->with('Id_Funcionario', $Id_Funcionario)->with('R_numerodiassolicitados', $R_numerodiassolicitados)->with('sqlDiasFeriados', $sqlDiasFeriados);

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
            'RutCO' => 'required', 
            'ContraseniaCO' => 'required|min:6',
            'Confirmar_ContraseniaCO' => 'required:ContraseniaCO|same:ContraseniaCO|min:6|different:password',
            'EmailCO' => 'required',
        ];

        $messages = [
            'RutCO.required' =>'El campo Rut es obligatorio.',
            'ContraseniaCO.required' =>'El campo Contraseña es obligatorio.',
            'Confirmar_ContraseniaCO.required' =>'El campo Confirmar Contraseña es obligatorio.',
            'EmailCO.required' =>'El campo Email es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);

      

        $Rut = $request->input('RutCO');
        $Email = $request->input('EmailCO');
        $Contrasenia = $request->input('ContraseniaCO'); 
        $Activo0=0;

        //Agrego 0 a rut menores a 10
        $LargoRun = strlen($Rut);
        if ($LargoRun < 10) {
            $Rut=str_pad($Rut, 10, "0", STR_PAD_LEFT);
        }
        //$Funcionario=FichaFuncionario::where("Rut",$Rut)->get()->count();

        $Funcionario=FichaFuncionarioCodigo::select('Id_Funcionario','Activo','Rut','password')->whereActivo($Activo0)->whereRut($Rut)->first();

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
                
                $FuncionarioCorreo=DB::connection('codigo')->table('FichaFuncionario')->where('Email', $Email)->exists();

                if ($FuncionarioCorreo==0) 
                { 
                        
                       $id=FichaFuncionarioCodigo::Select('Id_Funcionario')->whereRut($Rut)->whereActivo($Activo0)->first();

                        $user = FichaFuncionarioCodigo::find($id->Id_Funcionario);
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
