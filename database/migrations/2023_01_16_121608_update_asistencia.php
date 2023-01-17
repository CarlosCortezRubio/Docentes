<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAsistencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admision.adm_asistencia', function (Blueprint $table) {
            $table->bigInteger('user_regi')->nullable();
            $table->bigInteger('user_actu')->nullable();
            $table->string('tipo_asistencia')->nullable();
            $table->foreign('user_regi')->references('id')->on('admision.adm_usuario')->onDelete('cascade');
            $table->foreign('user_actu')->references('id')->on('admision.adm_usuario')->onDelete('cascade');
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
