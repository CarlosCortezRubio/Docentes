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

            '2014_10_12_000000_create_users_table.php',
            '2014_10_12_100000_create_password_resets_table.php',
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
            '2021_11_09_090612_crear_datos__tipo_examen.php'
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
