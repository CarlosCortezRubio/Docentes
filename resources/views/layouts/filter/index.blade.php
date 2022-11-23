<div class="col-md-4 col-sm-12 col-xs-12">
    @switch($filtro)
        @case('anio')
            @php
                $anioexist = getAnios();
            @endphp
            <label class="row" for="anio">Año</label>
            <select class="buscar row browser-default custom-select" {{'required' ? isset($required) : ''}} name="anio"
                id="aniodosearch">
                @switch($tipo)
                    @case(1)
                        <option value="%">Todos</option>
                    @break

                    @case(2)
                        <option>---- Seleccione -----</option>
                    @break

                    @case(3)
                    @break
                @endswitch
                @foreach ($anioexist as $k => $anio)
                    <option value="{{ $anio->anio }}"@if ($busqueda->anio == $anio->anio) selected @endif>{{ $anio->anio }}
                    </option>
                @endforeach
            </select>
        @break

        @case('descripcionExamen')
            <label class="row" for="desc">Descripción</label>
            <input name="desc" {{'required' ? isset($required) : ''}}
                @if ($busqueda->desc) value='{{ $busqueda->desc }}' @endif placeholder="Ingrese Descripcion"
                id="descsearch" class="form-control" />
        @break

        @case('seccion')
            @if (is_admin())
                @php
                    $secciones = getSecciones();
                @endphp
                <label class="row" for="seccion">Sección</label>
                <select {{'required' ? isset($required) : ''}} class="buscar form-control" name="seccion" id="seccionsearch">
                    @switch($tipo)
                        @case(1)
                            <option value="%">Todos</option>
                        @break

                        @case(2)
                            <option>---- Seleccione -----</option>
                        @break

                        @case(3)
                        @break
                    @endswitch
                    <@foreach ($secciones as $key => $secc)
                        <option @if (getIdSeccion() == $secc->id_seccion || $busqueda->seccion == $secc->id_seccion) selected @endif value="{{ $secc->id_seccion }}">
                            {{ $secc->abre_secc_sec }}
                            @if ($secc->categoria)
                                -{{ $secc->categoria }}
                            @endif
                        </option>
            @endforeach
            </select>
            @endif
        @break

        @case('modalidad')
            <label class="row" for="modalidad">Modalidad</label>
            <select {{'required' ? isset($required) : ''}} class="buscar form-control" name="modalidad" id="modalidadsearch">
                @switch($tipo)
                    @case(1)
                        <option value="%">Todos</option>
                    @break

                    @case(2)
                        <option>---- Seleccione -----</option>
                    @break

                    @case(3)
                    @break
                @endswitch
                <option value="P" @if ($busqueda->modalidad == 'P') selected @endif>Presencial</option>
                <option value="V" @if ($busqueda->modalidad == 'V') selected @endif>Virtual</option>
            </select>
        @break

        @case('ProgramaEstudio')
            @php
                $programas = getProgramas();
            @endphp
            <label class="row" for="codi_espe_esp">Programa de Estudio</label>
            <select {{'required' ? isset($required) : ''}} name="codi_espe_esp" id="especialidadsearch"
                class="buscar browser-default custom-select">
                @switch($tipo)
                    @case(1)
                        <option value="%">Todos</option>
                    @break

                    @case(2)
                        <option>---- Seleccione -----</option>
                    @break

                    @case(3)
                    @break
                @endswitch
                @foreach ($programas as $k => $prog)
                    <option value="{{ $prog->codi_espe_esp }}"@if ($busqueda->codi_espe_esp == $prog->codi_espe_esp) selected @endif>
                        {{ $prog->abre_espe_esp }}</option>
                @endforeach
            </select>
        @break

        @case('exajura')
            <label class="row" for="jura">Examen por Jurado</label>
            <select {{'required' ? isset($required) : ''}} class="buscar form-control" name="jura" id="jurasearch">
                @switch($tipo)
                    @case(1)
                        <option value="%">Todos</option>
                    @break

                    @case(2)
                        <option>---- Seleccione -----</option>
                    @break

                    @case(3)
                    @break
                @endswitch
                <option value="S" @if ($busqueda->jura == 'S') selected @endif>Si</option>
                <option value="N" @if ($busqueda->jura == 'N') selected @endif>No</option>
            </select>
        @break

        @case('caracelim')
            <label class="row" for="carac">Carac. Eliminatorio</label>
            <select {{'required' ? isset($required) : ''}} name="carac" id="caracsearch"
                class="buscar browser-default custom-select">
                @switch($tipo)
                    @case(1)
                        <option value="%">Todos</option>
                    @break

                    @case(2)
                        <option>---- Seleccione -----</option>
                    @break

                    @case(3)
                    @break
                @endswitch
                <option value="S" @if ($busqueda->carac == 'S') selected @endif>Si</option>
                <option value="N" @if ($busqueda->carac == 'N') selected @endif>No</option>
            </select>
        @break

        @case('nombreexamen')
            <label class="row" for="nombre">Nombre de Examen</label>
            <input name="nombre" {{'required' ? isset($required) : ''}}
                @if ($busqueda->nombre) value='{{ $busqueda->nombre }}' @endif placeholder="Ingrese Nombre"
                id="nombresearch" class="form-control" />
        @break

        @case('estado')
            <label class="row" for="estado">Estado</label>
            <select {{'required' ? isset($required) : ''}} class="buscar form-control" name="estado" id="estadosearch">
                @switch($tipo)
                    @case(1)
                        <option value="%">Todos</option>
                    @break

                    @case(2)
                        <option>---- Seleccione -----</option>
                    @break

                    @case(3)
                    @break
                @endswitch
                <option value="A" @if ($busqueda->estado == 'A') selected @endif>Activo</option>
                <option value="I" @if ($busqueda->estado == 'I') selected @endif>Inactivo</option>
            </select>
        @break

        @case('examenjurado')
            @php
                $examenes = getExamenesJurado();
            @endphp
            <label class="row" for="id_examen">Examen</label>
            <select {{'required' ? isset($required) : ''}} class="buscar row form-control" style="width: 100%" name="id_examen"
                id="examensearch">
                @switch($tipo)
                    @case(1)
                        <option value="%">Todos</option>
                    @break

                    @case(2)
                        <option>---- Seleccione -----</option>
                    @break

                    @case(3)
                    @break
                @endswitch
                <@foreach ($examenes as $key => $examen)
                    <option @if ($busqueda->examen == $examen->id_examen) selected @endif value="{{ $examen->id_examen }}">
                        {{ $examen->nombre }}
                    </option>
                    @endforeach
            </select>
        @break

    @endswitch
</div>
