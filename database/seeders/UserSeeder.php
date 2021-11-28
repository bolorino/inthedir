<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'José Bolorino',
            'email' => 'jose@bolorino.net',
            'email_verified_at' => now(),
            'password' => \Hash::make('r300v21a'),
            'created_at' => now(),
            'updated_at' => now(),
            'enabled' => 1,
            'approved_at' => now()
            ]
        );

        User::factory(2)->create();
    }
}
