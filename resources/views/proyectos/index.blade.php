@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Lista de Proyectos</h2>
                    <a href="{{ route('proyecto.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Nuevo Proyecto
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if($proyectos->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($proyectos as $proyecto)
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

                                    <div class="flex justify-end">
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
                        <p class="text-gray-600">No hay proyectos registrados.</p>
                        <p class="text-sm text-gray-500 mt-1">Comienza creando tu primer proyecto.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 