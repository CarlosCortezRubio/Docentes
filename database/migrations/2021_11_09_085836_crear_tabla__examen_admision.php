<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaExamenAdmision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_examen_admision', function (Blueprint $table) {
            $table->id('id_examen_admision');
            $table->char('cara_elim',1);
            $table->char('flag_jura',1);
            $table->Integer('peso');
            $table->bigInteger('id_seccion');
            $table->foreign('id_seccion')->references('id_seccion')->on('admision.adm_seccion_estudios')->onDelete('cascade');
            $table->bigInteger('id_examen');
            $table->foreign('id_examen')->references('id_examen')->on('admision.adm_examen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admision.adm_examen_admision');
    }
}
