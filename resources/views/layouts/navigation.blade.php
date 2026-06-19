<nav x-data="{ open: false }" class="bg-[#024687] border-b border-gray-800">
    <!-- Primary Navigation Menu -->
<div class="px-4">

    <div class="flex items-center justify-between h-10">

        <!-- Izquierda -->
        <div class="text-white text-sm">
            <span id="fechaHora"></span>
        </div>

        <!-- Centro -->
        <div class="text-white text-sm">
            Bienvenido
        </div>

        <!-- Derecha -->
        <div class="hidden sm:flex sm:items-center">

            <x-dropdown align="right" width="48">

                <x-slot name="trigger">

                <button class="inline-flex items-center px-2 py-1 text-sm text-white bg-[#024687] focus:outline-none transition duration-150">

                    <div>{{ Auth::user()->name }}</div>

                    <i class="bi bi-person-circle text-xl mx-2"></i>

                    <div>
                        <svg class="fill-current h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">

                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />

                        </svg>
                    </div>

                </button>

                </x-slot>

                <x-slot name="content">

                    <x-dropdown-link :href="route('profile.edit')">
                        Mi Perfil
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">

                            Cerrar Sesión

                        </x-dropdown-link>

                    </form>

                </x-slot>

            </x-dropdown>

        </div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">

            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400">

                <svg class="h-6 w-6"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24">

                    <path :class="{'hidden': open, 'inline-flex': ! open }"
                        class="inline-flex"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />

                    <path :class="{'hidden': ! open, 'inline-flex': open }"
                        class="hidden"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />

                </svg>

            </button>

        </div>

    </div>

</div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
<script>
function actualizarFechaHora() {

    const ahora = new Date();

    const fecha = ahora.toLocaleDateString('es-EC');

    const hora = ahora.toLocaleTimeString('es-EC');

    document.getElementById('fechaHora').innerHTML =
        fecha + ' | ' + hora;
}

actualizarFechaHora();

setInterval(actualizarFechaHora, 1000);
</script>

</nav>
