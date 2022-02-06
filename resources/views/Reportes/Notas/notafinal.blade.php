@extends('adminlte::page')
@section('title', 'Examen')

@section('content_header')
    <form class="row centrar-content">
        <div class="col-md col-sm-3 col-xs-3">
            <label for="espec">Periodo</label>
            <select class="buscar form-control" name="espec" id="espec">
                <option value="">Todos</option>
                <option value="2020">2020(Escolar)</option>
                <option value="2021">2021(Escolar)</option>
                <option value="2022">2022(Escolar)</option>
            </select>
        </div>
        <div class="col-md col-sm-3 col-xs-3">
            <label for="espec">Periodo</label>
            <select class="buscar form-control" name="espec" id="espec">
                <option value="">Todos</option>
                <option value="2020">2020(Escolar)</option>
                <option value="2021">2021(Escolar)</option>
                <option value="2022">2022(Escolar)</option>
            </select>
        </div>
        <div class="col-md col-sm col-xs centrar-content btn-search flex-center">
            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i>Buscar</button>
        </div>

    </form>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class='col'>
                <button data-toggle="modal" data-target="#modaladd" class='btn btn-success'><i class="fa fa-plus"
                        aria-hidden="true"></i> Nuevo</button>
            </div>
        </div>
        <div class="card-body">
            <table class="tablaresponse table tprincipal table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">Especialdad</th>
                        <th scope="col">Postulante</th>
                        <th scope="col">Examen</th>
                        <th scope="col">Nota</th>
                        <th scope="col">Nota Final</th>
                    </tr>
                </thead>
                <tbody style='font-size:15px'>
                    @foreach ($reporte as $k => $v)
                        <tr>
                            @if ($loop->first)
                                @foreach ($especialidad as $kes => $ves)
                                    @if ($ves->especialidad == $v->especialidad)
                                        <td rowspan="{{ $ves->count }}">{{ $ves->especialidad }}</td>
                                    @endif
                                @endforeach
                            @else
                                @if ($reporte[$k]->especialidad != $reporte[$k - 1]->especialidad)
                                    @foreach ($especialidad as $kes => $ves)
                                        @if ($ves->especialidad == $v->especialidad)
                                            <td rowspan="{{ $ves->count }}">{{ $ves->especialidad }}</td>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                            @if ($loop->first)
                                @foreach ($postulantes as $kp => $vp)
                                    @if ($vp->nombre == $v->nombre)
                                        <td rowspan="{{ $vp->count }}">{{ $vp->nombre }}</td>
                                    @endif
                                @endforeach
                            @else
                                @if ($reporte[$k]->nombre != $reporte[$k - 1]->nombre)
                                    @foreach ($postulantes as $kp => $vp)
                                        @if ($vp->nombre == $v->nombre)
                                            <td rowspan="{{ $vp->count }}">{{ $vp->nombre }}</td>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                            <td>{{ $v->examen }}</td>
                            <td>{{ $v->nota }}</td>
                            @if ($loop->first)
                                @foreach ($postulantes as $kp => $vp)
                                    @if ($vp->nombre == $v->nombre)
                                        <td rowspan="{{ $vp->count }}">{{ $vp->final }}</td>
                                    @endif
                                @endforeach
                            @else
                                @if ($reporte[$k]->nombre != $reporte[$k - 1]->nombre)
                                    @foreach ($postulantes as $kp => $vp)
                                        @if ($vp->nombre == $v->nombre)
                                            <td rowspan="{{ $vp->count }}">{{ $vp->final }}</td>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('css')
<style>
    td,th{
        text-align: center; 
        vertical-align: middle !important;
    }
</style>
@stop
@section('js')
@stop
