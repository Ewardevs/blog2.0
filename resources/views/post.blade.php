@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b">
        <header class="sticky top-0 z-50 bg-gray-100">
            <div class="max-w-5xl mx-auto px-4 py-4">
                <a href="{{ route('pages.home') }}" class="flex items-center text-gray-600 hover:text-gray-900 group">
                    <span class="font-medium">Volver al blog</span>
                </a>
            </div>
        </header>

        <main class="bg-gradient-to-b from-gray-50 to-white max-w-5xl mx-auto px-4 py-6 sm:py-8">
            <article class="mb-12">

                <!-- Categoría y Título -->
                <div class="text-center mb-6 sm:mb-8">
                    <span class="inline-block bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs sm:text-sm font-medium mb-3">
                        {{ $posts->category->name }}
                    </span>
                    <h1 class="text-2xl sm:text-5xl font-bold text-gray-900 mb-3 sm:mb-4 leading-tight">
                        {{ $posts->title }}
                    </h1>
                    <div class="flex items-center justify-center text-gray-500 text-xs sm:text-sm">
                        <span>{{ $posts->created_at->format('d \d\e F, Y') }}</span>
                        <span class="mx-1 sm:mx-2">·</span>
                        <span>8 min de lectura</span>
                    </div>
                </div>

                <!-- Imagen Principal -->
                <div class="rounded-lg overflow-hidden mb-8 sm:mb-12 shadow-md sm:shadow-xl">
                    @if ($posts->image)
                        <img src="{{ Storage::url($posts->image) }}" alt="Featured post" class="w-full h-auto object-cover" />
                    @else
                        <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&q=80&w=2000"
                            alt="Inteligencia Artificial"
                            class="w-full h-56 sm:h-[500px] object-cover hover:scale-105 transition-transform duration-700" />
                    @endif
                </div>

                <!-- Autor -->
                <div class="flex flex-col sm:flex-row items-center sm:justify-between bg-gray-50 rounded-lg p-4 sm:p-6 mb-8 sm:mb-12 shadow">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <img src="{{ Storage::url($posts->user->photo) }}" alt="Author"
                            class="w-12 h-12 sm:w-16 sm:h-16 rounded-full object-cover border-2 border-white shadow" />
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">{{ $posts->user->name }}</h3>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 sm:space-x-4 mt-4 sm:mt-0">
                        <button class="flex items-center text-gray-600 hover:text-red-500 transition-colors">
                            <Heart class="w-5 h-5 sm:w-6 sm:h-6" />
                            <span class="font-medium ml-1 sm:ml-2">245</span>
                        </button>
                        <button class="flex items-center text-gray-600 hover:text-blue-500 transition-colors">
                            <Share2 class="w-5 h-5 sm:w-6 sm:h-6" />
                        </button>
                    </div>
                </div>

                <!-- Contenido -->
                <div class="body prose prose-lg max-w-none mb-8 sm:mb-12">
                    <p>{!! str($posts->body)->sanitizeHtml() !!}</p>
                </div>

                <!-- Comentarios -->
                @if (Auth::user())
                    <section class="bg-gray-50 rounded-lg p-4 sm:p-6">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6">Comentarios</h3>

                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <img src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png' }}"
                                alt="user" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full" />

                            <div class="flex-1">
                                <form id="commentForm" action="{{ route('pages.home.comment', $posts->id) }}" method="post">
                                    @csrf
                                    <textarea name="body" id="commentBody" placeholder="Escribe un comentario..."
                                        class="w-full px-3 py-2 sm:px-4 sm:py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                        rows="2"></textarea>
                                    <div class="mt-2 flex justify-end">
                                        <button type="submit"
                                            class="px-3 sm:px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                            Comentar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                @else
                    <section class="bg-gray-50 rounded-lg p-4 sm:p-6">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">Comentarios</h3>
                        <p class="text-gray-700">
                            Si quieres comentar, <a class="text-blue-800 font-semibold" href="{{ route('showLogin') }}">Inicia sesión</a>.
                        </p>
                    </section>
                @endif

                <!-- Lista de Comentarios -->
                <div class="space-y-4 sm:space-y-6 mt-6">
                    @foreach ($comments as $comment)
                        <div class="flex space-x-3 sm:space-x-4">
                            <img src="{{ Storage::url($comment->user->photo) }}" alt="{{ $comment->user->photo }}"
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-full" />
                            <div class="flex-1">
                                <div class="bg-white rounded-lg p-3 sm:p-4 shadow-sm">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-semibold text-gray-900">{{ $comment->user->name }}</h4>
                                        <span class="text-xs sm:text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->body }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </article>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#commentForm").submit(function(event) {
                event.preventDefault(); // Evita que la página se recargue

                let form = $(this);
                let actionUrl = form.attr("action");
                let formData = form.serialize();

                $.ajax({
                    url: actionUrl,
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        // Limpiar el textarea
                        $("#commentBody").val("");

                        // Agregar el comentario nuevo sin recargar la página
                        $(".space-y-4").prepend(`
                            <div class="flex space-x-4">
                                <img src="${response.comment.user.photo}" alt="${response.comment.user.name} photo"
                                    class="w-10 h-10 rounded-full" />
                                <div class="flex-1">
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="font-semibold text-gray-900">${response.comment.user.name}</h4>
                                            <span class="text-sm text-gray-500">Justo ahora</span>
                                        </div>
                                        <p class="text-gray-700">${response.comment.body}</p>
                                    </div>
                                    <div class="mt-2 flex items-center space-x-4">
                                        <button
                                            class="flex items-center text-gray-500 hover:text-red-500 transition-colors">
                                            <Heart class="w-4 h-4 mr-1" />
                                            <span class="text-sm">25</span>
                                        </button>
                                        <button class="text-gray-500 hover:text-blue-500 transition-colors text-sm">
                                            Responder
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `);
                    },
                    error: function(xhr) {
                        alert("Ocurrió un error al enviar el comentario.");
                    }
                });
            });
        });
    </script>

@endsection
