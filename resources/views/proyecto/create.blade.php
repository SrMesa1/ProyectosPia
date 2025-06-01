@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 bg-gray-100">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">{{ __('Crear Nuevo Proyecto') }}</h2>

                @if ($errors->has('general'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ $errors->first('general') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('proyecto.store') }}" class="space-y-6">
                    @csrf

                    <!-- Título -->
                    <div>
                        <label for="titulo" class="block text-sm font-medium text-gray-700">
                            {{ __('Título del Proyecto') }}
                        </label>
                        <input id="titulo" type="text" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('titulo') border-red-500 @enderror"
                            name="titulo" value="{{ old('titulo') }}" required autofocus>
                        @error('titulo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">
                            {{ __('Descripción') }}
                        </label>
                        <textarea id="descripcion" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('descripcion') border-red-500 @enderror"
                            name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo de Proyecto -->
                    <div>
                        <label for="id_tipo_proyecto" class="block text-sm font-medium text-gray-700">
                            {{ __('Tipo de Proyecto') }}
                        </label>
                        <select id="id_tipo_proyecto" name="id_tipo_proyecto" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('id_tipo_proyecto') border-red-500 @enderror"
                            required>
                            <option value="">Seleccione el tipo</option>
                            @foreach($tipos_proyecto as $tipo)
                                <option value="{{ $tipo->id_tipo_proyecto }}" 
                                    {{ old('id_tipo_proyecto') == $tipo->id_tipo_proyecto ? 'selected' : '' }}
                                    data-min="{{ $tipo->duracion_minima }}"
                                    data-max="{{ $tipo->duracion_maxima }}">
                                    {{ $tipo->nombre }} ({{ $tipo->duracion_minima }}-{{ $tipo->duracion_maxima }} semanas)
                                </option>
                            @endforeach
                        </select>
                        @error('id_tipo_proyecto')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Asignatura -->
                    <div>
                        <label for="id_asignatura" class="block text-sm font-medium text-gray-700">
                            {{ __('Asignatura') }}
                        </label>
                        <select id="id_asignatura" name="id_asignatura" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('id_asignatura') border-red-500 @enderror"
                            required>
                            <option value="">Seleccione la asignatura</option>
                            @foreach($asignaturas as $asignatura)
                                <option value="{{ $asignatura->id_asignatura }}" {{ old('id_asignatura') == $asignatura->id_asignatura ? 'selected' : '' }}>
                                    {{ $asignatura->nombre }} ({{ $asignatura->codigo }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_asignatura')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grupo -->
                    <div>
                        <label for="grupo" class="block text-sm font-medium text-gray-700">
                            {{ __('Grupo') }}
                        </label>
                        <input id="grupo" type="text" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('grupo') border-red-500 @enderror"
                            name="grupo" value="{{ old('grupo') }}" required>
                        @error('grupo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Inicio -->
                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">
                            {{ __('Fecha de Inicio') }}
                        </label>
                        <input id="fecha_inicio" type="date" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('fecha_inicio') border-red-500 @enderror"
                            name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                        @error('fecha_inicio')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Fin -->
                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700">
                            {{ __('Fecha de Fin') }}
                        </label>
                        <input id="fecha_fin" type="date" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('fecha_fin') border-red-500 @enderror"
                            name="fecha_fin" value="{{ old('fecha_fin') }}" required>
                        @error('fecha_fin')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('proyecto.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Crear Proyecto') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoSelect = document.getElementById('id_tipo_proyecto');
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');

    function updateFechaFin() {
        if (!fechaInicio.value || !tipoSelect.value) return;

        const selectedOption = tipoSelect.options[tipoSelect.selectedIndex];
        const minWeeks = parseInt(selectedOption.dataset.min);
        const maxWeeks = parseInt(selectedOption.dataset.max);

        const startDate = new Date(fechaInicio.value);
        const minEndDate = new Date(startDate);
        minEndDate.setDate(startDate.getDate() + (minWeeks * 7));
        
        const maxEndDate = new Date(startDate);
        maxEndDate.setDate(startDate.getDate() + (maxWeeks * 7));

        fechaFin.min = minEndDate.toISOString().split('T')[0];
        fechaFin.max = maxEndDate.toISOString().split('T')[0];
    }

    tipoSelect.addEventListener('change', updateFechaFin);
    fechaInicio.addEventListener('change', updateFechaFin);
});
</script>
@endpush

@endsection 