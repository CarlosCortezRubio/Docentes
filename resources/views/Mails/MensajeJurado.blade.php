@extends('layouts.email')
@section('title')
    Estimado(a) {{ $nombre }}
@endsection

@section('content')
    <p>Usted ha sido registrado como jurado para el {{ $subject }}, </p>
    <p
        style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Utilice las siguientes credenciales de acceso.
    </p>
    <div style="border: 1px solid gray;">
        <table width="100%" cellpadding="2" cellspacing="2" role="presentation"
            style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
            <tr>
                <td style="text-align: right">Usuario:</td>
                <td style="text-align: left">{{ $correo }}</td>
            </tr>
            <tr>
                <td style="text-align: right">Contraseña:</td>
                <td style="text-align: left">{{ $contraseña }}</td>
            </tr>
        </table>
    </div>
    <p>Podrá visualizar los cursos programados para usted haciendo clic en el siguiente enlace:</p>
    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation"
        style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; margin: 10px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
        <tbody>
            <tr>
                <td align="center"
                    style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box;">
                    <a target="_blank" rel="noopener noreferrer" href="{{ route('evaluacion') }}"
                        class="button button-primary"
                        style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #fff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3490dc; border-top: 10px solid #3490dc; border-right: 18px solid #3490dc; border-bottom: 10px solid #3490dc; border-left: 18px solid #3490dc;">
                        Evaluar
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection

@section('signature')
    Atentamente,
    <br>
    La Comisión de Admisión
@endsection
