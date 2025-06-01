@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Perfil de Estudiante</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-700 mb-2">Información Personal</h3>
                        <div class="space-y-2">
                            <p><span class="text-gray-600">Nombre:</span> {{ $estudiante->nombre }}</p>
                            <p><span class="text-gray-600">Código:</span> {{ $estudiante->codigo }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-700 mb-2">Información Académica</h3>
                        <div class="space-y-2">
                            <p><span class="text-gray-600">Programa:</span> {{ $estudiante->programa->nombre }}</p>
                            <p><span class="text-gray-600">Semestre:</span> {{ $estudiante->semestre }}° Semestre</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('proyecto.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Registrar Proyecto
                    </a>
                </div>

                @if($estudiante->proyectos->count() > 0)
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Mis Proyectos</h3>
                        <div class="bg-gray-50 rounded-lg divide-y divide-gray-200">
                            @foreach($estudiante->proyectos as $proyecto)
                                <div class="p-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900">{{ $proyecto->titulo }}</h4>
                                            <p class="text-sm text-gray-600">{{ $proyecto->descripcion }}</p>
                                        </div>
                                        <a href="{{ route('proyecto.show', $proyecto->id_proyecto) }}" 
                                           class="text-blue-600 hover:text-blue-800">
                                            Ver detalles →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 