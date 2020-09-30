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

Route::get('RecuperarContrasenia', function () { 
    return view('Login/RecuperarContrasenia');
})->name('Recuprar'); 
 
Route::post('Login/RecuperarContrasenia','RecuperarContrasenia\RContraseniaController@RecuperarCont')->name('ContraseniaEnviada');



////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////PLANTA Y CONTRATA/////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

//Iniciar Sesion
Route::post('Sistema/Principal','Login\LoginController@Login')->name('login'); 

////Cerrar Sesion 
Route::get('Sistema/Principal','Login\CerrarLoginControler@NoLogin')->middleware('auth');
Route::get('CerrarSesion','Login\CerrarLoginControler@CerrarSesion')->middleware('auth')->name('CerrarSesion');

// Registro
Route::patch('login','Login\LoginController@registro')->name('Registro');

// Consulta Mes 
Route::get('SistemaMes')->middleware('auth'); 
Route::post('SistemaMes','ConsultaMesController@Mes')->name('ConsultaMes')->middleware('auth'); 

//Cambiar Contrasenia
Route::get('CambiarContrasenia', function () {
    return view('Login/PlantaContrata/CambiarContrasenia'); 
})->middleware('auth')->name('CambiarContrasenia');  
Route::get('ConfirmarCambioContrasenia')->middleware('auth');
Route::post('ConfirmarCambioContrasenia','Login\CambiarContController@CambiarContrasenia')->middleware('auth')->name('FormContrasenia'); 

//Cambiar Correo
Route::get('Sistema/CambiarCorreo', function () {
    return view('Login/PlantaContrata/CambiarCorreo');
})->middleware('auth')->name('CambiarCorreo'); 
Route::post('ConfirmarCambioCorreo','Login\CambiarCorreoController@CambiarCorreo')->middleware('auth')->name('FormCorreo');
Route::get('Sistema','Login\VolverIndexController@VolverIndex')->middleware('auth')->name('VolverIndex');

//Creacion de PDF Cementerio 
Route::get('LiquidacionesPDF')->middleware('auth'); 
Route::post('LiquidacionesPDF','PDF\CrearPDF@PDF')->middleware('auth')->name('CrearPDF'); 
Route::get('LiquidacionesPDFActual')->middleware('auth');
Route::post('LiquidacionesPDFActual','PDF\CrearPDF@PDFActual')->middleware('auth')->name('CrearPDFActual');

Route::get('ResetearContraseniaF1','RecuperarContrasenia\ResetearContrasenia1Controller@RecuperarCont1')->name('R1');

//Restaurar contraseña por correo
Route::patch('RestaurarC1','RecuperarContrasenia\IngresoNuevaC\RestaurarCon1Controller@Restaurar')->name('RestaurarC1');   
 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////CEMENTERIO///////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
//Iniciar Sesion
Route::post('Sistema/PrincipalCe','LoginCementerio\LoginControllerCementerio@loginCementerio')->name('loginCE'); 

//Cerrar Sesion
Route::get('CerrarSesionCe','LoginCementerio\CerrarLoginControler@CerrarSesionCementerio')->middleware('auth:Cementerio')->name('CerrarSesionCe'); 

// Registro
Route::patch('loginCe','LoginCementerio\LoginControllerCementerio@registro')->name('RegistroCE');

// Consulta Mes 
Route::get('SistemaMesCe')->middleware('auth:Cementerio');   
Route::post('SistemaMesCe','ConsultaMesControllerCe@Mes')->name('ConsultaMesCe')->middleware('auth:Cementerio');

//Cambiar Contrasenia 
Route::get('CambiarContraseniaCe', function () {
    return view('Login/Cementerio/CambiarContraseniaCe');
})->middleware('auth:Cementerio')->name('CambiarContraseniaCe'); 
Route::get('ConfirmarCambioContraseniaCe')->middleware('auth:Cementerio');
Route::post('ConfirmarCambioContraseniaCe','LoginCementerio\CambiarContController@CambiarContrasenia')->middleware('auth:Cementerio')->name('FormContraseniaCe');   

