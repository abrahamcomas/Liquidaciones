<?php

namespace App\Http\Controllers\Login;
use Redirect;
use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CerrarLoginControler extends Controller
{	
	public function __construct()
		{
			$this->middleware('auth');
		}
    public function CerrarSesion(Request $request)
    	{ 
        	Auth::logout();
            Session::flush();
   			return Redirect::to('/');
    	}

    	public function NoLogin(Request $request)
        { 
            return Redirect::to('/');
        }
}
