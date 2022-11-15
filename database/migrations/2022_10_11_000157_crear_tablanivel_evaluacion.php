<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablanivelEvaluacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_nivelevaluacion', function (Blueprint $table) {
            $table->id('id_nivel');
            $table->bigInteger('id_up_nivel')->nullable();
            $table->bigInteger('id_seccion');
            $table->bigInteger('nivel');
            $table->bigInteger('porcentaje')->nullable();
            $table->string('descripcion');
            $table->foreign('id_up_nivel')->references('id_nivel')->on('admision.adm_nivelevaluacion')->onDelete('cascade');
            $table->foreign('id_seccion')->references('id_seccion')->on('admision.adm_seccion_estudios')->onDelete('cascade');
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
