<x-app-layout>

    <div class="flex">

        {{--
        @if(
            request()->routeIs('proyectos.listar') ||
            request()->routeIs('proyectos.create')
        )

        <div id="submenuContainer"
            class="w-52 border-r border-gray-300">

            @include('submenus.proyectos')

        </div>

        @endif
        --}}

        <div class="flex-1 px-4 pt-1 pb-4">
            {{ $slot }}
        </div>

    </div>

</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const submenu = document.getElementById('submenuContainer');
    const boton = document.getElementById('toggleSubmenu');
    const menu = document.getElementById('menuProyectos');

    if (!submenu || !boton || !menu) return;

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