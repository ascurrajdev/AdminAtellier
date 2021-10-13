@extends('adminlte::page')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">Listado de productos</h2>
        </div>
        <div class="card-body">
            <a href="{{route('productos.create')}}" class="btn btn-primary mb-3">Agregar Producto <i class="fas fa-plus"></i></a>
            @if($productos->count() < 1)
            <x-adminlte-alert theme="info" title="Info">
                No hay productos registrados
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
            @if($productos->count() >= 1)
                <div class="table-responsive">
                    <table class="table table-borderless table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Precio</th>
                                <th>Descripcion</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $item => $producto)
                            <tr>
                                <td>{{$item + 1}}</td>
                                <td>Gs {{number_format($producto->Precio,0,',','.')}}</td>
                                <td>{{$producto->Descripcion}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route('productos.edit',$producto)}}">Modificar <i class="fas fa-pen"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{$productos->links()}}
        </div>
    </div>
@endsection