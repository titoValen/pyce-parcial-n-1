<x-layout.app title="Blog">
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-gray-900">Blog</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($posts as $post)
                        <div class="mb-4">
                            <h2 class="text-xl font-bold">{{ $post->titulo }}</h2>
                            <p>{{ $post->contenido }}</p>
                            <p class="text-sm text-gray-500">Publicado el {{ $post->created_at->format('d/m/Y') }}</p>
                        </div>
                    @endforeach

                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
