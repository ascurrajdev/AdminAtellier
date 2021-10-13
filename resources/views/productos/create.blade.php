@extends('adminlte::page')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Registrar producto</h2>
        </div>
        <div class="card-body">
            <form action="{{route('productos.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Precio:</label>
                    <input name="Precio" class="form-control @error('Precio') is-invalid @enderror" type="number" placeholder="Ej: 20000 "/>
                    @error('Precio')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Descripcion:</label>
                    <textarea class="form-control @error('Descripcion') is-invalid @enderror" placeholder="Ej: Vestido de fiesta rojo" name="Descripcion"></textarea>
                    @error('Descripcion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Guardar <i class="far fa-save"></i></button>
                <a href="{{route('productos.index')}}" class="btn btn-secondary btn-lg">Atras <i class="fas fa-undo"></i></a>
            </form>
        </div>
    </div>
@endsection