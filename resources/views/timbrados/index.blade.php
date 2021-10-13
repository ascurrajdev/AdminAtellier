@extends("adminlte::page")
@section("content")
<div class="card mt-3">
    <div class="card-header">
        <h2 class="card-title">Listado de timbrados para la factura</h2>
    </div>
    <div class="card-body">
        <a href="{{route('timbrados.create')}}" class="btn btn-primary mb-3">Agregar timbrado <i class="fas fa-plus"></i></a>
        @if($timbrados->count() < 1)
        <x-adminlte-alert theme="info" title="Info">
            No hay timbrados registrados
        </x-adminlte-alert>
        @endif
        @if(session('registerSuccess'))
            <x-adminlte-alert theme="success" title="Success">
                {{session('registerSuccess')}}
            </x-adminlte-alert>
            @endif
        @if($timbrados->count() >= 1)
            <div class="table-responsive">
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nro de timbrado</th>
                            <th>Inicio de vigencia</th>
                            <th>Fin de vigencia</th>
                            <th>Desde nro habilitado</th>
                            <th>Hasta nro habilitado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timbrados as $item => $timbrado)
                            <tr>
                                <td>{{$item}}</td>
                                <td>{{$timbrado->nro_timbrado}}</td>
                                <td>{{$timbrado->inicio_vigencia}}</td>
                                <td>{{$timbrado->fin_vigencia}}</td>
                                <td>{{$timbrado->desde_nro_habilitado}}</td>
                                <td>{{$timbrado->hasta_nro_habilitado}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection