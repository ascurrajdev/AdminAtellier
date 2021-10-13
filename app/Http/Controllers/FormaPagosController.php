<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPago;

class FormaPagosController extends Controller
{
    public function index(){
        $formaPagos = FormaPago::paginate();
        return view("forma-pagos.index",compact("formaPagos"));
    }

    public function create(){
        return view('forma-pagos.create');
    }

    public function store(Request $request){
        $request->validate([
            "forma" => ["required","string"]
        ]);
        FormaPago::create([
            "forma" => $request->forma
        ]);
        return redirect()->route("forma-pagos.index")->with([
            "registerSuccess" => "Se ha registrado la forma de pago correctamente"
        ]);
    }
}
