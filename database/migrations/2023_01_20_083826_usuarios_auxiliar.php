<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsuariosAuxiliar extends Migration
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
                    "descripcion" => "Auxiliar - Carabaya",
                    "estado" => "A",
                ]);
            DB::table('admision.tipo_usuarios')
                ->insert([
                    "descripcion" => "Auxiliar - Emancipación",
                    "estado" => "A",
                ]);
            DB::table('admision.tipo_usuarios')
                ->insert([
                    "descripcion" => "Auxiliar - Salaverry",
                    "estado" => "A",
                ]);
        });
        Schema::table('admision.adm_usuario', function (Blueprint $table) {
            DB::table('admision.adm_usuario')->insert([
                'name' => 'REYES SÁNCHEZ, Yerson Fernando',
                'ndocumento' => '10860416',
                'email' => '10860416@unm.edu.pe',
                'password' => Hash::make('A10860416'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'ROMERO VÁSQUEZ, Isaías Romero',
                'ndocumento' => '08142017',
                'email' => '08142017@unm.edu.pe',
                'password' => Hash::make('A08142017'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'AVILA MOGOLLÓN, María Elena',
                'ndocumento' => '25610146',
                'email' => '25610146@unm.edu.pe',
                'password' => Hash::make('A25610146'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'JIMENEZ SAAVEDRA, Alisson Arianalucia',
                'ndocumento' => '75535923',
                'email' => '75535923@unm.edu.pe',
                'password' => Hash::make('A75535923'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'CALDERON MIGUEL, Yuri Nicanor',
                'ndocumento' => '09518308',
                'email' => '09518308@unm.edu.pe',
                'password' => Hash::make('A09518308'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'ESPINOZA SÁNCHEZ, Greydit Yajaira',
                'ndocumento' => '75713456',
                'email' => '75713456@unm.edu.pe',
                'password' => Hash::make('A75713456'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'GAMIO ARCE, Víctor Ángel',
                'ndocumento' => '10024406',
                'email' => '10024406@unm.edu.pe',
                'password' => Hash::make('A10024406'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'MORENO ESPINOZA, Mario Héctor',
                'ndocumento' => '46684582',
                'email' => '46684582@unm.edu.pe',
                'password' => Hash::make('A46684582'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'JUÁREZ CHAUCA, Yessenia',
                'ndocumento' => '76816463',
                'email' => '76816463@unm.edu.pe',
                'password' => Hash::make('A76816463'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'PARIONA ORTEGA, Carmen Lucero',
                'ndocumento' => '46622413',
                'email' => '46622413@unm.edu.pe',
                'password' => Hash::make('A46622413'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'TARAZONA PADILLA, Armando Wilfredo',
                'ndocumento' => '08107641',
                'email' => '08107641@unm.edu.pe',
                'password' => Hash::make('A08107641'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'LEÓN GONZÁLES, Sofía Alexandra',
                'ndocumento' => '72105394',
                'email' => '72105394@unm.edu.pe',
                'password' => Hash::make('A72105394'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'LAGOS RODRÍGUEZ, Giovanna Myriam',
                'ndocumento' => '09801877',
                'email' => '09801877@unm.edu.pe',
                'password' => Hash::make('A09801877'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'GÚZMÁN PINEDO, Olga Mercedes',
                'ndocumento' => '10659644',
                'email' => '10659644@unm.edu.pe',
                'password' => Hash::make('A10659644'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'JULCA VALVERDE, Eymmy Abigail',
                'ndocumento' => '47624159',
                'email' => '47624159@unm.edu.pe',
                'password' => Hash::make('A47624159'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'BRUNO PIRCA, Guillermo Elvis',
                'ndocumento' => '10603373',
                'email' => '10603373@unm.edu.pe',
                'password' => Hash::make('A10603373'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'DE LA CRUZ CASTILLO, Lucila Albina',
                'ndocumento' => '80382085',
                'email' => '80382085@unm.edu.pe',
                'password' => Hash::make('A80382085'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'PÉREZ LÓPEZ. Jerson Alberto',
                'ndocumento' => '42728672',
                'email' => '42728672@unm.edu.pe',
                'password' => Hash::make('A42728672'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'FALCÓN VILLANUEVA, Jorge Luis',
                'ndocumento' => '40786880',
                'email' => '40786880@unm.edu.pe',
                'password' => Hash::make('A40786880'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'RUÍZ ROSAS SAMOHOD, Florencia',
                'ndocumento' => '10271148',
                'email' => '10271148@unm.edu.pe',
                'password' => Hash::make('A10271148'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'AGUENA VERA, Jossie Ann',
                'ndocumento' => '44586654',
                'email' => '44586654@unm.edu.pe',
                'password' => Hash::make('A44586654'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'BURGA CORONADO, Giovanna',
                'ndocumento' => '40637967',
                'email' => '40637967@unm.edu.pe',
                'password' => Hash::make('A40637967'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'CAHUANA JUAREZ, René Eduardo',
                'ndocumento' => '73046763',
                'email' => '73046763@unm.edu.pe',
                'password' => Hash::make('A73046763'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'PINEDO MENDOZA, Janet Betzabe',
                'ndocumento' => '42138266',
                'email' => '42138266@unm.edu.pe',
                'password' => Hash::make('A42138266'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'MONTALVO VALENCIA, Nancy Albina',
                'ndocumento' => '47762618',
                'email' => '47762618@unm.edu.pe',
                'password' => Hash::make('A47762618'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                'name' => 'MEDINA LÓPEZ, Juan Carlos',
                'ndocumento' => '19323850',
                'email' => '19323850@unm.edu.pe',
                'password' => Hash::make('A19323850'),
            ]);
        });
        Schema::table('admision.detalle_usuarios', function (Blueprint $table) {
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 106,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 107,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 108,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 109,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 110,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 111,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 112,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 113,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 114,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 115,
                'id_tipo_usuario' => 7,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 116,
                'id_tipo_usuario' => 8,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 117,
                'id_tipo_usuario' => 8,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 118,
                'id_tipo_usuario' => 8,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 119,
                'id_tipo_usuario' => 8,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 120,
                'id_tipo_usuario' => 8,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 121,
                'id_tipo_usuario' => 8,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 122,
                'id_tipo_usuario' => 8,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 123,
                'id_tipo_usuario' => 8,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 124,
                'id_tipo_usuario' => 9,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 125,
                'id_tipo_usuario' => 9,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 126,
                'id_tipo_usuario' => 9,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 127,
                'id_tipo_usuario' => 9,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 128,
                'id_tipo_usuario' => 9,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 129,
                'id_tipo_usuario' => 9,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 130,
                'id_tipo_usuario' => 9,
                'created_at' => Carbon::now()
            ]);
            DB::table('admision.detalle_usuarios')->insert([
                'estado' => 'A',
                'id_usuario' => 131,
                'id_tipo_usuario' => 9,
                'created_at' => Carbon::now()
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
