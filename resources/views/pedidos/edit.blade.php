@extends("adminlte::page")
@section("content")
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">Modificar un pedido</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('pedidos.update',$pedido)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Descripcion</label>
                    <x-adminlte-text-editor name="descripcion">{{$pedido->descripcion}}</x-adminlte-text-editor>
                </div>
                <x-adminlte-select2 name="cliente_id">
                    @foreach($clientes as $cliente)
                        @if($cliente->id == $pedido->cliente_id)
                            <option selected value="{{$cliente->id}}">{{$cliente->Nombre_cliente}} {{$cliente->RUC_cliente}}</option>
                        @else
                            <option value="{{$cliente->id}}">{{$cliente->Nombre_cliente}} {{$cliente->RUC_cliente}}</option>
                        @endif
                    @endforeach
                </x-adminlte-select2>
                <button class="btn btn-primary btn-lg">Guardar <i class="far fa-save"></i></button>
                <a class="btn btn-secondary btn-lg" href="{{route('pedidos.index')}}">Atras <i class="fas fa-undo"></i></a>
            </form>
        </div>
    </div>
@endsection
@section('plugins.Summernote', true)