<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
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
