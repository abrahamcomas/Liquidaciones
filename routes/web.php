<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('consulta',function(){

	$sql = 'SELECT * FROM Usuarios_Liquidacion';
        $products = DB::select($sql);
        return $products;

});     

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');