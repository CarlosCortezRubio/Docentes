<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaSeccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_seccion_examen', function (Blueprint $table) {
            $table->id('id_seccion_examen');
            $table->string('descripcion');
            $table->integer('porcentaje');
            $table->char('estado',1);
            $table->bigInteger('id_examen');
            $table->foreign('id_examen')->references('id_examen')->on('admision.adm_examen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admision.adm_seccion_examen');
    }
}
