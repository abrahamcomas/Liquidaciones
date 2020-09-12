<?php
 
namespace App\Http\Controllers\LoginCodigo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class volverIndexController extends Controller
{ 
    public function VolverIndex(Request $request) 
    { 
       	$Id_Funcionario = Auth::guard('Codigo')->user()->Id_Funcionario;
 		$RUN = Auth::guard('Codigo')->user()->Rut;
             
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

}
