<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\TattooArtist;
use Illuminate\Database\Seeder;

class TattooArtistServiceSeeder extends Seeder
{
    public function run(): void
    {
        $servicio = Service::pluck('id', 'nombre');

        $tito = TattooArtist::where('nombre', 'Tito')->first();
        $tito->services()->attach([
            $servicio['Consulta y diseño personalizado'],
            $servicio['Tatuaje pequeño (hasta 8 cm)'],
            $servicio['Tatuaje mediano (hasta 20 cm)'],
            $servicio['Flash del día']
        ]);

        $luna = TattooArtist::where('nombre', 'Luna')->first();
        $luna->services()->attach([
            $servicio['Consulta y diseño personalizado'],
            $servicio['Sesión de pieza grande (por sesión)'],
            $servicio['Cover up (tapado de tatuaje)'],
            $servicio['Retoque de tatuaje']
        ]);

        $max = TattooArtist::where('nombre', 'Max')->first();
        $max->services()->attach([
            $servicio['Consulta y diseño personalizado'],    
            $servicio['Retoque de tatuaje'],
            $servicio['Lettering (tatuaje de letras o palabras)']
        ]);
    }
}
