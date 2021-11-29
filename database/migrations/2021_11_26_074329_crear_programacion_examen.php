<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearProgramacionExamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_programacion_examen', function (Blueprint $table) {
            $table->id('id_programacion_examen');
            $table->string('descripcion');
            $table->dateTime('fecha_resol');
            $table->integer('minutos');
            $table->char('modalidad',1);
            $table->char('estado',1);
            $table->timestamps();
            $table->bigInteger('id_examen');
            $table->bigInteger('id_cupos');
            $table->bigInteger('user_regi');
            $table->bigInteger('id_aula');
            $table->bigInteger('user_actu')->nullable();
            
            $table->foreign('user_regi')->references('id')->on('admision.adm_usuario')->onDelete('cascade');
            $table->foreign('user_actu')->references('id')->on('admision.adm_usuario')->onDelete('cascade');
            $table->foreign('id_aula')->references('id_aula')->on('admision.adm_aula')->onDelete('cascade');
            $table->foreign('id_examen')->references('id_examen')->on('admision.adm_examen')->onDelete('cascade');
            $table->foreign('id_cupos')->references('id_cupos')->on('admision.adm_cupos')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admision.adm_programacion_examen');
    }
}
