@extends('adminlte::page')

@section('title','Principal')

@section('content')
    <div class="flex-center full-height">
        <div class="content">
            <div class="title m-b-md">
                Bienvenido
            </div>
            <div class="text-center">
                {{ Auth::user()->name }}
            </div>
        </div>
    </div>
@stop
@section('css')
<style>
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
