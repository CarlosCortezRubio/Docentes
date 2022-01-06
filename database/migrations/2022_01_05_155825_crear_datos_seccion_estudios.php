<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearDatosSeccionEstudios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admision.adm_seccion_estudios', function (Blueprint $table) {
            DB::table('admision.adm_seccion_estudios')->insert(["codi_secc_sec"=>'05001',"estado"=>'A']);
            DB::table('admision.adm_seccion_estudios')->insert(["codi_secc_sec"=>'05002',"estado"=>'A']);
            DB::table('admision.adm_seccion_estudios')->insert(["codi_secc_sec"=>'05003',"categoria"=>'Edad de 9 a 11',"edad_min"=>9,"edad_max"=>11,"estado"=>'A']);
            DB::table('admision.adm_seccion_estudios')->insert(["codi_secc_sec"=>'05003',"categoria"=>'Edad de 12 a 17',"edad_min"=>12,"edad_max"=>17,"estado"=>'A']);
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
