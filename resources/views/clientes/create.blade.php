@extends('adminlte::page')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            Registrar cliente
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('clientes.store')}}">
                @csrf
                <div class="form-group">
                    <label>Nombre:</label>
                    <input class="form-control @error('Nombre_cliente') is-invalid @enderror" name="Nombre_cliente" placeholder="Ej: Fulanito Valdez" value="{{old('Nombre_cliente')}}"/>
                    @error('Nombre_cliente')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Ruc:</label>
                    <input class="form-control @error('RUC_cliente') is-invalid @enderror" name="RUC_cliente" placeholder="Ej: 4444444-4" value="{{old('RUC_cliente')}}"/>
                    @error('RUC_cliente')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Correo:</label>
                    <input class="form-control @error('Correo_cliente') is-invalid @enderror" name="Correo_cliente" type="email" placeholder="Ej: info@examplde.com" value="{{old('Correo_cliente')}}"/>
                    @error('Correo_cliente')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Contacto:</label>
                    <input class="form-control @error('Contacto_cliente') is-invalid @enderror" name="Contacto_cliente" placeholder="Ej: 0991 631870" value="{{old('Contacto_cliente')}}"/>
                    @error('Contacto_cliente')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Direccion:</label>
                    <input class="form-control @error('Direccion_cliente') is-invalid @enderror" name="Direccion_cliente" placeholder="Ej: Fulgencio Yegros 435 c/ Fulgencio R Moreno" value="{{old('Direccion_cliente')}}"/>
                    @error('Contacto_cliente')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Guardar <i class="far fa-save"></i></button>
                <a href="{{route('clientes.index')}}" class="btn btn-secondary btn-lg">Atras <i class="fas fa-undo"></i></a>
            </form>
        </div>
    </div>
@endsection