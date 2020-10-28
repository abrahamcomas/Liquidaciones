<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\FichaFuncionario;
use Illuminate\Support\Facades\Auth; 

class Meses extends Component
{        
	// use WithPagination;
    
 //    public $sqlnumerodiassolicitados,$numerodiassolicitados,$R_numerodiassolicitados,$sqlDiasFeriados,$RUN,$date,$seis;
     
 //        public $resultado = NULL;
	// 	public $Id_Funcionario= Auth::user()->Id_Funcionario;
	// 	public $count = 0;

 //        public function datos()
 //        {
 //        	$this->date=date("Y"); 
 //        	$this->seis='6'; 

 //        	$this->Id_Funcionario = Auth::user()->Id_Funcionario;
 // 			$this->RUN = Auth::user()->Rut;

 // 			$this->resultado = DB::table('HistoricoLiquidacion')->where('Id_Funcionario', $Id_Funcionario)->distinct()->get('Ano');
    	
 // 			$this->sqlnumerodiassolicitados = DB::table('PermisosAdministrativos')
 //            ->leftjoin('FichaFuncionario', 'PermisosAdministrativos.Id_Funcionario', '=', 'FichaFuncionario.Id_Funcionario')
 //            ->where('FichaFuncionario.rut', '=', $RUN)
 //            ->where('PermisosAdministrativos.Periodo', '=', $date)
 //            ->first();

 //            if (!empty($sqlnumerodiassolicitados->NroDiasSolicitados)) {
 //              $this->numerodiassolicitados = $sqlnumerodiassolicitados->NroDiasSolicitados;
 //            }
 //            else{
 //                $this->numerodiassolicitados = 0; 
 //            }
              

 //            $this->R_numerodiassolicitados=($seis - $numerodiassolicitados);


 //            $this->sqlDiasFeriados = DB::table('PermisosLegales')
 //            ->leftjoin('FichaFuncionario', 'PermisosLegales.Id_Funcionario', '=', 'FichaFuncionario.Id_Funcionario')
 //            ->where('FichaFuncionario.rut', '=', $RUN)
 //            ->where('PermisosLegales.Periodo', '=', $date)
 //            ->first();

 //            if (!empty($this->sqlDiasFeriados->NroDias_FeriadosReales)) {
               
 //               $this->sqlDiasFeriados = $this->sqlDiasFeriados->NroDias_FeriadosReales;
 //            }
 //            else
 //            {
 //                $this->sqlDiasFeriados = 0; 
 //            }

 //        }
 
       

	//  public function increment()
	//     {
	//         $this->count++;
	//     }
           

//     public function render()
//     {
//         return view('livewire.meses');
//     }
// }
