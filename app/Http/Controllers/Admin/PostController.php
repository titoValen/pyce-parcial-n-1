<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Gestiona las operaciones administrativas de publicaciones.
 */
class PostController extends Controller
{
    /** Lista las publicaciones y sus categorías. */
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => Post::with('categories')->latest()->paginate(10),
        ]);
    }

    /** Muestra el formulario para crear una publicación. */
    public function create(): View
    {
        return view('admin.posts.create', [
            'post' => new Post(),
            'categories' => Category::orderBy('nombre')->get(),
        ]);
    }

    /** Valida y almacena una publicación nueva. */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->validationRules(), $this->validationMessages());
        $categoryIds = $validated['categories'] ?? [];
        unset($validated['categories']);

        $post = Post::create([
            ...$validated,
            'publicado' => $request->boolean('publicado'),
            'usuario_id' => $request->user()->id,
        ]);
        $post->categories()->sync($categoryIds);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post creado correctamente.');
    }

    /** Muestra el formulario de edición de una publicación. */
    public function edit(Post $post): View
    {
        $post->load('categories');

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::orderBy('nombre')->get(),
        ]);
    }

    /** Valida y actualiza una publicación existente. */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate(
            $this->validationRules($post),
            $this->validationMessages(),
        );
        $categoryIds = $validated['categories'] ?? [];
        unset($validated['categories']);

        $post->update([
            ...$validated,
            'publicado' => $request->boolean('publicado'),
        ]);
        $post->categories()->sync($categoryIds);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post actualizado correctamente.');
    }

    /** Elimina una publicación. */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post eliminado correctamente.');
    }

    /**
     * Reglas de validación para los campos editables de la publicación.
     *
     * @param Post|null $post Publicación excluida de la regla de slug único.
     * @return array<string, array<int, string|\Illuminate\Validation\Rules\Unique>>
     */
    private function validationRules(?Post $post = null): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post?->id),
            ],
            'extracto' => ['required', 'string', 'max:255'],
            'contenido' => ['required', 'string'],
            'categories' => ['sometimes', 'array'],
            'categories.*' => ['integer', 'exists:categorias,id'],
        ];
    }

    /**
     * Mensajes de validación en español.
     *
     * @return array<string, string>
     */
    private function validationMessages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser texto.',
            'titulo.max' => 'El título no puede superar los :max caracteres.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.alpha_dash' => 'El slug solo puede contener letras, números, guiones y guiones bajos.',
            'slug.max' => 'El slug no puede superar los :max caracteres.',
            'slug.unique' => 'Ya existe un post con ese slug.',
            'extracto.required' => 'El extracto es obligatorio.',
            'extracto.string' => 'El extracto debe ser texto.',
            'extracto.max' => 'El extracto no puede superar los :max caracteres.',
            'contenido.required' => 'El contenido es obligatorio.',
            'contenido.string' => 'El contenido debe ser texto.',
            'categories.array' => 'Las categorías seleccionadas no son válidas.',
            'categories.*.integer' => 'Una de las categorías seleccionadas no es válida.',
            'categories.*.exists' => 'Una de las categorías seleccionadas no existe.',
        ];
    }
}
