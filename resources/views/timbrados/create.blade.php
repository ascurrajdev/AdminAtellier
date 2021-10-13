@extends("adminlte::page")
@section("content")
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">Registrar el timbrado:</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('timbrados.store')}}">
                @csrf
                <div class="form-group">
                    <label>Nro de timbrado:</label>
                    <input class="form-control @error('nro_timbrado') is-invalid @enderror" name="nro_timbrado" placeholder="Ej: 4444444" type="number"/>
                    @error("nro_timbrado")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Inicio de vigencia:</label>
                    <input class="form-control @error('inicio_vigencia') is-invalid @enderror" name="inicio_vigencia" type="date"/>
                    @error("inicio_vigencia")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Fin de vigencia:</label>
                    <input class="form-control @error('fin_vigencia') is-invalid @enderror" name="fin_vigencia" type="date"/>
                    @error("fin_vigencia")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Desde nro habilitado:</label>
                    <input class="form-control @error('desde_nro_habilitado') is-invalid @enderror" name="desde_nro_habilitado" placeholder="Desde que numero se habilito" type="number"/>
                    @error("desde_nro_habilitado")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Hasta nro habilitado:</label>
                    <input class="form-control @error('hasta_nro_habilitado') is-invalid @enderror" name="hasta_nro_habilitado" placeholder="Hasta que numero se habilito" type="number"/>
                    @error("hasta_nro_habilitado")
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Guardar <i class="far fa-save"></i></button>
                <a class="btn btn-secondary btn-lg" href="{{route('timbrados.index')}}">Atras <i class="fas fa-undo"></i></a>
            </form>
        </div>
    </div>
@endsection