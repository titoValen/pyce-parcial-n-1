<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

/**
 * Presenta las publicaciones públicas del blog.
 */
class BlogController extends Controller
{
    /**
     * Lista las publicaciones visibles y sus categorías.
     */
    public function index(): View
    {
        $posts = Post::where('publicado', true)
            ->latest()
            ->with('categories')
            ->paginate(6);

        return view('blog.index', [
            'posts' => $posts,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Lista las publicaciones visibles de una categoría.
     *
     * @param Category $category Categoría identificada por su slug.
     */
    public function category(Category $category): View
    {
        $posts = $category->posts()
            ->where('publicado', true)
            ->latest()
            ->with('categories')
            ->paginate(6);

        return view('blog.index', [
            'posts' => $posts,
            'category' => $category,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Muestra una publicación visible identificada por su slug.
     *
     * @param Post $post Publicación resuelta desde la ruta.
     */
    public function show(Post $post): View
    {
        abort_unless($post->publicado, 404);

        return view('blog.show', [
            'post' => $post->load('categories'),
        ]);
    }
}
