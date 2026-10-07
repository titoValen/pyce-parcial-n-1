<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Crea el catálogo inicial de servicios del estudio.
 */
class ServiceSeeder extends Seeder
{
    /**
     * Inserta los servicios de ejemplo.
     */
    public function run(): void
    {
        DB::table('servicios')->insert([
            [
                'nombre' => "Consulta y diseño personalizado",
                'descripcion' => "Sesión de asesoramiento individual donde pulimos tus ideas, elegimos el estilo ideal y creamos un boceto a medida antes de plasmarlo en tu piel.",
                'precio_base' => 0.00,
                'duracion_estimada' => "00:30:00",
                'estilo' => "Todos",
                'imagen' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Tatuaje pequeño (hasta 8 cm)",
                'descripcion' => "Ideal para minimalismos, símbolos, fechas o primeros tatuajes. Trazos precisos y delicados con la máxima atención al detalle.",
                'precio_base' => 60000.00,
                'duracion_estimada' => "01:30:00",
                'estilo' => "Todos",
                'imagen' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Tatuaje mediano (hasta 20 cm)",
                'descripcion' => "Piezas con mayor nivel de detalle, sombreado o color. Perfecto para antebrazos, muslos o pantorrillas que buscan destacar.",
                'precio_base' => 150000.00,
                'duracion_estimada' => "03:30:00",
                'estilo' => "Todos",
                'imagen' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Sesión de pieza grande (por sesión)",
                'descripcion' => "Sesión dedicada a proyectos de gran escala como espaldas, mangas completas o pechos. Avanzamos a paso firme respetando los tiempos de tu piel.",
                'precio_base' => 250000.00,
                'duracion_estimada' => "05:30:00",
                'estilo' => "Todos",
                'imagen' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Flash del día",
                'descripcion' => "Diseños prehechos, listos para tatuar y de edición limitada. Una opción rápida y directa con todo el estilo original del artista.",
                'precio_base' => 40000.00,
                'duracion_estimada' => "01:00:00",
                'estilo' => "Old school",
                'imagen' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Cover up (tapado de tatuaje)",
                'descripcion' => "Transformamos o cubrimos tatuajes antiguos o no deseados con una nueva pieza sólida, estratégica y visualmente impactante.",
                'precio_base' => 180000.00,
                'duracion_estimada' => "04:00:00",
                'estilo' => "Old school, Tradicional, Neo tradicional",
                'imagen' => null,
                'activo' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Retoque de tatuaje",
                'descripcion' => "Mantenimiento y revitalización para devolverle el contraste, la nitidez y el brillo original a tus piezas ya cicatrizadas.",
                'precio_base' => 25000.00,
                'duracion_estimada' => "01:00:00",
                'estilo' => "Todos",
                'imagen' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => "Lettering (tatuaje de letras o palabras)",
                'descripcion' => "Diseño tipográfico personalizado de frases, nombres o palabras. Cuidado especial en la fluidez del trazo y la anatomía donde se ubica.",
                'precio_base' => 55000.00,
                'duracion_estimada' => "01:30:00",
                'estilo' => "Lettering, Caligrafía, Tipografía",
                'imagen' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}