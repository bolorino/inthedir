<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // SQL for Spanish provinces and states (Comunidades Autónomas)
        $sqlDB = 'database/SQL/spain_comunidades_autonomas.sql';
        DB::unprepared(file_get_contents($sqlDB));

        $sqlDB = 'database/SQL/spain_provincias.sql';
        DB::unprepared(file_get_contents($sqlDB));

        $sqlDB = 'database/SQL/inthedir_organizations.sql';
        DB::unprepared(file_get_contents($sqlDB));

        /*
        $this->call([
            OrganizationSeeder::class,
        ]);
        */

        $this->call([
            UserSeeder::class,
        ]);
    }
}
