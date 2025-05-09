<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::create([
            'name' => 'Vehicles',
            'created_at' => now(),
        ]);

        Categories::create([
            'name' => 'Immobilaria',
        ]);

        Categories::create([
            'name' => 'Feina',
        ]);

        Categories::create([
            'name' => 'Tecnologia',
        ]);

        Categories::create([
            'name' => 'Moda i complements',
        ]);

        Categories::create([
            'name' => 'Llar i jardi',
        ]);

        Categories::create([
            'name' => 'Esports i oci',
        ]);

        Categories::create([
            'name' => 'Mascotes',
        ]);

        Categories::create([
            'name' => 'Serveis',
        ]);

        Categories::create([
            'name' => 'Altres',
        ]);
    }
}