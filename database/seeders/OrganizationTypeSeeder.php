<?php

namespace Database\Seeders;

use App\Models\OrganizationType;
use Illuminate\Database\Seeder;

class OrganizationTypeSeeder extends Seeder
{
    public array $insertData = [
        ['name' => 'Teatro', 'slug' => 'teatro'],
        ['name' => 'Ayuntamiento', 'slug' => 'ayuntamiento'],
        ['name' => 'Asociación cultural', 'slug' => 'asociacion-cultural'],
        ['name' => 'Biblioteca', 'slug' => 'biblioteca'],
        ['name' => 'Casa de cultura', 'slug' => 'casa-cultura'],
        ['name' => 'Centro cultural', 'slug' => 'centro-cultural'],
        ['name' => 'Colegio', 'slug' => 'colegio'],
        ['name' => 'Diputación', 'slug' => 'diputacion'],
        ['name' => 'Distribuidora', 'slug' => 'distribuidora'],
        ['name' => 'Festival', 'slug' => 'festival'],
        ['name' => 'Fundación', 'slug' => 'fundacion'],
        ['name' => 'Museo', 'slug' => 'museo'],
        ['name' => 'Productora', 'slug' => 'productora']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrganizationType::insert($this->insertData);
    }
}
