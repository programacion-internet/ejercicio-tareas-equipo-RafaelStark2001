<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        <h2 class="text-2xl font-bold mb-4">{{ $tarea->nombre }}</h2>
        <p class="mb-2 text-gray-700">{{ $tarea->descripcion }}</p>
        <p class="mb-6 text-sm text-gray-500">Fecha límite: {{ $tarea->fecha_limite->format('d/m/Y') }}</p>

        {{-- Formulario para invitar usuarios (si es el dueño de la tarea) --}}
        @if(Auth::id() === $tarea->user_id)
            <form method="POST" action="{{ route('tareas.invitar', $tarea) }}" class="mb-6 bg-white p-4 shadow rounded">
                @csrf
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-700">Invitar usuario:</label>
                <select name="user_id" id="user_id" class="w-full border-gray-300 rounded">
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="mt-3 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Invitar</button>
            </form>
        @endif

        {{-- Lista de usuarios invitados --}}
        <h3 class="text-xl font-semibold mt-6 mb-2">Usuarios invitados</h3>
        <ul class="mb-8">
            @forelse ($tarea->invitados as $invitado)
                <li class="text-gray-800">👤 {{ $invitado->name }}</li>
            @empty
                <li class="text-gray-500">No hay usuarios invitados.</li>
            @endforelse
        </ul>

        {{-- Subida de archivos --}}
        @if(Auth::id() === $tarea->user_id || $tarea->invitados->contains(Auth::user()))
            <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data" class="mb-6 bg-white p-4 rounded shadow">
                @csrf
                <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">

                <label for="archivo" class="block mb-2 text-sm font-medium text-gray-700">Subir archivo</label>
                <input type="file" name="archivo" id="archivo" class="w-full border border-gray-300 rounded p-2" required>

                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Subir</button>
            </form>
        @endif


        {{-- Lista de archivos --}}
        <h3 class="text-xl font-semibold mb-2">Archivos</h3>
        <div class="overflow-x-auto">
            <table class="w-full bg-white shadow-md rounded table-auto">
                <thead>
                    <tr class="bg-gray-200 text-left text-sm text-gray-600 uppercase">
                        <th class="px-4 py-3">Archivo</th>
                        <th class="px-4 py-3">Tipo</th>
                        <th class="px-4 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tarea->archivos as $archivo)
                        @php
                            $extension = strtolower(pathinfo($archivo->ruta, PATHINFO_EXTENSION));
                            $icono = match(true) {
                                in_array($extension, ['jpg', 'jpeg', 'png', 'gif']) => ['#photo', 'Imagen', 'text-blue-500'],
                                $extension === 'pdf' => ['#document', 'PDF', 'text-red-500'],
                                in_array($extension, ['doc', 'docx']) => ['#document-text', 'Word', 'text-indigo-500'],
                                default => ['#document', strtoupper($extension), 'text-gray-500']
                            };
                        @endphp
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 align-middle">
                                {{ basename($archivo->nombre_original) }}
                            </td>
                            <td class="px-4 py-3 align-middle">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 {{ $icono[2] }}" fill="none" stroke="currentColor">
                                        <use href="{{ $icono[0] }}" />
                                    </svg>
                                    <span class="text-sm">{{ $icono[1] }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center align-middle">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ asset('storage/' . $archivo->ruta) }}" target="_blank" class="text-blue-600 hover:underline text-sm">Ver</a>
                                    @if(Auth::id() === $tarea->user_id)
                                        <form action="{{ route('archivos.destroy', $archivo) }}" method="POST" onsubmit="return confirm('¿Eliminar archivo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Eliminar</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('tareas.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Volver</a>

    </div>

    {{-- Íconos Heroicons --}}
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="photo" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h14a2 2 0 012 2v11a2 2 0 01-2 2H6l-3 3V5z" />
        </symbol>
        <symbol id="document" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h10M5 19h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </symbol>
        <symbol id="document-text" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h5m4 0h.01M5 19h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </symbol>
    </svg>
</x-app-layout>

