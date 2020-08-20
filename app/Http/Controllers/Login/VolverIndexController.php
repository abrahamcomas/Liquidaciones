<?php
 
namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class volverIndexController extends Controller
{ 
    public function VolverIndex(Request $request) 
    {
       	$Id_Funcionario = Auth::user()->Id_Funcionario;
 		$RUN = Auth::user()->Rut;
             
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

}
