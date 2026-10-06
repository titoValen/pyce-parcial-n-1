<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $autor = User::first();
        $categorias = Category::pluck('id', 'nombre');

        $post = Post::create([
            'titulo' => 'Cuidados después de un tatuaje',
            'slug' => 'cuidados-despues-de-un-tatuaje',
            'extracto' => 'Aprende cómo cuidar tu tatuaje para asegurar una curación adecuada y mantener los colores vibrantes.',
            'contenido' => 'Después de hacerte un tatuaje, es crucial seguir ciertos cuidados para asegurar que la piel sane correctamente y que el diseño se mantenga en buen estado.',
            'publicado' => true,
            'usuario_id' => $autor->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $post->categories()->attach([$categorias['Cuidados']]);

        $post = Post::create([
            'titulo' => 'Tendencias de tatuajes en 2026',
            'slug' => 'tendencias-de-tatuajes-en-2026',
            'extracto' => 'Descubre las últimas tendencias en el mundo del tatuaje para este año.',
            'contenido' => 'El mundo del tatuaje está en constante evolución. En 2026, vemos un aumento en la popularidad de los tatuajes minimalistas, los diseños geométricos y los tatuajes inspirados en la naturaleza. Además, los colores pastel y los tatuajes de acuarela están ganando terreno entre los entusiastas del arte corporal.',
            'publicado' => true,
            'usuario_id' => $autor->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $post->categories()->attach([
            $categorias['Estilos'],
            $categorias['Novedades del estudio'],
        ]);
    }
}
