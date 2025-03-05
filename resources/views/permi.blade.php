<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Permiso de Administrador</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-2xl w-full max-w-lg">
        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-4 text-center">Solicitud de Permiso de
            Administrador</h2>
        <p class="text-gray-600 text-center mb-6 text-sm md:text-base">Completa el formulario para solicitar permisos de
            administrador.</p>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        <form action="{{ route('ask.permission.post') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('POST')
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Motivo de la solicitud:</label>
                <textarea name="reason"
                    class="w-full h-32 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-400 transition resize-none"
                    placeholder="Explica el motivo"></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Adjuntar archivo PDF:</label>
                <input type="file" name="file" accept="application/pdf"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-400 transition">
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-bold hover:shadow-xl transition">Enviar
                Solicitud</button>
        </form>
    </div>
</body>

</html>
