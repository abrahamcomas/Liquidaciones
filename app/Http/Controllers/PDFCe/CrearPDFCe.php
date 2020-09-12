<?php

namespace App\Http\Controllers\PDFCe;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CrearPDFCe extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:Cementerio');

	}
	
    public function PDF(Request $request) 
    {
		
		$mes = $request->input('Mes'); 
        $ano = $request->input('Anio'); 
        $rut = $request->input('RUN'); 

		$pdf = \PDF::loadView('PDF/Cementerio/LiquidacionesPDF', compact('rut','mes','ano'));

		return $pdf->stream('LiquidacionesPDF.pdf');
		// return $pdf->download('Registro.pdf');
		//NO descarga
		//return $pdf->stream('Registro.pdf');
    }

    public function PDFActual(Request $request) 
    {
		
		$mes = $request->input('Mes'); 
        $ano = $request->input('Anio'); 
        $rut = $request->input('RUN');  

		$pdf = \PDF::loadView('PDF/Cementerio/LiquidacionMesActual', compact('rut','mes','ano'));

		return $pdf->stream('LiquidacionesPDF.pdf');
		// return $pdf->download('Registro.pdf');
		//NO descarga
		//return $pdf->stream('Registro.pdf');
    }
}
