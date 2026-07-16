<x-app-layout>

  {{--   <!-- Header -->
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            <span class="font-semibold">
                Objetivos |
            </span>
            <span class="font-normal">
                {{ $title }}
            </span>
        </h2>
    </x-slot>--}}

    <div class="flex">

        <!-- Submenú -->
        @if(
            request()->routeIs('objetivos.index') ||
            request()->routeIs('objetivos.ods') ||
            request()->routeIs('objetivos.pnd') ||
            request()->routeIs('objetivos.oei')
        )

        <div id="submenuContainer"
            class="w-52 border-r border-gray-300">

            @include('submenus.objetivos')

        </div>

        @endif

        <!-- Contenido -->
        <div class="flex-1 px-4 pt-1 pb-4">

            {{ $slot }}

        </div>

    </div>

</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const submenu = document.getElementById('submenuContainer');
    const boton = document.getElementById('toggleSubmenu');
    const menu = document.getElementById('menuObjetivos');

    if (!submenu || !boton || !menu) return;

    // Mostrar u ocultar automáticamente en pantallas pequeñas
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

    // Contraer / expandir el submenú
    boton.addEventListener('click', function () {

        if (submenu.classList.contains('w-52')) {

            submenu.classList.remove('w-52');
            submenu.classList.add('w-8');

            menu.classList.add('hidden');

            boton.innerHTML =
                '<i class="bi bi-chevron-double-right"></i>';

        } else {

            submenu.classList.remove('w-8');
            submenu.classList.add('w-52');

            menu.classList.remove('hidden');

            boton.innerHTML =
                '<i class="bi bi-chevron-double-left"></i>';

        }

    });

});
</script>