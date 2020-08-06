<?php
use Illuminate\Support\Facades\Route;
use App\FichaFuncionario; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate; 

use App\User;
use Illuminate\Http\Request;


//Rutas De Login 
Route::get('/', function () {
    return view('Login/Login');
})->name('Index'); 

Route::get('Registro', function () {
    return view('Login/Registrarse');
})->name('Registrarse');
Route::patch('login','Login\LoginController@registro')->name('Registro');

Route::get('RecuperarContraseña', function () { 
    return view('Login/RecuperarContraseña');
})->name('Recuprar');
Route::post('Login/RecuperarContraseña','Login\LoginController@RecuperarContraseña')->name('ContraseñaEnviada');








Route::get('SistemaMes')->middleware('auth'); 
Route::post('SistemaMes','ConsultaMesController@Mes')->middleware('auth')->name('ConsultaMes'); 



//Login 
Route::get('CerrarSesion','Login\CerrarLoginControler@CerrarSesion')->middleware('auth')->name('CerrarSesion');


Route::get('Sistema/Principal','Login\CerrarLoginControler@NoLogin')->middleware('auth');
Route::post('Sistema/Principal','Login\LoginController@Login')->name('login'); 


//Creacion de PDF
Route::get('LiquidacionesPDF')->middleware('auth'); 
Route::post('LiquidacionesPDF','PDF\CrearPDF@PDF')->middleware('auth')->name('CrearPDF'); 
Route::get('LiquidacionesPDFActual')->middleware('auth');
Route::post('LiquidacionesPDFActual','PDF\CrearPDF@PDFActual')->middleware('auth')->name('CrearPDFActual');




?>


























