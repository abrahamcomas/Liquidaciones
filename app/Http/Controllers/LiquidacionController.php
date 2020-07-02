<?php

namespace App\Http\Controllers;
use App\FichaFuncionario;
use App\Login;

use Illuminate\Http\Request;

class LiquidacionController extends Controller
{
    public function index($rut)
    {

			return "Hola Abraham ".$rut;
    }

    public function prueba()
    {

    	$alumnos=["abraham","raul","maria"];
    	//$alumnos=[];
        return view("Prueba", compact("alumnos"));
    }
 
  public function Verificar(Request $request)
  {
    $R_Funcionario = $request->Rut_Funcionario;
    $P_Funcionario = $request->Pass_Funcionario;

    $IdFuncionarioE=FichaFuncionario::where("Rut",$R_Funcionario)->get()->count();

    if ($IdFuncionarioE>=1) 
    {

      $R_IdFuncionario=FichaFuncionario::where("Rut",$R_Funcionario)->get([2]);

    $IdFuncionario=Login::where("Id_Funcionario",$R_IdFuncionario)->where("pass_Funcionario",$P_Funcionario)->get()->count();
        
      if ($IdFuncionario==1) 
      {
        return "bien";
      }
      else
      {
        return $R_IdFuncionario;
      }
    }
    else
    {
      return "No Existe";
    }


      /*$login=Login::where("pass_Funcionario",$Contraseña)->get()->count();
                  if ($login==1) {
                     return 'correcto';
                  }
                  else
                  {
                    return 'Error';
                  }

      if (isNullLogin($R_Funcionario, $P_Funcionario))
        { 
          return view('Login/Login', compact('Respuesta'));
        }
      else
        {
          $errors[] = login($R_Funcionario, $P_Funcionario);
        }
    

             

                //$fichaFuncionarios=FichaFuncionario::where("Rut",$Rut)->get()->count(); 
                $fichaFuncionarios=FichaFuncionario::where("Rut",$Rut)->get(['Id_Funcionario']);
            
            if (empty($fichaFuncionarios)) 
            {
                  
                //$fichaFuncionarios2=FichaFuncionario::where("Rut",$Rut)->get(['Id_Funcionario']);

                 

                //return view('login.php',  ['fichaFuncionario'=>$fichaFuncionarios]);
            }
            else
            {

                //return view('Login/Login')->with('Respuesta', $Respuesta);
                return view('Login/Login', compact('Respuesta'));
            }


*/

    }
}
