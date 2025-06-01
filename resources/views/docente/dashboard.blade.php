@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Información del Docente -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Perfil del Docente</h2>
                        <p class="text-gray-600 mt-1">{{ $docente->nombre }}</p>
                    </div>
                    <a href="{{ route('docente.edit', $docente->id_docente) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Editar Perfil
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-medium text-gray-700 mb-2">Información Personal</h3>
                        <div class="space-y-2">
                            <p><span class="text-gray-600">Número de Empleado:</span> {{ $docente->numero_empleado }}</p>
                            <p><span class="text-gray-600">Especialidad:</span> {{ $docente->especialidad }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-medium text-gray-700 mb-2">Información Académica</h3>
                        <div class="space-y-2">
                            <p><span class="text-gray-600">Programa:</span> {{ $docente->programa->nombre }}</p>
                            <p><span class="text-gray-600">Correo:</span> {{ $docente->correo }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proyectos de las Asignaturas -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Proyectos de mis Asignaturas</h2>

                @if($docente->proyectos->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($docente->proyectos as $proyecto)
                            <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="p-5">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $proyecto->titulo }}</h3>
                                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($proyecto->descripcion, 100) }}</p>
                                    
                                    <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                                        <div>
                                            <span class="text-gray-500">Tipo:</span>
                                            <span class="font-medium">{{ $proyecto->tipoProyecto->nombre }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Estado:</span>
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                @if($proyecto->estado === 'pendiente') bg-yellow-100 text-yellow-800
                                                @elseif($proyecto->estado === 'en_progreso') bg-blue-100 text-blue-800
                                                @elseif($proyecto->estado === 'completado') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($proyecto->estado) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Inicio:</span>
                                            <span class="font-medium">{{ $proyecto->fecha_inicio->format('d/m/Y') }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Fin:</span>
                                            <span class="font-medium">{{ $proyecto->fecha_fin->format('d/m/Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="border-t pt-4">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Asignatura:</span>
                                            {{ $proyecto->pivot->asignatura->nombre }} (Grupo: {{ $proyecto->pivot->grupo }})
                                        </p>
                                    </div>

                                    <div class="flex justify-end mt-4">
                                        <a href="{{ route('proyecto.show', $proyecto->id_proyecto) }}" 
                                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            Ver detalles →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-600">No hay proyectos asociados a tus asignaturas.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 