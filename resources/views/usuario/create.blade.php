@extends('layouts.app')

@section('content')
<div class="px-4 py-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Registrar Usuario</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('usuario.store') }}" class="space-y-6">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div>
                <label for="nombre_usuario" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" value="{{ old('nombre_usuario') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="id_tipo_usuario" class="block text-sm font-medium text-gray-700">Tipo de Usuario</label>
                <select name="id_tipo_usuario" id="id_tipo_usuario" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Seleccione un tipo</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id_tipo_usuario }}" {{ old('id_tipo_usuario') == $tipo->id_tipo_usuario ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 