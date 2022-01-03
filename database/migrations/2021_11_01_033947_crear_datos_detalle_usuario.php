<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearDatosDetalleUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admision.detalle_usuarios', function (Blueprint $table) {
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 1,
                "id_tipo_usuario" => 1,
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
        Schema::table('admision.detalle_usuarios', function (Blueprint $table) {
            //
        });
    }
}
