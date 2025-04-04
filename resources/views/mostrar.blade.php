<x-app-layout>
    <main class="max-w-4xl mx-auto px-4 py-8">
        <!-- Encabezado mejorado -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div class="flex items-center">
                <a href="{{ route('tasks.index') }}" class="mr-4 text-gray-500 hover:text-gray-700 transition-colors p-2 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detalle de Tarea</h1>
                    <p class="text-sm text-gray-500 mt-1">ID: {{ $task->id }}</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="flex items-center px-4 py-2 bg-white border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Editar
                </a>

                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta tarea permanentemente?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center px-4 py-2 bg-white border border-red-200 text-red-600 rounded-lg hover:bg-red-50 transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Eliminar
                    </button>
                </form>
            </div>
        </div>

        <!-- Tarjeta de detalle mejorada -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300">
            <!-- Encabezado con estado -->
            <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <h2 class="text-2xl font-bold text-gray-800 break-words">{{ $task->titulo }}</h2>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{
                        $task->estado == 'pendiente' ? 'bg-red-100 text-red-800' :
                        ($task->estado == 'en_proceso' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800')
                    }}">
                        {{ ucfirst(str_replace('_', ' ', $task->estado)) }}
                    </span>
                    @if($task->fecha_limite && $task->fecha_limite->isPast() && $task->estado != 'completada')
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Vencida
                        </span>
                    @endif
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="p-6 space-y-6">
                <!-- Descripción -->
                <div class="space-y-2">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        Descripción
                    </h3>
                    <div class="prose max-w-none text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        @if($task->descripcion)
                            {!! nl2br(e($task->descripcion)) !!}
                        @else
                            <p class="text-gray-400 italic">No hay descripción disponible</p>
                        @endif
                    </div>
                </div>

                <!-- Metadatos en cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Fecha de creación -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-sm font-medium text-gray-500 mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Creada
                        </h4>
                        <p class="text-gray-700 ml-6">
                            {{ $task->created_at->isoFormat('D [de] MMMM [de] YYYY') }}
                            <span class="block text-sm text-gray-500 mt-1">
                                {{ $task->created_at->format('h:i A') }}
                            </span>
                        </p>
                    </div>

                    <!-- Fecha límite -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-sm font-medium text-gray-500 mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Fecha Límite
                        </h4>
                        <div class="ml-6">
                            @if($task->fecha_limite)
                                @if($task->fecha_limite->isToday())
                                    <p class="text-orange-300 font-medium text-md">
                                        {{ $task->fecha_limite->isoFormat('D [de] MMMM [de] YYYY') }}
                                        <br>
                                        La tarea esta por vencer
                                    </p>
                                @elseif($task->fecha_limite->isPast() && $task->estado != 'completada')
                                    <p class="text-red-600 font-medium">
                                        {{ $task->fecha_limite->isoFormat('D [de] MMMM [de] YYYY') }}
                                        <br>
                                        Venció hace {{ $task->fecha_limite->diffForHumans() }}
                                    </p>
                                @else
                                    <p class="text-gray-700">
                                        {{ $task->fecha_limite->isoFormat('D [de] MMMM [de] YYYY') }}
                                    </p>
                                @endif
                            @else
                                <p class="text-gray-400 italic">No especificada</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie de tarjeta mejorado -->
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <p class="text-sm text-gray-500">
                    Última actualización: <span class="font-medium">{{ $task->updated_at->diffForHumans() }}</span>
                </p>
                <div class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                    ID: {{ $task->id }}
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
