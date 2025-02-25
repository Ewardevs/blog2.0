<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-80">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Iniciar sesión</h2>
        <form action="{{route("login")}}" method="post">
            @csrf
            @error('email')
            <span class="text-red-500">{{$message}}</span>
            @enderror
            <input type="text" name="email" placeholder="Nombre de usuario" required class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            @error('password')
            <span class="text-red-500">{{$message}}</span>
            @enderror
            <input type="password" name="password" placeholder="Contraseña" required class="w-full p-3 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            <input type="submit" value="Iniciar sesión" class="w-full p-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 cursor-pointer transition">
        </form>
         <a href="{{route("register")}}" class="text-sm text-gray-600 hover:text-green-500 block text-center mt-4">O registrate</a>
    </div>

</body>
</html>
