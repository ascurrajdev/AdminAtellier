@extends('adminlte::page')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">Registrar forma de pago:</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('forma-pagos.store')}}">
                @csrf
                <div class="form-group">
                    <label for="forma">Forma:</label>
                    <input class="form-control" name="forma" id="forma" placeholder="Ej: Efectivo"/>
                </div>
                <button class="btn btn-primary btn-lg">Guardar <i class="far fa-save"></i></button>
                <a class="btn btn-secondary btn-lg" href="{{route('forma-pagos.index')}}">Atras <i class="fas fa-undo"></i></a>
            </form>
        </div>
    </div>
@endsection