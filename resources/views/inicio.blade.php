<x-app-layout>
    <main class="max-w-3xl mx-auto px-4 py-6">
        <!-- Encabezado simplificado -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Mis Tareas</h1>
            <a href="{{ route('tasks.create') }}" class="flex items-center text-sm text-white bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Nueva Tarea
            </a>
        </div>

        <!-- Lista de Tareas optimizada -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 divide-y divide-gray-200">
            @forelse ($tasks as $task)
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex justify-between items-start space-x-3">
                        <!-- Contenido principal -->
                        <div class="flex-1 min-w-0">
                            <!-- Título y estado en línea -->
                            <div class="flex items-baseline space-x-2">
                                <h2 class="text-lg font-medium text-gray-800 truncate">{{ $task->titulo }}</h2>
                                <span class="shrink-0 text-xs px-2 py-1 rounded-full
                                    {{ $task->estado == 'pendiente' ? 'bg-red-100 text-red-800' :
                                       ($task->estado == 'en_proceso' ? 'bg-blue-100 text-blue-800' :
                                       'bg-green-100 text-green-800') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->estado)) }}
                                </span>
                            </div>
                            {{-- Descripcion de la tarea --}}
                            <div class="flex items-baseline space-x-2">
                                <p class="shrink-0 text-md px-2 py-1 rounded-full text-gray-600">
                                    {{ ucfirst($task->descripcion) }}
                                </p>
                            </div>

                            <!-- Fecha y descripción (si existe) -->
                            <div class="mt-1 flex items-center text-sm text-gray-500">
                                @if ($task->fecha_limite)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $task->fecha_limite->format('d/m/Y') }}
                                @endif
                            </div>
                        </div>

                        <!-- Acciones compactas -->
                        <div class="flex space-x-1">
                            <a href="{{ route('tasks.show', $task) }}" title="Ver" class="p-1 text-gray-500 hover:text-blue-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                            </a>

                            <a href="{{ route('tasks.edit', $task) }}" title="Editar" class="p-1 text-gray-500 hover:text-gray-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar esta tarea?')" title="Eliminar" class="p-1 text-gray-500 hover:text-red-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="mt-3 text-base font-medium text-gray-700">No hay tareas registradas</h3>
                    <p class="mt-1 text-sm text-gray-500">Comienza agregando tu primera tarea</p>
                    <div class="mt-4">
                        <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-gray-800 hover:bg-gray-700 focus:outline-none">
                            Crear Tarea
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginación discreta -->
        @if($tasks->hasPages())
            <div class="mt-4 px-2">
                {{ $tasks->links('pagination::simple-tailwind') }}
            </div>
        @endif
    </main>
</x-app-layout>
