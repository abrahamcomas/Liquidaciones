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

Route::get('RecuperarContrasenia', function () { 
    return view('Login/RecuperarContrasenia');
})->name('Recuprar');




Route::get('SistemaMes')->middleware('auth'); 
Route::post('SistemaMes','ConsultaMesController@Mes')->name('ConsultaMes')->middleware('auth'); 

//Login 
Route::get('CerrarSesion','Login\CerrarLoginControler@CerrarSesion')->middleware('auth')->name('CerrarSesion');


Route::get('CambiarContrasenia', function () {
    return view('Login/CambiarContrasenia');
})->middleware('auth')->name('CambiarContrasenia'); 


//Contraseña
Route::get('ConfirmarCambioContrasenia')->middleware('auth');
Route::post('ConfirmarCambioContrasenia','Login\CambiarContController@CambiarContrasenia')->middleware('auth')->name('FormContrasenia');
Route::get('Sistema','Login\VolverIndexController@VolverIndex')->middleware('auth')->name('VolverIndex');

//Recuperar Contraseña
Route::post('Login/RecuperarContrasenia','Login\RecuperarContController@RecuperarCont')->name('ContraseniaEnviada');

//Cambiar Correo
Route::get('Sistema/CambiarCorreo', function () {
    return view('Login/CambiarCorreo');
})->middleware('auth')->name('CambiarCorreo'); 
Route::post('ConfirmarCambioCorreo','Login\CambiarCorreoController@CambiarCorreo')->middleware('auth')->name('FormCorreo');

//Login
Route::get('Sistema/Principal','Login\CerrarLoginControler@NoLogin')->middleware('auth');
Route::post('Sistema/Principal','Login\LoginController@Login')->name('login'); 


//Creacion de PDF
Route::get('LiquidacionesPDF')->middleware('auth'); 
Route::post('LiquidacionesPDF','PDF\CrearPDF@PDF')->middleware('auth')->name('CrearPDF'); 
Route::get('LiquidacionesPDFActual')->middleware('auth');
Route::post('LiquidacionesPDFActual','PDF\CrearPDF@PDFActual')->middleware('auth')->name('CrearPDFActual');




?>


























