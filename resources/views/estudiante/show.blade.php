@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Perfil del Estudiante</h2>
        
        <!-- Información del Estudiante -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Información Personal</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nombre:</p>
                    <p class="font-medium">{{ $estudiante->nombre }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Código:</p>
                    <p class="font-medium">{{ $estudiante->codigo }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Programa:</p>
                    <p class="font-medium">{{ $estudiante->programa->nombre }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Semestre:</p>
                    <p class="font-medium">{{ $estudiante->semestre }}</p>
                </div>
            </div>
        </div>

        <!-- Proyectos del Estudiante -->
        <div>
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-700">Mis Proyectos</h3>
                <a href="{{ route('proyecto.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition-colors">
                    Registrar Nuevo Proyecto
                </a>
            </div>

            @if($estudiante->proyectos->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($estudiante->proyectos as $proyecto)
                        <div class="bg-gray-50 rounded-lg p-4 shadow hover:shadow-md transition-shadow">
                            <h4 class="font-semibold text-lg mb-2">{{ $proyecto->titulo }}</h4>
                            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($proyecto->descripcion, 100) }}</p>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <div>
                                    <span class="text-gray-500">Inicio:</span>
                                    <span class="font-medium">{{ $proyecto->fecha_inicio->format('d/m/Y') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Fin:</span>
                                    <span class="font-medium">{{ $proyecto->fecha_fin->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($proyecto->estado === 'pendiente') bg-yellow-100 text-yellow-800
                                    @elseif($proyecto->estado === 'en_progreso') bg-blue-100 text-blue-800
                                    @elseif($proyecto->estado === 'completado') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $proyecto->estado)) }}
                                </span>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('proyecto.show', $proyecto->id_proyecto) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Ver detalles →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <p class="text-gray-600">No tienes proyectos registrados aún.</p>
                    <p class="text-sm text-gray-500 mt-2">Comienza registrando tu primer proyecto.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 