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

            @include('submenus.objetivos')

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

    const boton = document.createElement('button');

    boton.innerHTML = '&laquo;';

    boton.className =
        'absolute -left-3 top-4 bg-white border border-gray-300 rounded-full w-6 h-6 text-gray-600 hover:bg-gray-100';

    submenu.style.position = 'relative';

    submenu.appendChild(boton);

    let abierto = true;

    boton.addEventListener('click', function () {

        if (abierto) {

            submenu.style.width = '0px';

            submenu.style.overflow = 'hidden';

            boton.innerHTML = '&raquo;';

        } else {

            submenu.style.width = '208px';

            submenu.style.overflow = 'visible';

            boton.innerHTML = '&laquo;';

        }

        abierto = !abierto;

    });

});

</script>