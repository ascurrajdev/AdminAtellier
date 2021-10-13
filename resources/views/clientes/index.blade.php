@extends('adminlte::page')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">Listado de clientes</h2>
        </div>
        <div class="card-body">
            <a href="{{route('clientes.create')}}" class="btn btn-primary mb-3">Agregar Cliente <i class="fas fa-plus"></i></a>
            @if($clientes->count() < 1)
            <x-adminlte-alert theme="info" title="Info">
                No hay clientes registrados
            </x-adminlte-alert>
            @endif
            @if(session('registerSuccess'))
            <x-adminlte-alert theme="success" title="Success">
                {{session('registerSuccess')}}
            </x-adminlte-alert>
            @endif
            @if(session('updateSuccess'))
            <x-adminlte-alert theme="success" title="Success">
                {{session('updateSuccess')}}
            </x-adminlte-alert>
            @endif
            @if($clientes->count() >= 1)
                <div class="table-responsive">
                    <table class="table table-borderless table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Ruc</th>
                                <th>Correo</th>
                                <th>Contacto</th>
                                <th>Direccion</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $item => $cliente)
                                <tr>
                                    <td>{{$item + 1}}</td>
                                    <td>{{$cliente->Nombre_cliente}}</td>
                                    <td>{{$cliente->RUC_cliente}}</td>
                                    <td>{{$cliente->Correo_cliente}}</td>
                                    <td>{{$cliente->Contacto_cliente}}</td>
                                    <td>{{$cliente->Direccion_cliente}}</td>
                                    <td>
                                        <a href="{{route('clientes.edit',$cliente)}}" class="btn btn-success">Modificar <i class="fas fa-user-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{$clientes->links()}}
        </div>
    </div>
@endsection