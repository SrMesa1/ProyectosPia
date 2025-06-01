@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Editar Proyecto</h2>
                </div>

                @if ($errors->any())
                    <div class="mb-6">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">¡Hay errores en el formulario!</strong>
                            <ul class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('proyecto.update', $proyecto->id_proyecto) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="titulo" class="block text-sm font-medium text-gray-700">Título del Proyecto</label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $proyecto->titulo) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" 
                                   value="{{ old('fecha_inicio', $proyecto->fecha_inicio->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de Finalización</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" 
                                   value="{{ old('fecha_fin', $proyecto->fecha_fin->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label for="id_tipo_proyecto" class="block text-sm font-medium text-gray-700">Tipo de Proyecto</label>
                        <select name="id_tipo_proyecto" id="id_tipo_proyecto"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach($tipos_proyecto as $tipo)
                                <option value="{{ $tipo->id_tipo_proyecto }}" 
                                        {{ old('id_tipo_proyecto', $proyecto->id_tipo_proyecto) == $tipo->id_tipo_proyecto ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado del Proyecto</label>
                        <select name="estado" id="estado"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="pendiente" {{ old('estado', $proyecto->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_progreso" {{ old('estado', $proyecto->estado) == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                            <option value="completado" {{ old('estado', $proyecto->estado) == 'completado' ? 'selected' : '' }}>Completado</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('proyecto.show', $proyecto->id_proyecto) }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Cancelar</a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 