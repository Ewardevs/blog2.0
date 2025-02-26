@extends('layouts.app')

@section('content')
	<a class="text-pink" href={{route("pages.home")}}>Boton especial para chris</a>
    <div class="mt-14 bg-white shadow-lg rounded-lg p-6 w-full max-w-md mx-auto">
        <h2 class="text-2xl font-bold text-center mb-4">Editar Perfil</h2>

        <!-- Mostrar errores -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="bg-red-200 text-red-700 p-3 rounded">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Imagen de perfil -->
        <form action="{{ route('pages.profile.update', $user) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="flex flex-col items-center mb-4">
                <img id="profileImage" src="{{ Storage::url($user->photo) }}" alt="Avatar"
                    class="w-24 h-24 rounded-full border">
                <label class="mt-2 text-blue-600 cursor-pointer hover:underline">
                    Cambiar foto
                    <input name="photo" type="file" id="fileInput" class="hidden" accept="image/*">
                </label>
            </div>

            <!-- Formulario -->

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Guardar Cambios</button>
        </form>
    </div>

    <script>
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
    </script>
@endsection
