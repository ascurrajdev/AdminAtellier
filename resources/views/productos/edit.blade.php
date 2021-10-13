@extends('adminlte::page')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Editar producto</h2>
        </div>
        <div class="card-body">
            <form action="{{route('productos.update',$producto)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Precio:</label>
                    <input name="Precio" class="form-control" type="number" placeholder="Ej: 20000 " value="{{$producto->Precio}}"/>
                </div>
                <div class="form-group">
                    <label>Descripcion:</label>
                    <textarea class="form-control" placeholder="Ej: Vestido de fiesta rojo" name="Descripcion">{{$producto->Descripcion}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Guardar <i class="far fa-save"></i></button>
                <a href="{{route('productos.index')}}" class="btn btn-secondary btn-lg">Atras <i class="fas fa-undo"></i></a>
            </form>
        </div>
    </div>
@endsection