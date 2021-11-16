<?php

namespace Database\Seeders;

use App\Models\OrganizationType;
use Illuminate\Database\Seeder;

class OrganizationTypeSeeder extends Seeder
{
    public array $insertData = [
        [
            'name' => 'Teatro',
            'name_plural' => 'Teatros',
            'slug' => 'teatro',
            'slug_plural' => 'teatros'
        ],
        [
            'name' => 'Ayuntamiento',
            'name_plural' => 'Ayuntamientos',
            'slug' => 'ayuntamiento',
            'slug_plural' => 'ayuntamientos'
        ],
        [
            'name' => 'Asociación cultural',
            'name_plural' => 'Asociaciones culturales',
            'slug' => 'asociacion-cultural',
            'slug_plural' => 'asociaciones-culturales'
        ],
        [
            'name' => 'Biblioteca',
            'name_plural' => 'Bibliotecas',
            'slug' => 'biblioteca',
            'slug_plural' => 'bibliotecas'
        ],
        [
            'name' => 'Casa de cultura',
            'name_plural' => 'Casas de cultura',
            'slug' => 'casa-cultura',
            'slug_plural' => 'casas-cultura'
        ],
        [
            'name' => 'Centro cultural',
            'name_plural' => 'Centros culturales',
            'slug' => 'centro-cultural',
            'slug_plural' => 'centros-culturales'
        ],
        [
            'name' => 'Colegio',
            'name_plural' => 'Colegios',
            'slug' => 'colegio',
            'slug_plural' => 'colegios'
        ],
        [
            'name' => 'Diputación',
            'name_plural' => 'Diputaciones',
            'slug' => 'diputacion',
            'slug_plural' => 'diputaciones'
        ],
        [
            'name' => 'Distribuidora',
            'name_plural' => 'Distribuidoras',
            'slug' => 'distribuidora',
            'slug_plural' => 'distribuidoras'
        ],
        [
            'name' => 'Festival',
            'name_plural' => 'Festivales',
            'slug' => 'festival',
            'slug_plural' => 'festivales'
        ],
        [
            'name' => 'Fundación',
            'name_plural' => 'Fundaciones',
            'slug' => 'fundacion',
            'slug_plural' => 'fundaciones'
        ],
        [
            'name' => 'Museo',
            'name_plural' => 'Museos',
            'slug' => 'museo',
            'slug_plural' => 'museos'
        ],
        [
            'name' => 'Productora',
            'name_plural' => 'Productoras',
            'slug' => 'productora',
            'slug_plural' => 'productoras'
        ]
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
