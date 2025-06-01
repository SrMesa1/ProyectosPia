@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 bg-gray-100">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">{{ __('Registro de Evaluador') }}</h2>

                <form method="POST" action="{{ route('evaluador.store') }}" class="space-y-6">
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

                    <!-- Institución -->
                    <div>
                        <label for="institucion" class="block text-sm font-medium text-gray-700">
                            {{ __('Institución') }}
                        </label>
                        <input id="institucion" type="text" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('institucion') border-red-500 @enderror"
                            name="institucion" value="{{ old('institucion') }}" required>
                        @error('institucion')
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
@endsection 