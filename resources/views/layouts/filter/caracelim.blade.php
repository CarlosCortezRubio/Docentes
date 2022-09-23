<div class=" col-md col-sm col-xs">
    <label for="carac">Carac. Eliminatorio</label>
    <select name="carac" id="caracsearch" class="buscar browser-default custom-select">
        <option value="%">Todos</option>
        <option value="S" @if ($busqueda->carac == 'S') selected @endif>Si</option>
        <option value="N" @if ($busqueda->carac == 'N') selected @endif>No</option>
    </select>
</div>
