<?php

namespace Database\Seeders;

use App\Models\TattooArtist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TattooArtistSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tatuadores')->insert([
            [
                'nombre' => "Tito",
                'especialidad' => "Old school",
                'bio' => "Apasionado del estilo tradicional y Old School, Tito se destaca por sus líneas sólidas, sombras intensas y paletas de color clásicas. Es el especialista ideal para piezas pequeñas, medianas y los diseños más potentes del Flash del día.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Luna",
                'especialidad' => "Neotradicional",
                'bio' => "Con un enfoque en la fluidez orgánica, texturas detalladas y paletas de color contemporáneas, Luna da vida a proyectos de gran formato. Su precisión técnica la convierte en la experta de la casa para piezas grandes, retoques finos y Cover-ups complejos.",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Max",
                'especialidad' => "Lettering y blackwork",
                'bio' => "Dominante del contraste puro y la tipografía en la piel, Max combina la solidez del Blackwork con la elegancia del Lettering a medida. Desde caligrafías personalizadas hasta revitalizar y restaurar tatuajes con retoques impecables.",
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}