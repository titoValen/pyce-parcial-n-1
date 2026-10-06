<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\View\View;
/**
 * Muestra la página de inicio del sitio
 */
class HomeController extends Controller
{
    /**
     * Presenta el estudio con los servicios destacados
     * @return View
     */
    public function index(): View
    {
        $services = Service::where('activo', true)
            ->take(3)
            ->get();

        $posts = Post::where('publicado', true)
            ->latest()
            ->take(3)
            ->get();

        return view('home', [
            'services' => $services,
            'posts' => $posts,
        ]);
    }
}
