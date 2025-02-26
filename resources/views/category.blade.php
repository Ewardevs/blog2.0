@extends('layouts.app')

@section('content')
    <header class="top-0 z-10">
        <div class="max-w-5xl mx-auto px-4 py-4">
            <a href={{ route("pages.home") }} class="flex items-center text-gray-600 hover:text-gray-900 group">
                <span class="font-medium">Volver al blog</span>
            </a>
        </div>
    </header>
    <h2 class="text-center">
        <span class="inline-block bg-blue-50 text-blue-600 px-4 py-1 rounded-full text-sm font-medium mb-4">
            {{ $category }}
        </span>
    </h2>
    <div class="mx-16 my-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

        @foreach ($posts as $post)
            <article class="group relative flex flex-col space-y-4 border">
                <div class="relative aspect-video overflow-hidden rounded-lg">
                    <img src="{{ Storage::url($post->image) }}" alt={{ $post->title }}
                        class="object-cover w-full transition-transform duration-300 group-hover:scale-105" />
                </div>
                <div class="flex-1 space-y-4">



                    <div class="space-y-2">
                        <h3 class="text-xl font-bold tracking-tight">{{ $post->title }}</h3>
                        <p class="text-muted-foreground">dasas</p>
                    </div>
                    <div class="flex items-center gap-4 text-sm text-muted-foreground">
                        <span>{{ $post->user->name }}</span>
                        <span>•</span>
                        <span>{{ $post->updated_at->format('Y-m-d') }}</span>
                        <span>•</span>
                        <span>6 min read</span>
                    </div>
                </div>
                <a href={{ route('pages.post', $post->id) }} class="absolute inset-0">
                    <span class="sr-only">Ver artículo</span>
                </a>
            </article>
        @endforeach
    </div>
@endsection
