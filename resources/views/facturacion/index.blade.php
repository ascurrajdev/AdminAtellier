@extends("adminlte::page")
@section("content")
<div class="card mt-3">
    <div class="card-header">
        <h2 class="card-title">Listado de facturas del pedido:</h2>
    </div>
    <div class="card-body">
        <a class="btn btn-primary mb-3" href="{{route('pedidos.facturas.create',$pedido)}}">Emitir Factura <i class="fas fa-file-invoice-dollar"></i></a>
        @if($facturas->count() < 1)
        <x-adminlte-alert theme="info" title="Info">
            No contiene facturas registradas
        </x-adminlte-alert>
        @endif
        @if($facturas->count() >= 1)
        <div class="accordion" id="accordionExample">
            @foreach($facturas as $item => $factura)
                    <div class="card">
                        <div class="card-header bg-info text-white" id="heading{{$item}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$item}}" aria-expanded="true" aria-controls="collapse{{$item}}">
                                    <p class="text-white">Razon social: {{$factura->razon_social}}</p>
                                    <p class="text-white">Ruc: {{$factura->ruc}}</p>
                                    <p class="text-white">Monto Total: Gs. {{number_format($factura->total)}}</p>
                                    <p class="text-white">Iva: Gs. {{number_format($factura->iva)}}</p>
                                    <p class="text-white">Fecha: {{$factura->created_at}}</p>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse{{$item}}" class="collapse" aria-labelledby="heading{{$item}}" data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table table-striped table-borderless">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Cantidad</th>
                                            <th>Descripcion</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($factura->detalle as $item => $value)
                                            <tr>
                                                <td>{{$item + 1}}</td>
                                                <td>{{$value->cantidad}}</td>
                                                <td>{{$value->producto->Descripcion}}</td>
                                                <td>Gs. {{number_format($value->monto_a_pagar)}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection