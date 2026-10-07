<x-layout.admin title="Crear post">
    <section class="admin-page" aria-labelledby="post-form-title">
        <p class="eyebrow">Administración / Posts</p>
        <h1 id="post-form-title">Crear post</h1>
        <p class="admin-page-description">Completa los datos de la publicación. El slug debe ser único.</p>
        @include('admin.posts._form', [
            'formAction' => route('admin.posts.store'),
            'formMethod' => 'POST',
        ])
    </section>
</x-layout.admin>
