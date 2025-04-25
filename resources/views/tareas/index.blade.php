<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Mis tareas</h2>
    </x-slot>

    <div class="py-6 px-4 space-y-8">
        <a href="{{ route('tareas.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Crear tarea</a>

        <!-- Tareas propias -->
        <div>
            <h3 class="text-lg font-bold mb-2">Tareas propias</h3>
            <table class="w-full bg-white shadow rounded">
                <thead>
                    <tr class="bg-gray-200 text-sm text-gray-600 uppercase">
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Autor</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tareasPropias as $tarea)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $tarea->nombre }}</td>
                            <td class="px-4 py-2">Tú</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('tareas.show', $tarea) }}" class="text-blue-600 hover:underline">Ver</a>
                                <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" onsubmit="return confirm('¿Eliminar tarea?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-4 py-2">No tienes tareas creadas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tareas donde fue invitado -->
        <div>
            <h3 class="text-lg font-bold mb-2">Tareas donde fui invitado</h3>
            <table class="w-full bg-white shadow rounded">
                <thead>
                    <tr class="bg-gray-200 text-sm text-gray-600 uppercase">
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Autor</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tareasInvitado as $tarea)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $tarea->nombre }}</td>
                            <td class="px-4 py-2">{{ $tarea->owner->name ?? 'Desconocido' }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('tareas.show', $tarea) }}" class="text-blue-600 hover:underline">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-4 py-2">No has sido invitado a ninguna tarea.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
