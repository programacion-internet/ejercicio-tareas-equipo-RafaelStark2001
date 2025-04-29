<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas en Equipo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Tarea Equipo</h1>
            <div class="flex items-center">
                @auth
                    <span class="mr-4">Hola, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded text-sm hover:bg-red-600">Cerrar sesión</button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1">
        {{ $slot }}
    </main>

</body>
</html>