//Cambiar Correo
Route::get('Sistema/CambiarCe', function () {
    return view('Login/Cementerio/CambiarCorreoCe');
})->middleware('auth:Cementerio')->name('CambiarCorreoCe'); 
Route::post('ConfirmarCambioCorreoCe','LoginCementerio\CambiarCorreoController@CambiarCorreo')->middleware('auth:Cementerio')->name('FormCorreoCe');
Route::get('SistemaCe','LoginCementerio\VolverIndexController@VolverIndex')->middleware('auth:Cementerio')->name('VolverIndexCe'); 
 
//Creacion de PDF Cementerio 
Route::get('LiquidacionesPDFCe')->middleware('auth:Cementerio'); 
Route::post('LiquidacionesPDFCe','PDFCe\CrearPDFCe@PDF')->middleware('auth:Cementerio')->name('CrearPDFCe'); 
Route::get('LiquidacionesPDFActualCe')->middleware('auth:Cementerio');
Route::post('LiquidacionesPDFActualCe','PDFCe\CrearPDF@PDFActual')->middleware('auth:Cementerio')->name('CrearPDFActualCe');


Route::get('ResetearContraseniaF2','RecuperarContrasenia\ResetearContrasenia2Controller@RecuperarCont2')->name('R2');
 
//Restaurar contraseña por correo
Route::patch('RestaurarC2','RecuperarContrasenia\IngresoNuevaC\RestaurarCon2Controller@Restaurar')->name('RestaurarC2'); 
 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////CODIGOS///////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
  
  
//Iniciar Sesion
Route::post('Sistema/PrincipalCo','LoginCodigo\LoginControllerCodigo@loginCodigo')->name('loginCO'); 

//Cerrar Sesion
Route::get('CerrarSesionCo','LoginCodigo\CerrarLoginController@CerrarSesionCodigo')->middleware('auth:Codigo')->name('CerrarSesionCo'); 

// Registro
Route::patch('loginCo','LoginCodigo\LoginControllerCodigo@registro')->name('RegistroCO');

// Consulta Mes  
Route::get('SistemaMesCo')->middleware('auth:Codigo');   
Route::post('SistemaMesCo','ConsultaMesControllerCo@Mes')->name('ConsultaMesCo')->middleware('auth:Codigo');

//Cambiar Contrasnia
Route::get('CambiarContraseniaCo', function () {
    return view('Login/Codigo/CambiarContraseniaCo');
})->middleware('auth:Codigo')->name('CambiarContraseniaCo'); 
Route::get('ConfirmarCambioContraseniaCo')->middleware('auth:Codigo');
Route::post('ConfirmarCambioContraseniaCo','LoginCodigo\CambiarContController@CambiarContrasenia')->middleware('auth:Codigo')->name('FormContraseniaCo'); 

//Cambiar Correo
Route::get('Sistema/CambiarCo', function () {
    return view('Login/Codigo/CambiarCorreoCo');
})->middleware('auth:Codigo')->name('CambiarCorreoCo'); 
Route::post('ConfirmarCambioCorreoCo','LoginCodigo\CambiarCorreoController@CambiarCorreo')->middleware('auth:Codigo')->name('FormCorreoCo');
Route::get('SistemaCo','LoginCodigo\VolverIndexController@VolverIndex')->middleware('auth:Codigo')->name('VolverIndexCo');

//Creacion de PDF Cementerio  
Route::get('LiquidacionesPDFCo')->middleware('auth:Codigo'); 
Route::post('LiquidacionesPDFCo','PDFCo\CrearPDFCo@PDF')->middleware('auth:Codigo')->name('CrearPDFCo'); 
Route::get('LiquidacionesPDFActualCo')->middleware('auth:Codigo'); 
Route::post('LiquidacionesPDFActualCo','PDFCo\CrearPDFCo@PDFActual')->middleware('auth:Codigo')->name('CrearPDFActualCo');


Route::get('ResetearContraseniaF3','RecuperarContrasenia\ResetearContrasenia3Controller@RecuperarCont3')->name('R3');

//Restaurar contraseña por correo
Route::patch('RestaurarC3','RecuperarContrasenia\IngresoNuevaC\RestaurarCon3Controller@Restaurar')->name('RestaurarC3'); 

?>

 
























