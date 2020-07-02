<?php

use Illuminate\Support\Facades\Route;
use App\FichaFuncionario;



//Rutas De Login
Route::get('/', function () {
    return view('Login/Login');
})->name('Index');

Route::post('Login/login','Auth\LoginController@Login')->name('login');

Route::get('/Registro', function () {
    return view('Login//Registrarse');
})->name('registro');;

Route::patch('login','Auth\LoginController@registro')->name('Registro');





 
































//Route::post('Login', 'LiquidacionController@Verificar');
 











Route::get('Principal/{rut}', 'LiquidacionController@Index');







/*











Route::get('/Leer', function(){

$fichaFuncionarios=FichaFuncionario::all();


foreach ($fichaFuncionarios as $fichaFuncionario) {
	

	echo $fichaFuncionario->Rut;
}

});
 



Route::get('consulta/{rut}',function($rut){ 

	$sql = "SELECT * FROM FichaFuncionario as a INNER JOIN Usuarios_Liquidacion as b on (a.Id_Funcionario = b.Id_Funcionario)  WHERE a.Rut='$rut'";
        $products = DB::select($sql);
        return $products;

});  

Route::get('consulta2/',function(){ 

	$sql = "SELECT * FROM FichaFuncionario'";
        $products = DB::select($sql);
        return $products;

});    

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/prueba', 'LiquidacionController@Prueba');


/*
Route::get('', function(){
	$nombre = "abraham";

	return view('home')->with('nombre', $nombre);

})->name('prueba');

Route::get('', function(){
	$nombre = "abraham";

	return view('home')->with(['nombre' => $nombre]);

})->name('prueba');

Route::get('', function(){
	$nombre = "abraham";

	return view('home', ['nombre' => $nombre]);

})->name('prueba');

Route::get('', function(){
	$nombre = "abraham";

	return view('home', compac('nombre'));

})->name('prueba');
*/
