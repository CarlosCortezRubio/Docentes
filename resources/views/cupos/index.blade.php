@extends('adminlte::page')
@section('title','Cupos')

@section('content_header')
    <form class="row">
        <div class="col-md col-sm col-xs">
            <label for="">Programa de Estudio</label>
            <select class="buscar browser-default custom-select">
                <option >Todos</option>
                <option selected value="">Guitarra</option>
                <option value="">Violín</option>
                <option value="">Violonchelo</option>
            </select>
        </div>
        <div class="col-md col-sm col-xs">
            <label for="espec" >Periodo</label>
            <select class="buscar form-control" name="espec" id="espec">
                <option value="">Todos</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
        </div>
        <div class="col-md col-sm col-xs">
            <label for="">Secciòn</label>
            <select class="buscar browser-default custom-select">
                <option >Todos</option>
                <option value="">Superior</option>
                <option value="">Escolar</option>
                <option value="">Post. Escolar</option>
            </select>
        </div>
        <div class="col-md col-sm col-xs flex-center btn-search">
            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Buscar</button>
        </div>
    </form>
@stop
@section('content')
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
                        <th scope="col">Seccion</th>
                        <th scope="col">Cantidad de Cupos</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Guitarra</td>
                        <td>2019</td>
                        <td>Escolar</td>
                        <td>25</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fa fa-trash'></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Violin</td>
                        <td>2020</td>
                        <td>Escolar</td>
                        <td>12</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fa fa-trash'></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Violonchelo</td>
                        <td>2021</td>
                        <td>Escolar</td>
                        <td>12</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fas fa-trash'></button>
                        </td>  
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @extends('cupos.partials.agregar')
    @extends('cupos.partials.editar')
    @extends('cupos.partials.eliminar')
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