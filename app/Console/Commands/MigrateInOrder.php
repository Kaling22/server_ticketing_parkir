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
    protected $description = 'Migrasi Dengan Urutan Database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $migrations = [ 
            '2014_10_12_000000_create_users_table.php',
            '2014_10_12_100000_create_password_resets_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php',
            '2019_12_14_000001_create_personal_access_tokens_table.php',
            '2023_05_19_142225_create_tb_kendaraans_table.php',
            '2023_05_14_091535_create_tb_staffs_table.php',
            '2023_05_14_091514_create_tb_petugas_parkirs_table.php',
            '2023_05_14_091116_create_tb_mahasiswas_table.php',
            '2023_05_14_091447_create_tb_parkirs_table.php'
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

        return Command::SUCCESS;
    }
}
