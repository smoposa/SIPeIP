<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="bg-white rounded-xl shadow-lg p-10">

            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">
                Inicio de sesión
            </h2>

            <!-- Correo -->
            <div>
                <x-input-label for="email" :value="'Correo'" />

                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username" />

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-input-label for="password" :value="'Contraseña'" />

                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password" />

                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2" />
            </div>

            <!-- Botón -->
            <div class="flex justify-center mt-8">
                <x-primary-button>
                    Ingresar
                </x-primary-button>
            </div>

        </div>

    </form>
</x-guest-layout>