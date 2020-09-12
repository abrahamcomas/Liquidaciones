<?php
 
namespace App\Http\Controllers\LoginCementerio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class volverIndexController extends Controller
{ 
    public function VolverIndex(Request $request) 
    {
        $RUN = Auth::guard('Cementerio')->user()->Rut;
        $Id_Funcionario = Auth::guard('Cementerio')->user()->Id_Funcionario;
             
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

}
