@extends('adminlte::page')
@section('css')
    <style>
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            padding-top: 25px
        }
        .full-height {
            height: 100vh;
        }
    
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
    
     
    
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .m-b-md {
            margin-bottom: 30px;
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
                "responsive": true,
                "info": false,
                "stateSave": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }],
                "pageLength": 100
            });
        });
    </script>
@stop
