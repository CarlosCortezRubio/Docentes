<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CargarDatosAulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admision.adm_aula', function (Blueprint $table) {
            DB::table('admision.adm_aula')->insert(["nombre"=>'101 - Emancipación',"descripcion"=>'101 - Emancipación',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'101 - Salaverry',"descripcion"=>'101 - Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'105 - Emancipación',"descripcion"=>'105 - Emancipación',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'106 - Emancipación',"descripcion"=>'106 - Emancipación',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'106 -Salaverry',"descripcion"=>'106 -Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'107 Emancipación',"descripcion"=>'107 Emancipación',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'109 - Emancipación',"descripcion"=>'109 - Emancipación',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'201 - Salaverry',"descripcion"=>'201 - Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'205 - Salaverry',"descripcion"=>'205 - Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'207 - Salaverry',"descripcion"=>'207 - Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'213 - Salaverry',"descripcion"=>'213 - Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'301 - Salaverry',"descripcion"=>'301 - Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'305 - Salaverry',"descripcion"=>'305 - Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'401 - Carabaya',"descripcion"=>'401 - Carabaya',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'406 - Carabaya',"descripcion"=>'406 - Carabaya',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Auditorio Emancipación',"descripcion"=>'Auditorio Emancipación',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Auditorio Salaverry',"descripcion"=>'Auditorio Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 201',"descripcion"=>'Aula 201',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 202',"descripcion"=>'Aula 202',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 203',"descripcion"=>'Aula 203',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 204',"descripcion"=>'Aula 204',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 205',"descripcion"=>'Aula 205',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 206',"descripcion"=>'Aula 206',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 207',"descripcion"=>'Aula 207',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 301',"descripcion"=>'Aula 301',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 302',"descripcion"=>'Aula 302',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 303',"descripcion"=>'Aula 303',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 304',"descripcion"=>'Aula 304',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 305',"descripcion"=>'Aula 305',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 306',"descripcion"=>'Aula 306',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 307',"descripcion"=>'Aula 307',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 308',"descripcion"=>'Aula 308',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 309',"descripcion"=>'Aula 309',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 310',"descripcion"=>'Aula 310',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 311',"descripcion"=>'Aula 311',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Aula 312',"descripcion"=>'Aula 312',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Electro-acústica',"descripcion"=>'Electro-acústica',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'SALA DE ENSAYO',"descripcion"=>'SALA DE ENSAYO',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Sala de Ensayo Salaverry',"descripcion"=>'Sala de Ensayo Salaverry',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Sala Lenguaje Musical',"descripcion"=>'Sala Lenguaje Musical',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Sótano 2',"descripcion"=>'Sótano 2',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Sótano 3',"descripcion"=>'Sótano 3',"estado"=>'A']);
            DB::table('admision.adm_aula')->insert(["nombre"=>'Sótano 4',"descripcion"=>'Sótano 4',"estado"=>'A']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
