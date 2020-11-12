<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PDF_PMG_Controller extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function PDF(Request $request) 
    {
		$mes = $request->input('Mes'); 
        $ano = $request->input('Anio'); 
        $rut = $request->input('RUN'); 

		$pdf = \PDF::loadView('PDF/PlantaContrata/PMG', compact('rut','mes','ano'));

		return $pdf->stream('PMG.pdf');
    }
}
