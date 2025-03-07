@extends('layouts.app')

@section('content')
    {{-- feacture section --}}
    <section x-data class="border-b">
        <div class="container mx-auto px-4 py-12">
            <div class="grid gap-6 lg:grid-cols-2 lg:gap-12">
                <div class="relative aspect-video overflow-hidden rounded-lg">
                    <img src="{{ Storage::url($feature_post->image) }}" alt="Featured post" class="w-full object-cover"
                        priority />
                </div>
                <div class="flex flex-col justify-center space-y-4">
                    <Badge class="w-fit">Technology</Badge>
                    <h2 class="text-3xl font-bold tracking-tight">{{ $feature_post->title }}</h2>
                    <p class="text-muted-foreground">{{$feature_post->extract}}</p>
                    <div class="flex items-center gap-4 text-sm text-muted-foreground">
                        <span>{{ $feature_post->user->name }}</span>
                        <span>•</span>
                        <span>{{ $feature_post->updated_at->format('Y-m-d') }}</span>
                        <span>•</span>
                        <span>5 min read</span>
                    </div>
                    <a href={{ route('pages.post', $feature_post->id) }}>Leer más</a>
                </div>
            </div>
        </div>
    </section>
    {{-- Main section --}}
    <main class="container mx-auto px-4 py-12">
        <div class="mb-12 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            {{-- @livewire('home.search') --}}
            <div class="flex flex-wrap gap-2">
                @foreach ($categories as $category)
                    <a href="{{ route('category.view', $category->id) }}"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
            <article class="group relative flex flex-col h-full space-y-4">
                <!-- Imagen del post -->
                <div class="relative aspect-video overflow-hidden rounded-lg">
                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" />
                </div>

                <!-- Contenido del post -->
                <div class="flex flex-col flex-grow space-y-2">
                    <h3 class="text-xl font-bold tracking-tight">{{ $post->title }}</h3>
                    <p class="text-gray-600">{{ Str::limit($post->extract, 50, '...') }}</p>
                </div>

                <!-- Metadatos siempre al fondo -->
                <div class="mt-auto flex items-center gap-4 text-sm text-muted-foreground">
                    <span>{{ $post->user->name }}</span>
                    <span>•</span>
                    <span>{{ $post->updated_at->format('Y-m-d') }}</span>
                </div>

                <!-- Enlace invisible para hacer clic en toda la tarjeta -->
                <a href="{{ route('pages.post', $post->id) }}" class="absolute inset-0">
                    <span class="sr-only">Ver artículo</span>
                </a>
            </article>

            @endforeach
        </div>


    </main>

    {{ $posts->links() }}
@endsection
