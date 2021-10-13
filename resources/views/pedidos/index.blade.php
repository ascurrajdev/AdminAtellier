@extends("adminlte::page")
@section("content")
    <div class="card mt-3">
        <div class="card-header">
            <h2>Listado de pedidos</h2>
        </div>
        <div class="card-body">
            <a href="{{route('pedidos.create')}}" class="btn btn-primary mb-3">Agregar Pedido <i class="fas fa-plus"></i></a>
            @if($pedidos->count() < 1)
                <x-adminlte-alert theme="info" title="Info">
                    No contiene pedidos registrados
                </x-adminlte-alert>
            @endif
            @if(session('registerSuccess'))
            <x-adminlte-alert theme="success" title="Success">
                {{session('registerSuccess')}}
            </x-adminlte-alert>
            @endif
            @if(session('updateSucces'))
            <x-adminlte-alert theme="success" title="Success">
                {{session('updateSucces')}}
            </x-adminlte-alert>
            @endif
            @if($pedidos->count() >= 1)
                <div class="table-responsive">
                    <table class="table table-borderless table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descripcion</th>
                                <th>Cliente</th>
                                <th>Fecha de registro</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $item => $pedido)
                                <tr>
                                    <td>{{$item + 1}}</td>
                                    <td>{!!$pedido->descripcion!!}</td>
                                    <td>{{$pedido->cliente->Nombre_cliente}}</td>
                                    <td>{{$pedido->created_at}}</td>
                                    <td>
                                        @if($pedido->facturas->count() >= 1)
                                            <a href="{{route('pedidos.facturas.index',$pedido)}}" class="btn btn-warning">Facturas <i class="fas fa-file-invoice-dollar"></i></a>
                                        @else
                                            <a href="{{route('pedidos.facturas.create',$pedido)}}" class="btn btn-primary">Facturar <i class="fas fa-file-invoice-dollar"></i></a>
                                        @endif
                                        <a href="{{route('pedidos.edit',$pedido)}}" class="btn btn-success">Modificar <i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$pedidos->links()}}
            @endif
        </div>
    </div>
@endsection