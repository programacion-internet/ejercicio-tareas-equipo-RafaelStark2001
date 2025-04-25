<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Crear nueva tarea</h2>
    </x-slot>

    <div class="py-6 px-4">
        <form method="POST" action="{{ route('tareas.store') }}">
            @csrf

            <!-- Nombre de la tarea -->
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la tarea</label>
                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>

            <!-- Descripción de la tarea -->
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required></textarea>
            </div>

            <!-- Fecha límite -->
            <div class="mb-4">
                <label for="fecha_limite" class="block text-sm font-medium text-gray-700">Fecha límite</label>
                <input type="date" name="fecha_limite" id="fecha_limite" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Crear tarea</button>
            </div>
        </form>
    </div>
</x-app-layout>
