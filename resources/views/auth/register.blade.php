<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre de usuario -->
        <div>
            <x-input-label for="nombre_usuario" :value="__('Nombre de Usuario')" />
            <x-text-input id="nombre_usuario" class="block mt-1 w-full" type="text" name="nombre_usuario" :value="old('nombre_usuario')" required autofocus />
            <x-input-error :messages="$errors->get('nombre_usuario')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="contraseña" :value="__('Contraseña')" />
            <x-text-input id="contraseña" class="block mt-1 w-full" type="password" name="contraseña" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('contraseña')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mt-4">
            <x-input-label for="contraseña_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="contraseña_confirmation" class="block mt-1 w-full" type="password" name="contraseña_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('contraseña_confirmation')" class="mt-2" />
        </div>

        <!-- ID Tipo Usuario (puedes cambiar esto por un select si deseas) -->
        <div class="mt-4">
            <x-input-label for="id_tipo_usuario" :value="__('Tipo de Usuario')" />
            <x-text-input id="id_tipo_usuario" class="block mt-1 w-full" type="number" name="id_tipo_usuario" :value="old('id_tipo_usuario')" required />
            <x-input-error :messages="$errors->get('id_tipo_usuario')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

