<x-layout.admin title="Editar post">
    <section class="admin-page" aria-labelledby="post-form-title">
        <p class="eyebrow">Administración / Posts</p>
        <h1 id="post-form-title">Editar post</h1>
        <p class="admin-page-description">Actualiza el contenido y las categorías asignadas.</p>
        @include('admin.posts._form', [
            'formAction' => route('admin.posts.update', $post),
            'formMethod' => 'PUT',
        ])
    </section>
</x-layout.admin>
