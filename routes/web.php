<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FormaPagosController;
use App\Http\Controllers\TimbradosController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\FacturarPedidoController;

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
Route::redirect("/","login");
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function(){
    Route::resource('productos',ProductosController::class)->except([
        'destroy','show'
    ]);
    Route::resource('clientes',ClientesController::class)->except([
        'destroy','show'
    ]);
    Route::resource("forma-pagos",FormaPagosController::class)->only(['index','create','store']);
    Route::resource("timbrados",TimbradosController::class)->only(['index','create','store']);
    Route::resource("pedidos",PedidosController::class)->only(["index","create","store","edit","update"]);
    Route::resource("pedidos.facturas",FacturarPedidoController::class)->only(["index","create","store","show"]);;
});

