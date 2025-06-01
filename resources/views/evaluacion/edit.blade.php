@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 bg-gray-100">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-8">{{ __('Editar Evaluación') }}</h2>

                <!-- Información del Proyecto -->
                <div class="mb-8 bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Detalles del Proyecto</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600">Título:</p>
                            <p class="font-medium">{{ $evaluacion->proyecto->titulo }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tipo:</p>
                            <p class="font-medium">{{ $evaluacion->proyecto->tipoProyecto->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Estado:</p>
                            <p class="font-medium">{{ ucfirst($evaluacion->proyecto->estado) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Asignatura:</p>
                            <p class="font-medium">
                                @foreach($evaluacion->proyecto->asignaturas as $asignatura)
                                    {{ $asignatura->nombre }} ({{ $asignatura->pivot->grupo }})
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Descripción:</p>
                        <p class="mt-1">{{ $evaluacion->proyecto->descripcion }}</p>
                    </div>
                </div>

                <!-- Formulario de Evaluación -->
                <form method="POST" action="{{ route('evaluacion.update', $evaluacion->id_evaluacion) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Calificación -->
                    <div>
                        <label for="calificacion" class="block text-sm font-medium text-gray-700">
                            {{ __('Calificación (0-5)') }}
                        </label>
                        <input id="calificacion" type="number" step="0.1" min="0" max="5"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('calificacion') border-red-500 @enderror"
                            name="calificacion" value="{{ old('calificacion', $evaluacion->calificacion) }}" required>
                        @error('calificacion')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Comentarios -->
                    <div>
                        <label for="comentarios" class="block text-sm font-medium text-gray-700">
                            {{ __('Comentarios y Observaciones') }}
                        </label>
                        <textarea id="comentarios" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('comentarios') border-red-500 @enderror"
                            name="comentarios" required>{{ old('comentarios', $evaluacion->comentarios) }}</textarea>
                        @error('comentarios')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <form action="{{ route('evaluacion.destroy', $evaluacion->id_evaluacion) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium"
                                    onclick="return confirm('¿Está seguro que desea eliminar esta evaluación?')">
                                {{ __('Eliminar Evaluación') }}
                            </button>
                        </form>
                        
                        <div class="flex space-x-4">
                            <a href="{{ route('evaluador.dashboard') }}" 
                               class="text-gray-600 hover:text-gray-800 font-medium">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Actualizar Evaluación') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 