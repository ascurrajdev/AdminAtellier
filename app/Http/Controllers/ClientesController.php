<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClientesController extends Controller
{
    public function index(){
        $clientes = Cliente::paginate();
        return view('clientes.index',compact('clientes'));
    }

    public function create(){
        return view('clientes.create');
    }

    public function store(Request $request){
        $request->validate([
            'Nombre_cliente' => ["required",'max:45'],
            'RUC_cliente' => ["required","max:20","unique:clientes"],
            'Correo_cliente' => ["max:100","email","required"],
            "Contacto_cliente" => ["required","max:20"],
            "Direccion_cliente" => ["required","max:100"]
        ]);
        Cliente::create([
            "Nombre_cliente" => $request->Nombre_cliente,
            "RUC_cliente" => $request->RUC_cliente,
            "Correo_cliente" => $request->Correo_cliente,
            "Contacto_cliente" => $request->Contacto_cliente,
            "Direccion_cliente" => $request->Direccion_cliente
        ]);
        return redirect()->route("clientes.index")->with([
            "registerSuccess" => "Se ha registrado el cliente correctamente"
        ]);
    }

    public function edit(Cliente $cliente){
        return view('clientes.edit',compact('cliente'));
    }

    public function update(Cliente $cliente, Request $request){
        $request->validate([
            "Nombre_cliente" => ["required","string","max:45"],
            "RUC_cliente" => ["required","string","max:20"],
            "Correo_cliente" => ["string","max:100","nullable"],
            "Contacto_cliente" => ["required","max:20"],
            "Direccion_cliente" => ["required","max:100"]
        ]);
        $cliente->update($request->only([
            "Nombre_cliente","RUC_cliente","Correo_cliente","Contacto_cliente","Direccion_cliente"
        ]));
        return redirect()->route("clientes.index")->with([
            "updateSuccess" => "El cliente se actualizo correctamente"
        ]);
    }
}
