@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 bg-gray-100">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">{{ __('Crear Nuevo Proyecto') }}</h2>

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
                        <label for="tipo" class="block text-sm font-medium text-gray-700">
                            {{ __('Tipo de Proyecto') }}
                        </label>
                        <select id="tipo" name="tipo" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('tipo') border-red-500 @enderror"
                            required>
                            <option value="">Seleccione el tipo</option>
                            <option value="PIA" {{ old('tipo') == 'PIA' ? 'selected' : '' }}>PIA</option>
                            <option value="PA" {{ old('tipo') == 'PA' ? 'selected' : '' }}>PA</option>
                        </select>
                        @error('tipo')
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

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Crear Proyecto') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 