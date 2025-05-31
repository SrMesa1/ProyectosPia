@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 bg-gray-100">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">{{ __('Registro de Evaluador') }}</h2>

                <form method="POST" action="{{ route('evaluador.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user_id }}">

                    <!-- Nombre Completo -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">
                            {{ __('Nombre Completo') }}
                        </label>
                        <input id="nombre" type="text" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nombre') border-red-500 @enderror"
                            name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Correo Electrónico -->
                    <div>
                        <label for="correo" class="block text-sm font-medium text-gray-700">
                            {{ __('Correo Electrónico') }}
                        </label>
                        <input id="correo" type="email" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('correo') border-red-500 @enderror"
                            name="correo" value="{{ old('correo') }}" required>
                        @error('correo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Documento de Identidad -->
                    <div>
                        <label for="documento" class="block text-sm font-medium text-gray-700">
                            {{ __('Documento de Identidad') }}
                        </label>
                        <input id="documento" type="text" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('documento') border-red-500 @enderror"
                            name="documento" value="{{ old('documento') }}" required>
                        @error('documento')
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

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Completar Registro') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 