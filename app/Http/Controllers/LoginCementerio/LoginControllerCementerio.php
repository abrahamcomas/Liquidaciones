<?php

namespace App\Http\Controllers\LoginCementerio;
use Redirect;
 
use Illuminate\Http\Request;
use App\FichaFuncionarioCementerio;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 


class LoginControllerCementerio extends Controller 
{
    public function loginCementerio(Request $request) 
    {
        
        $rules = [
            'RUNCE' => 'required', 
            'passwordCE' => 'required|min:6', 
        ]; 

        $messages = [
            'RUNCE.required' =>'El campo Rut es obligatorio.',
            'passwordCE.required' =>'El campo Contraseña es obligatorio.'
        ];
 
        $this->validate($request, $rules, $messages);

        $RUN = $request->input('RUNCE');   
        $password = $request->input('passwordCE'); 
        $Activo0=0;  

        //Agrego 0 a rut menores a 10
        $LargoRun = strlen($RUN);
        if ($LargoRun < 10) {
            $RUN=str_pad($RUN, 10, "0", STR_PAD_LEFT);
        }  

        $idLogin=FichaFuncionarioCementerio::Select('Id_Funcionario','Activo','Rut','password','CorreoActivo')->whereActivo($Activo0)->whereRut($RUN)->first();

        if (!empty($idLogin->Id_Funcionario)) 
        { 
            $Id_Funcionario=$idLogin->Id_Funcionario; 
        } 
        if (!empty($idLogin->Rut) AND !empty($idLogin->password) AND !empty($idLogin->CorreoActivo))
        {

            if(Auth::guard('Cementerio')->attempt(['Rut' => $RUN, 'password' => $password, 'Activo' => 0], true))

            {        
                $resultado = DB::connection('cementerio')->table('HistoricoLiquidacion')->where('Id_Funcionario', $Id_Funcionario)->distinct()->get('Ano');
                
                $date=date("Y");
                $seis='6';

                $sqlnumerodiassolicitados = DB::connection('cementerio')->table('PermisosAdministrativos')
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


                $sqlDiasFeriados = DB::connection('cementerio')->table('PermisosLegales')
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

                return view('Sistema/Cementerio/PrincipalCementerio')->with('resultado', $resultado)->with('RUN', $RUN)->with('Id_Funcionario', $Id_Funcionario)->with('R_numerodiassolicitados', $R_numerodiassolicitados)->with('sqlDiasFeriados', $sqlDiasFeriados);

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
            'RutCE' => 'required', 
            'ContraseniaCE' => 'required|min:6',
            'Confirmar_ContraseniaCE' => 'required:ContraseniaCE|same:ContraseniaCE|min:6|different:password',
            'EmailCE' => 'required',
        ];

        $messages = [
            'RutCE.required' =>'El campo Rut es obligatorio.',
            'ContraseniaCE.required' =>'El campo Contraseña es obligatorio.',
            'Confirmar_ContraseniaCE.required' =>'El campo Confirmar Contraseña es obligatorio.',
            'EmailCE.required' =>'El campo Email es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);

      

        $Rut = $request->input('RutCE');
        $Email = $request->input('EmailCE');
        $Contrasenia = $request->input('ContraseniaCE'); 
        $Activo0=0;

        //Agrego 0 a rut menores a 10
        $LargoRun = strlen($Rut);
        if ($LargoRun < 10) {
            $Rut=str_pad($Rut, 10, "0", STR_PAD_LEFT);
        }
        //$Funcionario=FichaFuncionario::where("Rut",$Rut)->get()->count();

        $Funcionario=FichaFuncionarioCementerio::select('Id_Funcionario','Activo','Rut','password')->whereRut($Rut)->whereActivo($Activo0)->first();

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
                
                $FuncionarioCorreo=DB::connection('cementerio')->table('FichaFuncionario')->where('Email', $Email)->exists();

                if ($FuncionarioCorreo==0) 
                {
                        
                       $id=FichaFuncionarioCementerio::Select('Id_Funcionario','Activo')->whereRut($Rut)->whereActivo($Activo0)->first();

                        $user = FichaFuncionarioCementerio::find($id->Id_Funcionario);
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
