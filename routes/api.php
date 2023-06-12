<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PratoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnderecoController;
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
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
});

Route::middleware(['auth:api', 'forceAcceptJson'])->group(function () {
    Route::apiResource('clientes', UsersController::class);
    Route::apiResource('restaurantes', RestauranteController::class);
    Route::post('restaurantes/login', [RestauranteController::class, 'login']);
    Route::apiResource('pedidos', PedidoController::class);
    Route::apiResource('pratos', PratoController::class);
    Route::apiResource('enderecos', EnderecoController::class);
});