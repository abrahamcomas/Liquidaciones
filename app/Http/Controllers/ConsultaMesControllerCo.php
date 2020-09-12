<?php

namespace App\Http\Controllers; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class ConsultaMesControllerCo extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:Codigo');

	}

    public function Mes(Request $request)  
    {

 		$Anio = $request->input('Anio'); 
        $Id_Funcionario = $request->input('Id_Funcionario');  
        $RUN = $request->input('RUN');   

		$ListaMes=DB::connection('codigo')->table('HistoricoLiquidacion')->where('Id_Funcionario', $Id_Funcionario)->where('Ano', $Anio)->distinct()->orderBy('Mes', 'ASC')->get('Mes');

		$MesActual=DB::connection('codigo')->table('Liquidacion')->where('Id_Funcionario', $Id_Funcionario)->get();

            return view('Sistema/Codigo/MesCodigo
            	')->with('ListaMes', $ListaMes)->with('MesActual', $MesActual)->with('RUN', $RUN)->with('Id_Funcionario', $Id_Funcionario)->with('Anio', $Anio);
   
	}
}
