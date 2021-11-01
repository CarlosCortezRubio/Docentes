@extends('adminlte::page')
@section('title','Cupos')

@section('content_header')
    <form class="row">
        <div class="col-md col-sm col-xs">
            <label for="">Programa de Estudio</label>
            <select class="buscar browser-default custom-select">
                <option value="">Todos</option>
                @foreach ($programas as $k => $prog)
                    <option value="{{ $prog->codi_espe_esp }}">{{ $prog->abre_espe_esp }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md col-sm col-xs">
            <label for="espec" >Periodo</label>
            <select class="buscar form-control" name="espec" id="espec">
                <option value="">Todos</option>
                @foreach ($periodos as $k => $per)
                    <option value="{{ $per->id_periodo }}">{{ $per->anio }}@if (getTipoUsuario()=='Administrador' && getSeccion()==null) ({{ $per->abre_secc_sec }}) @endif</option>
                @endforeach
            </select>
        </div>
        {{--@if (getTipoUsuario()=='Administrador' && getSeccion()==null)
        <div class="col-md col-sm col-xs">
            <label for="">Secciòn</label>
            <select class="buscar browser-default custom-select">
                <option value="">Todos</option>
                @foreach ($secciones as $k => $secc)
                <option value="{{ $secc->codi_secc_sec }}">{{ $secc->abre_secc_sec }}</option>
                @endforeach
            </select>
        </div>
        @endif--}}
        <div class="col-md col-sm col-xs flex-center btn-search">
            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Buscar</button>
        </div>
    </form>
@stop
@section('content')
    <!--------------------------MODALS------------------------------------>
    <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Registrar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cupos.insert') }}" method="post" id="formadd">
                        @csrf
                        <div class="form-group">
                            <div class="row ">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Programa de Estudio</label>
                                    <select class="browser-default custom-select" required name="codi_espe_esp" id="codi_espe_esp">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($programas as $k => $prog)
                                            <option value="{{ $prog->codi_espe_esp }}">{{ $prog->abre_espe_esp }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo</label>
                                    <select class="form-control" required name="id_periodo" id="id_periodo">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($periodos as $k => $per)
                                            <option value="{{ $per->id_periodo }}">{{ $per->anio }}@if (getTipoUsuario()=='Administrador' && getSeccion()==null) ({{ $per->abre_secc_sec }}) @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Cantidad Cupos</label>
                                    <input type="number" class="form-control" required name="cant_cupo" id="cant_cupo" placeholder="Ingrese Cupos" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" class="btn btn-success" form="formadd" >Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------------------------------------->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Editar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                <form action="" class='formulario'>
                        <div class="form-group">
                            <div class="row ">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Programa de Estudio</label>
                                    <select class="browser-default custom-select">
                                        <option value="">---- Seleccione -----</option>
                                        <option selected value="">Guitarra</option>
                                        <option value="">Violín</option>
                                        <option value="">Violonchelo</option>
                                    </select>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo</label>
                                    <select class="form-control" name="espec" id="espec">
                                        <option value="">---- Seleccione -----</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Secciòn</label>
                                    <select class="browser-default custom-select">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($secciones as $k => $secc)
                                        <option value="{{ $secc->codi_secc_sec }}">{{ $secc->abre_secc_sec }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Cantidad Cupos</label>
                                    <input type="number" class="form-control" placeholder="Ingrese Cupos" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Editar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------------------------------------->
    <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Eliminar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea eliminar la configuraciòn de cupos?</p>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------BODY--------------------------------------->
    <div class="card">
        <div class="card-header">
            <div class='col'>
                <button data-toggle="modal" data-target="#modaladd" class='btn btn-success'><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table tablaresponse tprincipal table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Programa de Estudio</th>
                        <th scope="col">Periodo</th>
                        <th scope="col">Cantidad de Cupos</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Guitarra</td>
                        <td>2019</td>
                        <td>25</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fa fa-trash'></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--------------------------------------------------------------------->
@stop
@section('css')
<style>
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
        padding-top: 25px
    }
</style>
@stop
@section('js')
<script>
    $(document).ready(function() {
        $('.buscar').select2();
        $('.tablaresponse').DataTable({
            "language": {
               "url": "{{ asset('js/datatables.spanish.json') }}"
            },
            "order": [[ 1, "asc" ]],
            "info": false,
            "stateSave": true,
            "columnDefs": [
               { "orderable": false, "targets": 0 }
            ],
            "pageLength": 100
         });
    });
</script>
@stop
