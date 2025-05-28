<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-in-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Comands/MigrateInOrder.php \n Drop all the table in db before execute the command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $migrations = [
            '0001_01_01_000001_create_cache_table.php',
            '0001_01_01_000002_create_jobs_table.php',

            '2025_05_25_114115_create_campus_table.php',
            '2025_05_22_134252_create_roles_table.php',
            '2025_05_20_072514_create_majors_table.php',
            '2025_05_20_073125_create_users_table.php',
            '2025_05_20_072231_create_educational_staff_table.php',
            '2025_05_20_072514_create_students_table.php',
            '2025_05_20_072457_create_study_programs_table.php',
            '2025_05_20_074626_create_registrations_table.php',
            '2025_05_20_074639_create_toeic_tests_table.php',
        ];
        // set foreign key check to 0
        if (env('DB_CONNECTION') == 'pgsql')
            DB::statement("SET session_replication_role = 'replica';");

        // drop all the tables
        $this->call('db:wipe');

        // execute the migrations
        foreach ($migrations as $migration) {
            $this->call('migrate:refresh', [
                '--path' => "database/migrations/{$migration}"
            ]);
        }

        // set foreign key check to 1
        if (env('DB_CONNECTION') == 'pgsql')
            DB::statement("SET session_replication_role = 'origin';");
    }
}
