<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'nombre' => "Cuidados",
                'slug' => "cuidados",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Estilos",
                'slug' => "estilos",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Mitos y verdades",
                'slug' => "mitos-y-verdades",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Novedades del estudio",
                'slug' => "novedades-del-estudio",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Flashes",
                'slug' => "flashes",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Historia",
                'slug' => "historia",
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
