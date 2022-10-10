@php
$examenes = getExamenesJurado();
@endphp
<div class="col-md col-sm col-xs">
    <label for="examen">Examen</label>
    <select class="buscar form-control" name="examen" id="examensearch">
        <option value="%">Todos</option>
        <@foreach ($examenes as $key => $examen)
            <option @if ($busqueda->examen == $examen->id_examen) selected @endif value="{{ $examen->id_examen }}">
                {{ $examen->nombre }}
            </option>
            @endforeach
    </select>
</div>
