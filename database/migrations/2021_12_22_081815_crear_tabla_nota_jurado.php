<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaNotaJurado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_nota_jurado', function (Blueprint $table) {
            $table->id('id_notajurado');
            $table->bigInteger('id_jurado_postulante');
            $table->bigInteger('id_seccion_examen');
            $table->Integer('nota')->nullable();
            $table->foreign('id_jurado_postulante')->references('id_jurado_postulante')->on('admision.adm_jurado_postulante')->onDelete('cascade');
            $table->foreign('id_seccion_examen')->references('id_seccion_examen')->on('admision.adm_seccion_examen')->onDelete('cascade');
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
