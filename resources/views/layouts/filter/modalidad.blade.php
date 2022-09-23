<div class="col-md col-sm col-xs">
    <label for="modalidad">Modalidad</label>
    <select class="buscar form-control" name="modalidad" id="modalidadsearch">
        <option value="%">Todos</option>
        <option value="P" @if ($busqueda->modalidad == 'P') selected @endif>Presencial</option>
        <option value="V" @if ($busqueda->modalidad == 'V') selected @endif>Virtual</option>
    </select>
</div>
