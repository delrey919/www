<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anunci;
use App\Models\Categories;

class AnunciSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Categories::all();
        
        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Categories::all();
        }

        $anuncis = [
            [
                'name' => 'Anunci 1',
                'description' => 'Descripció 1',
                'mail' => 'laia@test.com',
                'date' => now(),
                'hora' => now()->format('H:i'),
                'category_id' => $categories->where('name', 'Serveis')->first()->id
            ],
            // ...más anuncios...
        ];

        foreach ($anuncis as $anunci) {
            Anunci::create($anunci);
        }
    }
}