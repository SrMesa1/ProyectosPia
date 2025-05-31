@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">{{ __('Registro de Usuario') }}</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre de Usuario -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    {{ __('Nombre de Usuario') }}
                </label>
                <input id="name" type="text" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    {{ __('Correo Electrónico') }}
                </label>
                <input id="email" type="email" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    {{ __('Contraseña') }}
                </label>
                <input id="password" type="password" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('password') border-red-500 @enderror"
                    name="password" required autocomplete="new-password">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mb-4">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">
                    {{ __('Confirmar Contraseña') }}
                </label>
                <input id="password-confirm" type="password" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    name="password_confirmation" required autocomplete="new-password">
            </div>

            <!-- Tipo de Usuario -->
            <div class="mb-6">
                <label for="tipo_usuario" class="block text-sm font-medium text-gray-700">
                    {{ __('Tipo de Usuario') }}
                </label>
                <select id="tipo_usuario" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('tipo_usuario') border-red-500 @enderror"
                    name="tipo_usuario" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="1">Estudiante</option>
                    <option value="2">Docente</option>
                    <option value="3">Evaluador</option>
                </select>
                @error('tipo_usuario')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('¿Ya tienes una cuenta?') }}
                </a>

                <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Registrar') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

