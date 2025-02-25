<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Crear cuenta</h2>

        <!-- Mensajes de error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nombre completo" class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>

            <input type="email" name="email" placeholder="Correo electrónico" class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>

            <input type="password" name="password" placeholder="Contraseña" class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>

            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="w-full p-3 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>

            <input type="submit" class="w-full p-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-green-500 hover:text-green-600">Iniciar sesión</a></p>
    </div>
</div>

</body>
</html>
