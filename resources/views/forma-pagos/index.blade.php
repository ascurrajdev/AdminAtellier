@extends('adminlte::page')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">Listado de formas de pago:</h2>
        </div>
        <div class="card-body">
            <a href="{{route('forma-pagos.create')}}" class="btn btn-primary mb-3">Agregar forma de pago <i class="fas fa-plus"></i></a>
            @if($formaPagos->count() < 1)
                <x-adminlte-alert theme="info" title="Info">
                    No hay productos registrados
                </x-adminlte-alert>
            @endif
            @if(session('registerSuccess'))
            <x-adminlte-alert theme="success" title="Success">
                {{session('registerSuccess')}}
            </x-adminlte-alert>
            @endif
            @if($formaPagos->count() >= 1)
            <div class="table-responsive">
                <table class="table table-borderlees table-striped">
                    <thead>
                        <tr class="thead-dark">
                            <th>ID</th>
                            <th>Forma</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formaPagos as $item => $formaPago)
                            <tr>
                                <td>{{$item + 1}}</td>
                                <td>{{$formaPago->forma}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$formaPagos->links()}}
            @endif
        </div>
    </div>
@endsection