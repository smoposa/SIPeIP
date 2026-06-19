<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>


    <div class="flex">

        <!-- Submenu -->
        <div id="submenuContainer"
             class="w-56 border-r border-gray-300">

            @include('submenus.roles')

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
    const boton = document.getElementById('toggleSubmenu');
    const menu = document.getElementById('menuRoles');

    if (!submenu || !boton || !menu) return;

    boton.addEventListener('click', function () {

        if (submenu.classList.contains('w-56')) {

            submenu.classList.remove('w-56');
            submenu.classList.add('w-8');

            menu.classList.add('hidden');

            boton.innerHTML =
                '<i class="bi bi-chevron-double-right"></i>';

        } else {

            submenu.classList.remove('w-8');
            submenu.classList.add('w-56');

            menu.classList.remove('hidden');

            boton.innerHTML =
                '<i class="bi bi-chevron-double-left"></i>';

        }

    });

});
</script>