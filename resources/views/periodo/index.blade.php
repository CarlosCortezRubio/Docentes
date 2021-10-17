@extends('adminlte::page')
@section('title','Periodos')

@section('content_header')
    
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class='col'>
                <button data-toggle="modal" data-target="#modaladd" class='btn btn-success'><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</button>
            </div>
        </div>
        <div class="card-body"> 
            <table class="tablaresponse table tprincipal table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Año</th>
                        <!--<th scope="col">Seccion</th>-->
                        <th scope="col">Peri. Inscripciones</th>
                        <th scope="col">Peri. Evaluaciones</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>2019</td>
                       <!-- <td>Superior</td>-->
                        <td>12/01/2019 - 16/01/2019</td>
                        <td>17/01/2019 - 22/01/2019</td>
                        <td>Activo</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fa fa-times'></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>2020</td>
                         <!--<td>Escolar</td>-->
                        <td>12/01/2020 - 16/01/2020</td>
                        <td>17/01/2020 - 22/01/2020</td>
                        <td>Activo</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fa fa-times'></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>2022</td>
                         <!--<td>Post. Escolar</td>-->
                        <td>12/01/2022 - 16/01/2022</td>
                        <td>17/01/2022 - 22/01/2022</td>
                        <td>Activo</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fa fa-times'></button>
                        </td>  
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @extends('periodo.partials.agregar')
    @extends('periodo.partials.editar')
    @extends('periodo.partials.eliminar')
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