@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="mb-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $proyecto->titulo }}</h2>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full
                                @if($proyecto->estado === 'pendiente') bg-yellow-100 text-yellow-800
                                @elseif($proyecto->estado === 'en_progreso') bg-blue-100 text-blue-800
                                @elseif($proyecto->estado === 'completado') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($proyecto->estado) }}
                            </span>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('proyecto.edit', $proyecto->id_proyecto) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </a>
                            <form action="{{ route('proyecto.destroy', $proyecto->id_proyecto) }}" method="POST" 
                                  onsubmit="return confirm('¿Está seguro que desea eliminar este proyecto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Información Principal -->
                    <div class="md:col-span-2 space-y-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Descripción</h3>
                            <p class="text-gray-600">{{ $proyecto->descripcion }}</p>
                        </div>

                        <!-- Estudiantes Asociados -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Estudiantes Participantes</h3>
                            @if($proyecto->estudiantes->count() > 0)
                                <div class="space-y-3">
                                    @foreach($proyecto->estudiantes as $estudiante)
                                        <div class="flex items-center space-x-3 p-3 bg-white rounded-lg">
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $estudiante->nombre }}</p>
                                                <p class="text-sm text-gray-500">Código: {{ $estudiante->codigo }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">No hay estudiantes asociados al proyecto.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Información Lateral -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detalles del Proyecto</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Tipo de Proyecto</p>
                                    <p class="font-medium">{{ $proyecto->tipoProyecto->nombre }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Fecha de Inicio</p>
                                    <p class="font-medium">{{ $proyecto->fecha_inicio->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Fecha de Finalización</p>
                                    <p class="font-medium">{{ $proyecto->fecha_fin->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Duración</p>
                                    <p class="font-medium">{{ $proyecto->fecha_inicio->diffInDays($proyecto->fecha_fin) + 1 }} días</p>
                                </div>
                            </div>
                        </div>

                        @if($proyecto->asignaturas->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Asignaturas Relacionadas</h3>
                                <div class="space-y-3">
                                    @foreach($proyecto->asignaturas as $asignatura)
                                        <div class="p-3 bg-white rounded-lg">
                                            <p class="font-medium text-gray-800">{{ $asignatura->nombre }}</p>
                                            <p class="text-sm text-gray-500">Grupo: {{ $asignatura->pivot->grupo }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('proyecto.index') }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver a la lista de proyectos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 