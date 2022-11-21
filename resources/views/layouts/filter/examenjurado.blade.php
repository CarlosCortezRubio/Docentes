@php
    $examenes = getExamenesJurado();
@endphp
<div class="col-md col-sm col-xs">
    <label for="examen">Examen</label>
    <select class="buscar form-control" style="width: 100%" name="id_examen" id="examensearch">
        <option>---- Seleccione -----</option>
        <@foreach ($examenes as $key => $examen)
            <option @if ($busqueda->examen == $examen->id_examen) selected @endif value="{{ $examen->id_examen }}">
                {{ $examen->nombre }}
            </option>
            @endforeach
    </select>
</div>
