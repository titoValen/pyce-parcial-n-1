<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
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
