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
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "codi_secc_sec" => "05001",
                "id_usuario" => 2,
                "id_tipo_usuario" => 3,
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "codi_secc_sec" => "05001",
                "id_usuario" => 3,
                "id_tipo_usuario" => 1,
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "codi_secc_sec" => "05002",
                "id_usuario" => 4,
                "id_tipo_usuario" => 3,
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "codi_secc_sec" => "05002",
                "id_usuario" => 5,
                "id_tipo_usuario" => 1,
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "codi_secc_sec" => "05003",
                "id_usuario" => 6,
                "id_tipo_usuario" => 3,
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "codi_secc_sec" => "05003",
                "id_usuario" => 7,
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
