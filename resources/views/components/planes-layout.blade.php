<x-app-layout>
    
<!-- Header -->
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            <span class="font-semibold">
                Roles |
            </span>
            <span class="font-normal">
                {{ $title }}
            </span>
        </h2>
    </x-slot>

    <div class="flex">

        <!-- Submenú -->
        <div id="submenuContainer"
             class="w-52 border-r border-gray-300">

            @include('submenus.planes')

        </div>

        <!-- Contenido -->
        <div class="flex-1 px-4 pt-1 pb-4">
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