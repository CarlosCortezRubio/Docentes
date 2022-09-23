@if (is_admin())
<div class="col-md col-sm col-xs">
    <label for="seccion">Sección</label>
    <select class="buscar form-control" name="seccion" id="seccionsearch">
        <option value="%">Todos</option>
        <@foreach ($secciones as $key => $secc)
            <option @if (getIdSeccion() == $secc->id_seccion || $busqueda->seccion == $secc->id_seccion) selected @endif value="{{ $secc->id_seccion }}">
                {{ $secc->abre_secc_sec }}
                @if ($secc->categoria)
                    -{{ $secc->categoria }}
                @endif
            </option>
        @endforeach
    </select>
</div>
@endif
