<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class ConsultaMesController extends Controller 
{
	public function __construct()
	{
		$this->middleware('auth');

	}

    public function Mes(Request $request)  
    {

 		$Anio = $request->input('Anio'); 
        $Id_Funcionario = $request->input('Id_Funcionario');  
        $RUN = $request->input('RUN');   

		$ListaMes=DB::table('HistoricoLiquidacion')->where('Id_Funcionario', $Id_Funcionario)->where('Ano', $Anio)->distinct()->orderBy('Mes', 'ASC')->get('Mes');

		$MesActual=DB::table('Liquidacion')->where('Id_Funcionario', $Id_Funcionario)->get();

            return view('Sistema/Mes')->with('ListaMes', $ListaMes)->with('MesActual', $MesActual)->with('RUN', $RUN)->with('Id_Funcionario', $Id_Funcionario)->with('Anio', $Anio);
   
	}
}
 ?>  