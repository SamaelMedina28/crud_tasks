<x-app-layout>
    <main class="max-w-3xl mx-auto px-4 py-6">
        <!-- Encabezado simplificado -->
        <div class="mb-6">
            <div class="flex items-center space-x-3">
                <a href="{{ route('tasks.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors p-1 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl font-semibold text-gray-800">Editar Tarea</h1>
            </div>
            <p class="mt-1 text-sm text-gray-500 ml-9">Actualiza los detalles de esta tarea</p>
        </div>

        <!-- Formulario limpio y funcional -->
        <form action="{{ route('tasks.update', $task) }}" method="POST" class="bg-white rounded-lg border border-gray-200 shadow-sm">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <!-- Campo Título -->
                <div>
                    <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título *</label>
                    <input type="text" name="titulo" id="titulo" required
                           value="{{ old('titulo', $task->titulo) }}"
                           placeholder="Ej: Revisar informe trimestral"
                           class="block w-full px-3 py-2 border {{ $errors->has('titulo') ? 'border-red-300 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }} rounded-md shadow-sm focus:outline-none focus:ring-1 focus:border-blue-500">
                    @error('titulo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo Descripción -->
                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4"
                              placeholder="Ej: Verificar cifras y preparar resumen ejecutivo"
                              class="block w-full px-3 py-2 border {{ $errors->has('descripcion') ? 'border-red-300 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }} rounded-md shadow-sm focus:outline-none focus:ring-1 focus:border-blue-500">{{ old('descripcion', $task->descripcion) }}</textarea>
                    @error('descripcion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campos en fila para pantallas medianas/grandes -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Campo Estado -->
                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado *</label>
                        <select name="estado" id="estado" required
                                class="block w-full px-3 py-2 border {{ $errors->has('estado') ? 'border-red-300 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }} rounded-md shadow-sm focus:outline-none focus:ring-1 focus:border-blue-500">
                            <option value="pendiente" {{ old('estado', $task->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_proceso" {{ old('estado', $task->estado) == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="completada" {{ old('estado', $task->estado) == 'completada' ? 'selected' : '' }}>Completada</option>
                        </select>
                        @error('estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campo Fecha Límite -->
                    <div>
                        <label for="fecha_limite" class="block text-sm font-medium text-gray-700 mb-1">Fecha Límite</label>
                        <input type="date" name="fecha_limite" id="fecha_limite"
                               value="{{ old('fecha_limite', $task->fecha_limite ? $task->fecha_limite->format('Y-m-d') : '') }}"
                               min="{{ now()->format('Y-m-d') }}"
                               class="block w-full px-3 py-2 border {{ $errors->has('fecha_limite') ? 'border-red-300 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }} rounded-md shadow-sm focus:outline-none focus:ring-1 focus:border-blue-500">
                        @error('fecha_limite')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pie del formulario con botones -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </main>
</x-app-layout>
