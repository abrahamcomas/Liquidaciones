<?php

namespace App\Http\Controllers\LoginCodigo;
use Redirect;
use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CerrarLoginController extends Controller 
{	
	
    public function CerrarSesionCodigo(Request $request)
    	{ 
        	Auth::guard('Codigo')->logout();
            Session::flush(); 
   			return Redirect::to('/');
    	}

    	public function NoLogin(Request $request)
        {  
            return Redirect::to('/');
        }
}
 