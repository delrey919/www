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
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Immobilaria',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Feina',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Tecnologia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Moda i complements',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Llar i jardi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Esports i oci',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Mascotes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Serveis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categories::create([
            'name' => 'Altres',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}