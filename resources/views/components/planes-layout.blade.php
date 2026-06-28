<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="flex">

        <!-- Submenú -->
        <div id="submenuContainer"
             class="w-52 border-r border-gray-300">

            @include('submenus.planes')

        </div>

        <!-- Contenido -->
        <div class="flex-1 p-6">

            {{ $slot }}

        </div>

    </div>

</x-app-layout>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const submenu = document.getElementById('submenuContainer');

    function ajustarSubmenu() {

        const ancho = window.innerWidth;

        if (ancho < 768) {

            submenu.classList.add('hidden');

        } else {

            submenu.classList.remove('hidden');

        }

    }

    ajustarSubmenu();

    window.addEventListener('resize', ajustarSubmenu);

});

</script>