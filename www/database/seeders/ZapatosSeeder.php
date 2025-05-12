<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zapatos;
use App\Models\Categories;

class ZapatosSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurarse de que existan categorías primero
        $categories = Categories::all();
        
        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Categories::all();
        }

        // Array de zapatos de ejemplo
        $zapatos = [
            [
                'name' => 'Anunci 1',
                'description' => 'Anunci 1',
                'date' => now(),
                'hora' => now()->format('H:i'),
                'mail' => 'laia@test.com',
                'category_id' => $categories->where('name', 'Serveis')->first()->id
            ],
            [
                'name' => 'Anunci 2',
                'description' => 'Anunci 2',
                'date' => now(),
                'hora' => now()->format('H:i'),
                'mail' => 'aina@gmail.com',
                'category_id' => $categories->where('name', 'Mascotes')->first()->id
            ],
            [
                'name' => 'Anunci 3',
                'description' => 'Anunci 3',
                'date' => now(),
                'hora' => now()->format('H:i'),
                'mail' => 'marc@gmail.com',
                'category_id' => $categories->where('name', 'Mascotes')->first()->id
            ],
            [
                'name' => 'Anunci 4',
                'description' => 'Anunci 4',
                'date' => now(),
                'hora' => now()->format('H:i'),
                'mail' => 'maribel@gmail.com',
                'category_id' => $categories->where('name', 'Mascotes')->first()->id
            ],
            [
                'name' => 'Anunci 5',
                'description' => 'Anunci 5',
                'date' => now(),
                'hora' => now()->format('H:i'),
                'mail' => 'georgina@gmail.com',
                'category_id' => $categories->where('name', 'Serveis')->first()->id
            ],
            [
                'name' => 'Anunci 6',
                'description' => 'Anunci 6',
                'date' => now(),
                'hora' => now()->format('H:i'),
                'mail' => 'Aria@gmail.com',
                'category_id' => $categories->where('name', 'Mascotes')->first()->id
            ],
        ];

        // Crear los zapatos
        foreach ($zapatos as $zapato) {
            Zapatos::create($zapato);
        }
    }
}
