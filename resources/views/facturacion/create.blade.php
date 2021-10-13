@extends("adminlte::page")
@section("content")
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">Registrar la factura</h2>
        </div>
        <div class="card-body">
            <form id="formulario" method="POST" action="{{route('pedidos.facturas.store',$pedido)}}">
                @csrf
                <div class="form-group">
                    <label>Razon social:</label>
                    <input class="form-control @error('razon_social') is-invalid @enderror" name="razon_social" placeholder="Ej: Fulatino Martinez"/>
                    @error("razon_social")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Ruc:</label>
                    <input class="form-control @error('ruc') is-invalid @enderror" name="ruc" placeholder="Ej: 444444-4"/>
                    @error("ruc")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div id="section">
                    <factura-details />
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{mix('js/facturacion/create.js')}}"></script>
@endpush