<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
class ConsultaMesController extends Controller 
{
	public function __construct()
	{
		$this->middleware('auth');

	}

    public function Mes(Request $request) 
    {
        $Anio = $request->Anio; 
        $Id_Funcionario = $request->Id_Funcionario; 
        $RUN = $request->RUN;  

		$ListaMes=DB::table('HistoricoLiquidacion')->where('Id_Funcionario', $Id_Funcionario)->where('Ano', $Anio)->distinct()->orderBy('Mes', 'ASC')->get('Mes');

		$MesActual=DB::table('Liquidacion')->where('Id_Funcionario', $Id_Funcionario)->get();

            return view('Sistema/Mes')->with('ListaMes', $ListaMes)->with('MesActual', $MesActual)->with('RUN', $RUN)->with('Id_Funcionario', $Id_Funcionario)->with('Anio', $Anio);
   
	}
}
 ?>  