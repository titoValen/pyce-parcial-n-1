<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Ejecuta los seeders principales de la base de datos.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Siembra los datos principales en orden de dependencia.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ServiceSeeder::class,
            AppointmentRequestSeeder::class,
            TattooArtistSeeder::class,
            PostSeeder::class,

            TattooArtistServiceSeeder::class,
        ]);
    }
}
