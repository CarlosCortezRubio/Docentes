<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearDatosTipoExamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admision.adm_tipo_examen', function (Blueprint $table) {
            DB::table('admision.adm_tipo_examen')
            ->insert([
                "nombre" => "Examen de Admision",
                "descripcion" => "Examen diseñado para el uso exclusivo del proceso de admisión, mediante la página AdmisionWeb",
                "estado" => 'A',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admision.adm_tipo_examen', function (Blueprint $table) {
            //
        });
    }
}
