@extends('adminlte::page')
@section('title', 'Notas Admision 2022')
@section('content_header')
    <form id="busqueda" action="{{ route('NotasJurado.cargar') }}" method="get">
        @csrf
        <div class="container">
            <div class="row">
                @include('layouts.filter.index', ['filtro' => 'anio', 'tipo' => 3, 'required' => true])
                @include('layouts.filter.index', ['filtro' => 'seccion', 'tipo' => 1])
                @include('layouts.filter.index', ['filtro' => 'examenjurado', 'tipo' => 1])
                <div class="col-md col-sm col-xs centrar-content flex-center btn-search">
                    <a href="#" onclick="formulario('#busqueda')" type="submit" class="btn btn-info"><i
                            class="fas fa-search "></i> Buscar</a>
                </div>
            </div>
        </div>
    </form>
@stop
@section('content')
    <div class="card">
        <div class="card-header row">
            <div class='col-1'>
                <button id="btnExport" onclick="exportReportToCSV(this)" class='btn btn-success'><i class="fa fa-file-csv"
                        aria-hidden="true"></i> CSV</button>
            </div>
            <div class='col-1'>
                <button id="btnExport" onclick="exportReportToExcel(this)" class='btn btn-success'><i class="fa fa-file-csv"
                        aria-hidden="true"></i> Excel</button>
            </div>
        </div>
        <div class="card-body" style="overflow: scroll;height: 65vh;">
            <table id="table" class=" table tprincipal table-striped">

            </table>
        </div>
    </div>
@stop
@section('css')
    <style>
        td,
        th {
            text-align: center;
            vertical-align: middle !important;
        }
    </style>
@stop
@section('js')
    <script type="text/javascript">
        function formulario(id) {
            var form = $(id);
            var url = form.attr('action');

            $.ajax({
                type: form.attr('method'),
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    $('#table').html("<center>Cargando...</center>");
                },
                success: function(data) {
                    $('#table').html(data);
                },
                error: function(data) {
                    alert("ha  ocurrido un error");
                }
            });
        }

        function exportReportToCSV() {
            let table = document.getElementsByTagName("table");
            TableToExcel.convert(table[0], {
                name: `Notas{{ date('ddmmY') }}.csv`,
                sheet: {
                    name: 'Notas'
                }
            });
        }

        function exportReportToExcel() {
            let table = document.getElementsByTagName("table");
            TableToExcel.convert(table[0], {
                name: `Notas{{ date('ddmmY') }}.xlsx`,
                sheet: {
                    name: 'Notas'
                }
            });
        }
    </script>


@stop
