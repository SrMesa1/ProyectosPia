@extends('layouts.app')

@section('content')
<div class="px-4 py-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Completar Perfil de Estudiante</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('estudiante.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre Completo</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="codigo" class="block text-sm font-medium text-gray-700">Código de Estudiante</label>
                <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="semestre" class="block text-sm font-medium text-gray-700">Semestre</label>
                <select name="semestre" id="semestre" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Seleccione el semestre</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('semestre') == $i ? 'selected' : '' }}>{{ $i }}° Semestre</option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="id_programa" class="block text-sm font-medium text-gray-700">Programa Académico</label>
                <select name="id_programa" id="id_programa" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Seleccione el programa</option>
                    @foreach($programas as $programa)
                        <option value="{{ $programa->id_programa }}" {{ old('id_programa') == $programa->id_programa ? 'selected' : '' }}>
                            {{ $programa->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Guardar Perfil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 