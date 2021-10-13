@extends('adminlte::page')
@section('content')
<div class="row mt-3">
    <div class="col-lg-3">
        <x-adminlte-small-box title="{{$pedidos}}" text="Pedidos" icon="fas fa-clipboard-list"
        theme="danger" url="{{route('pedidos.index')}}" url-text="Ver detalles"/>
    </div>
    <div class="col-lg-3">
        <x-adminlte-small-box title="{{$productos}}" text="Productos" icon="fas fa-dolly-flatbed"
        theme="primary" url="{{route('productos.index')}}" url-text="Ver detalles"/>
    </div>
    <div class="col-lg-3">
        <x-adminlte-small-box title="{{$clientes}}" text="Clientes" icon="fas fa-users"
        theme="warning" url="{{route('clientes.index')}}" url-text="Ver detalles"/>
    </div>
    <div class="col-lg-3">
        <x-adminlte-small-box title="{{$formaPagos}}" text="Forma Pagos" icon="fas fa-users"
        theme="success" url="{{route('forma-pagos.index')}}" url-text="Ver detalles"/>
    </div>
    <canvas id="pedidosStatistics" class="col-lg-12" style="height:40vh;"></canvas>
</div>
@endsection
@push("js")
    <script>
        let canvas = document.getElementById("pedidosStatistics")
        const labels = @json($pedidosStatistics->pluck('mes')->toArray());
        const data = {
        labels: labels,
        datasets: [{
            label: 'Pedidos',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: @json($pedidosStatistics->pluck('cantidad')->toArray()),
        }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {}
        };
        let myChart = new Chart(
            canvas,
            config
        );
    </script>
@endpush
@section('plugins.Chartjs', true)