@extends('evaluacion.Ficha.template')
@section('header')
    <img src="{{ asset('img/logo_cnm.png') }}">
@endsection

@section('content')
    <table border="0">
        <tr>
            <td width="180px">&nbsp;</td>
            <td width="10px">&nbsp;</td>
            <td width="200px">&nbsp;</td>
            <td width="10px">&nbsp;</td>
            <td width="120px">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">
                <h3>FICHA DE INSCRIPCIÓN</h3>
            </td>
            <td rowspan="4"></td>
            <td rowspan="4"><img style="width:118px; border: 1px solid gray;"
                    src="{{ empty($ficha->foto_post_per) ? asset('img/sin-foto.png') : config('app.url_admision') . '/images/persons/' . $ficha->foto_post_per }}"
                    alt=""></td>
        </tr>
        <tr>
            <td class="td-right">Nº Expediente:</td>
            <td rowspan="3"></td>
            <td>
                {{ $ficha->nume_expe_exp }}
            </td>
        </tr>
        <tr>
            <td class="td-right">Sección a la que postula:</td>
            <td>{{ $ficha->seccion }}</td>
        </tr>
        <tr>
            <td class="td-right">Especialidad a la que postula:</td>
            <td>{{ $ficha->especialidad }}</td>
        </tr>
        <tr>
            <td colspan="5">
                <h4>Datos Personales:</h4>
            </td>
        </tr>
        <tr>
            <td class="td-right">Apellido paterno:</td>
            <td rowspan="16"></td>
            <td colspan="3">{{ $ficha->apel_pate_per }}</td>
        </tr>
        <tr>
            <td class="td-right">Apellido materno:</td>
            <td colspan="3">{{ $ficha->apel_mate_per }}</td>
        </tr>
        <tr>
            <td class="td-right">Nombres:</td>
            <td colspan="3">{{ $ficha->nomb_pers_per }}</td>
        </tr>
        <!-- sumarle al rowsoan la cant de filas -->
        <tr>
            <td class="td-right">País de nacimiento:</td>
            <td colspan="3">{{ $ficha->pais }}</td>
        </tr>
        <tr>
            <td class="td-right">Fecha de nacimiento:</td>
            <td colspan="3">{{ $ficha->fech_naci_pos }}</td>
        </tr>
        <tr>
            <td class="td-right">Edad:</td>
            <td colspan="3">{{ $ficha->edad_calc_pos }} años</td>
        </tr>
        <tr>
            <td class="td-right">Lugar de residencia:</td>
            <td colspan="3">
                {{ isset($ubigeoDom->nomb_depa_ubg) ? $ubigeoDom->nomb_depa_ubg . ', ' . $ubigeoDom->nomb_prov_ubg . ', ' . $ubigeoDom->nomb_dist_ubg : '' }}
            </td>
        </tr>
        <tr>
            <td class="td-right">Teléfono celular:</td>
            <td colspan="3">{{ $ficha->telf_celu_per }}</td>
        </tr>
        <tr>
            <td class="td-right">Teléfono fijo:</td>
            <td colspan="3">{{ $ficha->telf_fijo_per }}</td>
        </tr>
        <tr>
            <td class="td-right">Correo electrónico:</td>
            <td colspan="3">{{ $ficha->email }}</td>
        </tr>

        <tr>
            <td class="td-right">Lugar dónde se preparó:</td>
            <td colspan="3">
                {{ $ficha->tipo_prep_pos == 'C' ? 'Cursos de extensión' : ($ficha->tipo_prep_pos == 'A' ? 'Academia' : 'Otro') }}
            </td>
        </tr>
        <tr>
            <td class="td-right">Especialidad / profesor:</td>
            @if ($ficha->tipo_prep_pos == 'C')
                <td colspan="3">{{ $especialidad_estudio . ' / ' . $profesor }}</td>
            @else
                <td colspan="3">{{ $ficha->desc_prep_pos }}</td>
            @endif
        </tr>
        @if ($ficha->codi_secc_sec != '05001')
            <tr>
                <td class="td-right">Nivel de Estudio:</td>
                <td colspan="3">
                    @if ($ficha->nive_estu_adm == 'P')
                        Primaria
                    @elseif($ficha->nive_estu_adm == 'S')
                        Secundaria
                    @endif
                </td>
            </tr>
            <tr>
                <td class="td-right">Grado de Estudio:</td>
                <td colspan="3"> @switch($ficha->grad_estu_adm)
                        @case(1)
                            Primero
                        @break

                        @case(2)
                            Segundo
                        @break

                        @case(3)
                            Tercero
                        @break

                        @case(4)
                            Cuarto
                        @break

                        @case(5)
                            Quinto
                        @break

                        @case(6)
                            Sexto
                        @break
                    @endswitch
                    Grado </td>
            </tr>
        @endif
        @if ($ficha->flag_disc_adm == 'S')
            <tr>
                <td class="td-right">Discapacidad:</td>
                <td colspan="3">{{ $ficha->disc_soli_adm }}</td>
            </tr>
        @endif
        @if ($ficha->edad_calc_pos < 18)
            <tr>
                <td colspan="5">
                    <h4>Datos del Padre o Apoderado:</h4>
                </td>
            </tr>
            <tr>
                <td class="td-right">Apellidos y nombres:</td>
                <td rowspan="3"></td>
                <td colspan="3">{{ $ficha->apel_nomb_apd }}</td>
            </tr>
            <tr>
                <td class="td-right">DNI:</td>
                <td colspan="3">{{ $ficha->nume_docu_apd }}</td>
            </tr>
            <tr>
                <td class="td-right">Teléfono:</td>
                <td colspan="3">{{ $ficha->telf_fijo_apd }}</td>
            </tr>
        @endif
    </table>
    <p style="page-break-before:always;"></p>
    <h3>FICHA DE REPERTORIO Y/O TRABAJOS A PRESENTAR</h3>
    <table border="0">
        <tr>
            <td class="td-right">Documento de identidad:</td>
            <td>{{ $ficha->abre_tipo_doc . '  ' . $ficha->nume_docu_per }}</td>
        </tr>
        <tr>
            <td class="td-right">Nº Expediente:</td>
            <td>{{ $ficha->nume_expe_exp }}</td>
        </tr>
        <tr>
            <td class="td-right">Lugar dónde se preparó:</td>
            <td>{{ $ficha->tipo_prep_pos == 'C' ? 'Cursos de extensión' : ($ficha->tipo_prep_pos == 'A' ? 'Academia' : 'Otro') }}
            </td>
        </tr>
        <tr>
            <td class="td-right">Especialidad / profesor:</td>
            <td>{{ $ficha->desc_prep_pos }}</td>
        </tr>
    </table>
    <br>
    <span>INTERPRETACIÓN (Estudios y repertorio, se detalla movimientos o secciones)</span>
    <table border="0">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="200px">&nbsp;</td>
            <td width="200px">&nbsp;</td>
            <td width="120px">&nbsp;</td>
        </tr>
        <tr>
            <th colspan="4" style="background-color: #d6d6d6; text-align: center;">TÉCNICA: Escalas y Estudios</th>
        </tr>
        <tr>
            <td colspan="4">{{ $ficha->tecn_post_pos }}</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <th colspan="4" style="background-color: #d6d6d6; text-align: center;">REPERTORIO</th>
        </tr>
        <tr>
            <th>Nº</th>
            <th>COMPOSITOR</th>
            <th>OBRA</th>
            <th>DURACIÓN</th>
        </tr>
        @foreach ($repertorio as $index => $element)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $element->auto_repe_rep }}</td>
                <td>{{ $element->obra_repe_rep }}</td>
                <td>{{ $element->dura_repe_rep . ' min.' }}</td>
            </tr>
        @endforeach
        {{--<tr>
            <td colspan="4" height="20px">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">TRABAJOS (En caso de ser requerido por la especialidad)</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <th colspan="4" style="background-color: #d6d6d6; text-align: center;">TRABAJOS</th>
        </tr>
        <tr>
            <th>Nº</th>
            <th>OBRA O TRABAJO</th>
            <th>INSTRUMENTACI&Oacute;N</th>
            <th>COMENTARIOS</th>
        </tr>
        @foreach ($trabajos as $index => $element)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $element->obra_trab_tra }}</td>
                <td>{{ $element->inst_trab_tra }}</td>
                <td>{{ $element->comn_trab_tra }}</td>
            </tr>
        @endforeach--}}
    </table>
@endsection
@section('footer')
    <span>&copy; {{ date('Y') }} Conservatorio Nacional de M&uacute;sica. Todos los derechos reservados.</span>
@endsection
