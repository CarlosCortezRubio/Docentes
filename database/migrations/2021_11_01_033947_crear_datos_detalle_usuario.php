<?php

use Carbon\Carbon;
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
                "created_at"=>Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 2,
                "id_seccion" => 2,
                "id_tipo_usuario" => 1,
                "created_at"=>Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 3,
                "id_seccion" => 3,
                "id_tipo_usuario" => 1,
                "created_at"=>Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 4,
                "id_seccion" => 4,
                "id_tipo_usuario" => 1,
                "created_at"=>Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 5,
                "id_seccion" => 1,
                "id_tipo_usuario" => 1,
                "created_at"=>Carbon::now()
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
        //
    }
}
