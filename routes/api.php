<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CuponsController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('carrinho', CarrinhoController::class)->middleware('web');
Route::resource('pedido', PedidoController::class)->middleware('web');
Route::resource('cupons', CuponsController::class)->middleware('web');
Route::post('/pedido/finalizar', [PedidoController::class, 'finalizar'])->middleware('web');