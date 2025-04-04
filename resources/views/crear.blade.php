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
                <h1 class="text-2xl font-semibold text-gray-800">Nueva Tarea</h1>
            </div>
            <p class="mt-1 text-sm text-gray-500 ml-9">Completa los detalles de la tarea</p>
        </div>

        <!-- Mensajes de Error mejorados -->
        @if ($errors->any())
            <div class="mb-6 p-3 bg-red-50 rounded-lg border border-red-200">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-sm font-medium text-red-800">Hay errores en el formulario:</h3>
                </div>
                <ul class="mt-1 ml-7 text-sm text-red-700 list-disc space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario simplificado -->
        <form action="{{ route('tasks.store') }}" method="POST" class="bg-white rounded-lg border border-gray-200 shadow-sm">
            @csrf

            <div class="p-6 space-y-6">
                <!-- Campo Título -->
                <div>
                    <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título *</label>
                    <input type="text" name="titulo" id="titulo" required value="{{ old('titulo') }}"
                           placeholder="Ej: Revisar informe mensual"
                           class="block w-full px-3 py-2 border {{ $errors->has('titulo') ? 'border-red-300 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }} rounded-md shadow-sm focus:outline-none focus:ring-1 focus:border-blue-500">
                    @error('titulo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo Descripción -->
                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4"
                              placeholder="Ej: Revisar las cifras del último trimestre y preparar resumen para dirección"
                              class="block w-full px-3 py-2 border {{ $errors->has('descripcion') ? 'border-red-300 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500' }} rounded-md shadow-sm focus:outline-none focus:ring-1 focus:border-blue-500">{{ old('descripcion') }}</textarea>
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
                            <option value="" disabled selected>Seleccionar estado</option>
                            <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                            {{-- <option value="completada" {{ old('estado') == 'completada' ? 'selected' : '' }}>Completada</option> --}}
                        </select>
                        @error('estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campo Fecha Límite -->
                    <div>
                        <label for="fecha_limite" class="block text-sm font-medium text-gray-700 mb-1">Fecha Límite</label>
                        <input type="date" name="fecha_limite" id="fecha_limite" value="{{ old('fecha_limite') }}"
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
                    Crear Tarea
                </button>
            </div>
        </form>
    </main>
</x-app-layout>
