@php
    $programas=getProgramas();
@endphp
<div class=" col-md col-sm col-xs">
    <label for="codi_espe_esp">Programa de Estudio</label>
    <select name="codi_espe_esp" id="especialidadsearch" class="buscar browser-default custom-select">
        <option value="%">Todos</option>
        @foreach ($programas as $k => $prog)
            <option value="{{ $prog->codi_espe_esp }}"@if ($busqueda->codi_espe_esp == $prog->codi_espe_esp) selected @endif>
                {{ $prog->abre_espe_esp }}</option>
        @endforeach
    </select>
</div>
