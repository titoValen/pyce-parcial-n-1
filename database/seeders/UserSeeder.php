<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Crea el usuario inicial del área de administración.
 */
class UserSeeder extends Seeder
{
    /**
     * Inserta la cuenta de administración inicial.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            'nombre' => "Tito",
            'email' => "valetin.tito@davinci.du.ar",
            'email_verificado' => now(),
            'password' => Hash::make('tito_valentin')
        ]);
    }
}
