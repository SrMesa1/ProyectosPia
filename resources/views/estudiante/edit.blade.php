<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Perfil de Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('estudiante.update', $estudiante->id_estudiante) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre Completo')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $estudiante->nombre)" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Código -->
                        <div class="mt-4">
                            <x-input-label for="codigo" :value="__('Código Estudiantil')" />
                            <x-text-input id="codigo" class="block mt-1 w-full" type="text" name="codigo" :value="old('codigo', $estudiante->codigo)" required />
                            <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                        </div>

                        <!-- Semestre -->
                        <div class="mt-4">
                            <x-input-label for="semestre" :value="__('Semestre Actual')" />
                            <x-text-input id="semestre" class="block mt-1 w-full" type="number" name="semestre" :value="old('semestre', $estudiante->semestre)" min="1" max="10" required />
                            <x-input-error :messages="$errors->get('semestre')" class="mt-2" />
                        </div>

                        <!-- Programa -->
                        <div class="mt-4">
                            <x-input-label for="id_programa" :value="__('Programa Académico')" />
                            <select id="id_programa" name="id_programa" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($programas as $programa)
                                    <option value="{{ $programa->id_programa }}" {{ old('id_programa', $estudiante->id_programa) == $programa->id_programa ? 'selected' : '' }}>
                                        {{ $programa->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_programa')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('estudiante.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Cancelar') }}
                            </a>

                            <x-primary-button class="ml-4">
                                {{ __('Guardar Cambios') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 