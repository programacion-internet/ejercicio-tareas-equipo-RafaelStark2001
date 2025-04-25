<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas en Equipo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Tarea Equipo</h1>
            @auth
                <span>Hola, {{ Auth::user()->name }}</span>
            @endauth
        </div>
    </header>

    <!-- Aquí se mostrará el contenido de la página -->
    <main class="flex-1">
        {{ $slot }}
    </main>

</body>
</html>
