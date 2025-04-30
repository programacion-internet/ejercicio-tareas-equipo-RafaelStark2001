<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">Gestión de Tareas</a>

            <div class="d-flex align-items-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/tareas') }}" class="btn btn-primary me-2">Mis Tareas</a>

                        <!-- Formulario de Cerrar Sesión -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Iniciar sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container text-center my-5 flex-grow-1">
        <h1 class="mb-4 fw-bold">Bienvenido a la Gestión de Tareas</h1>
        <p class="lead mb-4">
            Administra tus tareas, colabora en equipo y aumenta tu productividad con nuestro sistema.
        </p>

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/tareas') }}" class="btn btn-success btn-lg">Ver Mis Tareas</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-success btn-lg">Comenzar Ahora</a>
            @endauth
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto">
        <small>© {{ date('Y') }} Gestión de Tareas. Todos los derechos reservados.</small>
    </footer>

</body>
</html>
