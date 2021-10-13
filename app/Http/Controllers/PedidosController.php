<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cliente;

class PedidosController extends Controller
{
    public function index(){
        $pedidos = Pedido::orderBy('id','desc')->paginate();
        return view("pedidos.index",compact('pedidos'));
    }

    public function create(){
        $clientes = Cliente::get();
        return view("pedidos.create",compact('clientes'));
    }
    
    public function store(Request $request){
        $request->validate([
            "descripcion" => ["required","string","max:255"],
            "cliente_id" => ["required","exists:clientes,id"] 
        ]);

        Pedido::create([
            "descripcion" => $request->descripcion,
            "cliente_id" => $request->cliente_id
        ]);

        return redirect()->route("pedidos.index")->with([
            "registerSuccess" => "Se ha registrado el pedido correctamente"
        ]);
    }

    public function edit(Pedido $pedido,Request $request){
        $clientes = Cliente::get();
        return view("pedidos.edit",compact('pedido','clientes'));
    }

    public function update(Pedido $pedido,Request $request){
        $request->validate([
            "descripcion" => ["required","string"],
            "cliente_id" => ["required","exists:clientes,id"] 
        ]);

        $pedido->update($request->only(["descripcion","cliente_id"]));
        return redirect()->route("pedidos.index")->with([
            "updateSucces" => "El pedido se ha actualizado correctamente"
        ]);
    }
}
