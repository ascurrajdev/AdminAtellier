<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timbrado;

class TimbradosController extends Controller
{
    public function index(){
        $timbrados = Timbrado::paginate();
        return view("timbrados.index",compact('timbrados'));
    }

    public function create(){
        return view("timbrados.create");
    }

    public function store(Request $request){
        $request->validate([
            "nro_timbrado" => ["required","numeric","unique:timbrados"],
            "inicio_vigencia" => ["required","date"],
            "fin_vigencia" => ["required","date","different:inicio_vigencia","after:inicio_vigencia"],
            "desde_nro_habilitado" => ["required","numeric"],
            "hasta_nro_habilitado" => ["required","numeric"]
        ]);
        Timbrado::create([
            "nro_timbrado" => $request->nro_timbrado,
            "inicio_vigencia" => $request->inicio_vigencia,
            "fin_vigencia" => $request->fin_vigencia,
            "desde_nro_habilitado" => $request->desde_nro_habilitado,
            "hasta_nro_habilitado" => $request->hasta_nro_habilitado
        ]);
        return redirect()->route("timbrados.index")->with([
            "registerSuccess" => "El timbrado se ha registrado exitosamente"
        ]);
    }
    
}
