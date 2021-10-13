<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\DetallePago;
use App\Mail\FacturaGenerada;
use App\Models\Timbrado;
use Mail;
use PDF;

class FacturarPedidoController extends Controller
{

    public function index(Pedido $pedido){
        $facturas = Factura::where('pedido_id',$pedido->id)->get();
        return view("facturacion.index",compact('facturas','pedido'));
    }

    public function show(Pedido $pedido,Factura $factura){
        $factura->load(['detalle.producto','timbrado']);
        $pdf = PDF::loadView("pdf.factura",compact('factura'));
        return $pdf->stream();
    }

    public function create(Pedido $pedido){
        return view("facturacion.create",compact('pedido'));
    }

    public function store(Pedido $pedido,Request $request){
        $request->validate([
            "razon_social" => ["required","string"],
            "ruc" => ["required","string"]
        ]);
        $pedido->load('cliente');
        $detalleFactura = collect(json_decode($request->detalle,true));
        $detallePago = collect(json_decode($request->pagos,true));
        $ultimaFactura = Factura::orderBy("id","desc")->first();
        $timbrado = Timbrado::orderBy('id','desc')->first();
        if(!($ultimaFactura instanceof Factura)){
            $ultimaFactura = $timbrado->desde_nro_habilitado;
        }else{
            $ultimaFactura = $ultimaFactura->nro_factura;
        }
        $factura = Factura::create([
            "total" => $detalleFactura->sum('precioTotal'),
            "iva" => $detalleFactura->sum('iva'),
            "pedido_id" => $pedido->id,
            "timbrado_id" => $timbrado->id,
            "razon_social" => $request->razon_social,
            "ruc" => $request->ruc,
            "nro_factura" => $ultimaFactura + 1
        ]);
        foreach($detalleFactura as $detalle){
            DetalleFactura::create([
                "cantidad" => $detalle["cantidad"],
                "factura_id" => $factura->id,
                "monto_a_pagar" => $detalle["precioTotal"],
                "producto_id" => $detalle["productoId"]
            ]);
        }
        foreach($detallePago as $detalle){
            DetallePago::create([
                "monto" => $detalle["monto"],
                "factura_id" => $factura->id,
                "nro_transferencia" => $detalle["nroTransferencia"] ?? 1,
                "forma_pago_id" => $detalle["formaId"]
            ]);
        }
        $factura->load(["timbrado","detalle.producto"]);
        $correo = $pedido->cliente->Correo_cliente;
        Mail::to("{$correo}")->send(new FacturaGenerada($factura));
        return redirect()->route('pedidos.facturas.index',$pedido)->with([
            "registerSuccess" => "La factura se genero correctamente"
        ]);
    }
}
