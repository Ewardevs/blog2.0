@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 max-w-lg md:max-w-2xl lg:max-w-4xl mx-auto">
    <!-- Enlace de regreso a inicio -->
    <a href="{{route('pages.home')}}" class="inline-flex items-center text-slate-700 hover:text-slate-900 mb-4 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Volver al inicio</span>
    </a>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Cabecera -->
        {{-- <div class="bg-slate-800 px-5 py-4 relative">
            <!-- Botón en la parte superior en móvil -->
            @if (!Auth::user()->askpermission && Auth::user()->role == "user")
                <div class="mb-4 sm:mb-0 sm:absolute sm:top-4 sm:right-5">
                    <a href="{{ route('ask.permission') }}" class="block sm:inline-block text-lg sm:text-sm font-semibold text-white bg-gray-700 hover:bg-gray-800 px-4 py-2 sm:px-3 sm:py-1 rounded-md transition duration-300 text-center w-full sm:w-auto">
                        Pedir permisos de admin
                    </a>
                </div>
            @endif

            <h2 class="text-xl font-bold text-fuchsia-50 text-center">Editar Perfil</h2>
        </div> --}}






        <!-- Contenido -->
        <div class="p-5 sm:p-6">
            <!-- Mostrar errores -->
            @if ($errors->any())
                <div class="mb-5 text-sm">
                    <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded">
                        <p class="font-medium">Por favor corrige los siguientes errores:</p>
                        <ul class="mt-1 ml-4 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('pages.profile.update', $user) }}" method="POST" class="space-y-5" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <!-- Diseño en dos columnas en pantallas grandes y en columna en móviles -->
                <div class="grid grid-cols-1 md:grid-cols-[auto,1fr] gap-6 items-start">
                    <!-- Imagen de perfil -->
                    <div class="flex flex-col items-center mx-auto md:mx-0">
                        <div class="relative group">
                            <img id="profileImage" src="{{ Storage::url($user->photo) }}" alt="Avatar"
                                class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover border-2 border-white shadow-md">
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <label class="cursor-pointer text-white text-sm px-3 py-1.5 rounded-full bg-slate-800 hover:bg-slate-700 transition-colors duration-200">
                                    Cambiar foto
                                    <input name="photo" type="file" id="fileInput" class="hidden" accept="image/*">
                                </label>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 text-center">Haz clic en la imagen para cambiarla</p>
                    </div>

                    <!-- Campos del formulario -->
                    <div class="space-y-4 w-full">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-slate-500 focus:border-slate-500 px-3 py-2">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-slate-500 focus:border-slate-500 px-3 py-2">
                        </div>
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit"
                        class="w-full bg-slate-800 hover:bg-slate-700 text-fuchsia-50 py-2.5 rounded-3xl font-medium shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview image before upload
    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Also trigger file input when clicking on the image itself for better UX
    document.getElementById('profileImage').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });
</script>
@endsection
