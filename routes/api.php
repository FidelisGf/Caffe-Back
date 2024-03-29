<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('produtos', 'ProdutoController');
Route::resource('entrada-produto', 'EntradaProdutoController');
Route::resource('mesas', 'MesaController');
Route::resource('itens-mesa', 'ItensMesaController');
Route::resource('categorias', 'CategoriasController');
Route::resource('pedidos', 'PedidoController');
Route::patch('mesas/{id}/abrir-fechar', 'MesaController@openCloseMesa');

