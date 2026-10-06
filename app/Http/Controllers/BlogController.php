<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $post = Post::where('publicado', true)
            ->latest()
            ->with('categories')
            ->paginate(6);

        return view('blog.index', [
            'posts' => $post,
        ]);
    }

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
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless($post->publicado, 404);

        $post->load('categories');

        return view('blog.show', [
            'post' => $post,
        ]);
    }
}

