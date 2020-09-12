<?php

namespace App\Http\Controllers\LoginCementerio;
use Redirect;
use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CerrarLoginControler extends Controller 
{	
	
    public function CerrarSesionCementerio(Request $request)
    	{ 
        	Auth::guard('Cementerio')->logout();
            Session::flush(); 
   			return Redirect::to('/');
    	}

    	public function NoLogin(Request $request)
        { 
            return Redirect::to('/');
        }
}
