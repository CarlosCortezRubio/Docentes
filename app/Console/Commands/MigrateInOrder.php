<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Comands/MigrateInOrder.php \n Drop all the table in db before execute the command.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** Specify the names of the migrations files in the order you want to
        * loaded
        * $migrations =[
        *               'xxxx_xx_xx_000000_create_nameTable_table.php',
        *    ];
        */
        $migrations = [
            /*'2022_01_05_155254_crear_tabla_seccion_estudios.php',
            '2022_01_05_155825_crear_datos_seccion_estudios.php',
            '2014_10_12_000000_create_users_table.php',
            '2014_10_12_100000_create_password_resets_table.php',
            '2019_10_23_005755_create_jobs_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php',
            '2021_10_30_053815_crear_tabla_periodo.php',
            '2021_10_26_235440_create_cupos_table.php',
            '2021_10_30_054555_crear_tabla_tipo_usuarios.php',
            '2021_10_30_054852_crear_tabla_detalle_usuario.php',
            '2021_11_01_001441_crear_datos_tipo_usuario.php',
            '2021_11_01_002135_crear_datos_usuario.php',
            '2021_11_01_033947_crear_datos_detalle_usuario.php',
            '2021_11_09_085352_crear_tabla__tipo_examen.php',
            '2021_11_09_084559_crear_tabla_examen.php',
            '2021_11_09_085836_crear_tabla__examen_admision.php',
            '2021_11_09_090612_crear_datos__tipo_examen.php',
            '2021_11_17_040703_crear_tabla_seccion.php',
            '2021_11_26_080740_crear_aulas.php',
            '2021_11_26_074329_crear_programacion_examen.php',
            '2021_11_29_054320_crear_jurado.php',
            '2021_11_29_221312_crear_programacion_solicitud.php',
            '2021_12_23_110524_crear_tabla_jurado_postulante.php',
            '2021_12_22_081815_crear_tabla_nota_jurado.php',
            '2021_12_22_121320_cargar_datos_aulas.php',
            //'2021_12_13_031241_actualizar_solicitud.php',
            '2021_12_23_071740_crear_tabla_comentarios.php',
            '2022_01_03_034929_crear_tabla_examen_postulante.php',
            //'2022_01_10_133229_crear_datos_exonerados.php',
            '2022_01_18_163139_crear_tabla_audio_temporal.php'*/
            //'2022_02_09_144036_crear_tabla_respuestas.php',



            //'2022_11_29_105228_updateperiodo.php',
            //'2022_12_21_004949_tabla_asistencia.php',

            '2023_01_16_121608_update_asistencia.php',
            '2023_01_16_175019_usuarios_seguridad.php',
            '2023_01_20_083826_usuarios_auxiliar.php',

            '2022_10_11_000157_crear_tablanivel_evaluacion.php',
            '2022_10_11_001102_crear_datos_nivel.php',
            '2022_10_11_002830_update_examenes.php',
            '2022_10_11_011934_actualizar_data_examen.php',
        ];

        foreach($migrations as $migration)
        {
            $basePath = 'database/migrations/';
            $migrationName = trim($migration);
            $path = $basePath.$migrationName;
            $this->call('migrate:refresh', [
            '--path' => $path ,
            ]);
        }
    }
}
