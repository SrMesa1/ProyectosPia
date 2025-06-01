@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 bg-gray-100">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">{{ __('Registro de Docente') }}</h2>

                <form method="POST" action="{{ route('docente.store') }}" class="space-y-6">
                    @csrf

                    <!-- Nombre Completo -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">
                            {{ __('Nombre Completo') }}
                        </label>
                        <input id="nombre" type="text" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nombre') border-red-500 @enderror"
                            name="nombre" value="{{ old('nombre') }}" required autofocus>
                        @error('nombre')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Número de Empleado -->
                    <div>
                        <label for="numero_empleado" class="block text-sm font-medium text-gray-700">
                            {{ __('Número de Empleado') }}
                        </label>
                        <input id="numero_empleado" type="text" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('numero_empleado') border-red-500 @enderror"
                            name="numero_empleado" value="{{ old('numero_empleado') }}" required>
                        @error('numero_empleado')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Especialidad -->
                    <div>
                        <label for="especialidad" class="block text-sm font-medium text-gray-700">
                            {{ __('Especialidad') }}
                        </label>
                        <input id="especialidad" type="text" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('especialidad') border-red-500 @enderror"
                            name="especialidad" value="{{ old('especialidad') }}" required>
                        @error('especialidad')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Asignaturas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Asignaturas que Imparte') }}
                        </label>
                        <div id="asignaturas-container" class="space-y-4">
                            <div class="asignatura-entry flex items-center space-x-4">
                                <div class="flex-1">
                                    <select name="asignaturas[0][id_asignatura]" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>
                                        <option value="">Seleccione una asignatura</option>
                                        @foreach($asignaturas as $asignatura)
                                            <option value="{{ $asignatura->id_asignatura }}">
                                                {{ $asignatura->nombre }} ({{ $asignatura->codigo }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-32">
                                    <input type="text" 
                                        name="asignaturas[0][grupo]" 
                                        placeholder="Grupo"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>
                                </div>
                                <button type="button" 
                                    class="remove-asignatura text-red-600 hover:text-red-800"
                                    style="display: none;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <button type="button" 
                            id="add-asignatura"
                            class="mt-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            + Agregar otra asignatura
                        </button>

                        @error('asignaturas')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Registrar') }}
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
        const container = document.getElementById('asignaturas-container');
        const addButton = document.getElementById('add-asignatura');
        let counter = 1;

        addButton.addEventListener('click', function() {
            const template = container.children[0].cloneNode(true);
            const selects = template.getElementsByTagName('select');
            const inputs = template.getElementsByTagName('input');
            const removeButton = template.querySelector('.remove-asignatura');

            // Actualizar los nombres de los campos
            for (let select of selects) {
                select.name = select.name.replace('[0]', `[${counter}]`);
                select.value = '';
            }
            for (let input of inputs) {
                input.name = input.name.replace('[0]', `[${counter}]`);
                input.value = '';
            }

            // Mostrar el botón de eliminar
            removeButton.style.display = 'block';
            removeButton.addEventListener('click', function() {
                template.remove();
            });

            container.appendChild(template);
            counter++;
        });

        // Mostrar el botón de eliminar si hay más de una asignatura
        const updateRemoveButtons = () => {
            const entries = container.children;
            for (let entry of entries) {
                const removeButton = entry.querySelector('.remove-asignatura');
                removeButton.style.display = entries.length > 1 ? 'block' : 'none';
            }
        };

        // Delegación de eventos para los botones de eliminar
        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-asignatura')) {
                e.target.closest('.asignatura-entry').remove();
                updateRemoveButtons();
            }
        });
    });
</script>
@endpush

@endsection