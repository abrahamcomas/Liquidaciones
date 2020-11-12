<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB; 

class MesesPC extends Component
{  

    public $MesSelect;
    public $ListaMes; 
    public $MesActual;
    public $RUN;
    public $Id_Funcionario; 
    public $Anio;
    public $PlanillaSuplementaria;

    public function render() 
    {

        $this->PlanillaSuplementaria=DB::table('PlanillaSuplementaria')->where('Id_Funcionario', $this->Id_Funcionario)->where('Mes', $this->MesSelect)->where('Ano', $this->Anio)->distinct()->get('Mes');
        
        foreach( $this->PlanillaSuplementaria as $mes)
        {
            if ($mes->Mes==5) 
            {
               $this->PlanillaSuplementaria=5;
            }
            if ($mes->Mes==7)
            {
               $this->PlanillaSuplementaria=7;
            }
            if ($mes->Mes==10)
            {
               $this->PlanillaSuplementaria=10;
            }
            if ($mes->Mes==12)
            {
               $this->PlanillaSuplementaria=12;
            }
                                           
                        
        }

        return view('livewire.meses-p-c',[ 
            'MesSelect'=>$this->MesSelect,
			'ListaMes'=>$this->ListaMes=DB::table('HistoricoLiquidacion')->where('Id_Funcionario', $this->Id_Funcionario)->where('Ano', $this->Anio)->distinct()->orderBy('Mes', 'ASC')->get('Mes'),
            'MesActual'=>$this->MesActual,
            'RUN'=>$this->RUN,
            'Id_Funcionario'=>$this->Id_Funcionario,
            'Anio'=>$this->Anio,
			'PlanillaSuplementaria'=>$this->PlanillaSuplementaria

        ]);
    }
} 
