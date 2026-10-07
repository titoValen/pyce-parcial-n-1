<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;

class BlogController extends Controller
{
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

    public function show(int $id): View
    {
        $posts = Post::where('publicado', true)
            ->with('categories')
            ->findOrFail($id);


        return view('blog.show', [
            'post' => $posts,
        ]);
    }
}
