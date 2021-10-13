<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\FormaPago;
use App\Models\Pedido;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mesActual = now()->month;
        $mesAnterior = now()->setMonth($mesActual - 6)->month;
        $pedidosStatistics = DB::table('pedidos')
                        ->select(DB::raw('month(created_at) as mes,count(1) as cantidad'))
                        ->whereRaw("month(created_at) between {$mesAnterior} and {$mesActual}")
                        ->groupByRaw("month(created_at)")->get()
                        ->map(function($pedido){
                            $pedido->mes = now()->setMonth($pedido->mes)->monthName;
                            return $pedido;
                        });
        $pedidos = Pedido::get()->count();
        $productos = Producto::get()->count();
        $clientes = Cliente::get()->count();
        $formaPagos = FormaPago::get()->count();
        return view('home',compact('productos','clientes','formaPagos','pedidos','pedidosStatistics'));
    }
}
