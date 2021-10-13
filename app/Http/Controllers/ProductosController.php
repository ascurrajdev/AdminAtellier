<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductosController extends Controller
{
    public function index(){
        $productos = Producto::paginate();
        return view('productos.index',compact('productos'));
    }

    public function create(){
        return view('productos.create');
    }

    public function store(Request $request){
        $request->validate([
            "Precio" => ["required","max:20"],
            "Descripcion" => ["required","max:45"]
        ]);
        Producto::create([
            "Precio" => $request->Precio,
            "Descripcion" => $request->Descripcion
        ]);
        return redirect()->route('productos.index')->with([
            "registerSuccess" => "El producto ha sido registrado exitosamente"
        ]);
    }

    public function edit(Producto $producto){
        return view('productos.edit',compact('producto'));
    }

    public function update(Producto $producto, Request $request){
        $request->validate([
            "Precio" => ["required","max:20"],
            "Descripcion" => ["required","max:45"]
        ]);
        $producto->update([
            "Precio" => $request->Precio,
            "Descripcion" => $request->Descripcion
        ]);
        return redirect()->route('productos.index')->with([
            "updateSuccess" => "Se ha actualizado el producto correctamente"
        ]);
    }
}
