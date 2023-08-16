<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\Pessoa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Categoria::create(['nome'=>'Admin']);
        Categoria::create(['nome'=>'Gerente']);
        Categoria::create(['nome'=>'Normal']);

        Pessoa::factory(15)->create();
    }
}
