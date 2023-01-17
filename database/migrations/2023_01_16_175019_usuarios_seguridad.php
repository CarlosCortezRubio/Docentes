<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsuariosSeguridad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admision.tipo_usuarios', function (Blueprint $table) {
            DB::table('admision.tipo_usuarios')
            ->insert([
                "descripcion" => "Seguridad – Carabaya",
                "estado" => "A",
            ]);
            DB::table('admision.tipo_usuarios')
            ->insert([
                "descripcion" => "Seguridad – Salaverry",
                "estado" => "A",
            ]);
            DB::table('admision.tipo_usuarios')
            ->insert([
                "descripcion" => "Seguridad – emancipación",
                "estado" => "A",
            ]);
        });
        Schema::table('admision.adm_usuario', function (Blueprint $table) {
            DB::table('admision.adm_usuario')->insert([
                "name" => "Ernesto Atoche Agurto",
                "ndocumento" => "43660450",
                "email" => "43660450@unm.edu.pe",
                "password" => Hash::make('S43660450'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Jessica Robles Valles",
                "ndocumento" => "10498876",
                "email" => "10498876@unm.edu.pe",
                "password" => Hash::make('S10498876'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Ana Carbajal Sánchez",
                "ndocumento" => "10216626",
                "email" => "10216626@unm.edu.pe",
                "password" => Hash::make('S10216626'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Eduardo Linares Lataron",
                "ndocumento" => "08550859",
                "email" => "08550859@unm.edu.pe",
                "password" => Hash::make('S08550859'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Elmer Bazan Medina",
                "ndocumento" => "74156608",
                "email" => "74156608@unm.edu.pe",
                "password" => Hash::make('S74156608'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Elizabeth Infante Quezada",
                "ndocumento" => "09973533",
                "email" => "09973533@unm.edu.pe",
                "password" => Hash::make('S09973533'),
            ]);
        });
        Schema::table('admision.detalle_usuarios', function (Blueprint $table) {
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 100,
                "id_tipo_usuario" => 4,
                "created_at"=>Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 101,
                "id_tipo_usuario" => 4,
                "created_at"=>Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 102,
                "id_tipo_usuario" => 6,
                "created_at"=>Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 103,
                "id_tipo_usuario" => 6,
                "created_at"=>Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 104,
                "id_tipo_usuario" => 5,
                "created_at"=>Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                "estado" => "A",
                "id_usuario" => 105,
                "id_tipo_usuario" => 5,
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
