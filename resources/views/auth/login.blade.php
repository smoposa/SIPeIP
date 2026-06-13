<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />



    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="bg-white rounded-xl shadow-lg p-6">

            <h2 class="text-xl font-bold text-gray-800 text-center mb-6">
                Acceso al sistema
            </h2>

            <!-- Correo -->
            <div>
                 <!-- <x-input-label for="email" :value="'Correo'" /> titulo de imput-->

                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                     placeholder="Correo electrónico"
                    required
                    autofocus
                    autocomplete="username" />

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2" />
            </div>

<!-- Contraseña -->
<div class="mt-4">

    <div class="relative">

        <input
            id="password"
            type="password"
            name="password"
            placeholder="Contraseña"
            required
            autocomplete="current-password"
            class="block w-full rounded-md border-gray-300 bg-white text-gray-900 text-sm px-3 py-2 pr-10 shadow-sm focus:border-blue-600 focus:ring-blue-600">

        <button
            type="button"
            onclick="togglePassword()"
            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-blue-600">

            <i id="eyeIcon" class="bi bi-eye-slash"></i>

        </button>

    </div>

    <x-input-error
        :messages="$errors->get('password')"
        class="mt-2" />

</div>

            <!-- Botón -->
            <div class="mt-8">
                <x-primary-button class="w-full justify-center">
                    Ingresar
                </x-primary-button>
            </div>

        </div>

    </form>

    </div>

<script>
function togglePassword() {
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.classList.remove('bi-eye-slash');
        eyeIcon.classList.add('bi-eye');
    } else {
        password.type = 'password';
        eyeIcon.classList.remove('bi-eye');
        eyeIcon.classList.add('bi-eye-slash');
    }
}
</script>

</x-guest-layout>