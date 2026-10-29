@props(['title' => 'Objetivos estratégicos institucionales'])

<x-app-layout>

    <!-- Encabezado -->
    <x-slot name="header">

        <!-- Migas de pan -->
        @isset($breadcrumbs)

            <div class="-mx-6 -mt-3 mb-1 bg-gray-100 px-6 py-1 text-xs text-gray-500">

                {{ $breadcrumbs }}

            </div>

        @endisset


        <!-- Título -->
        <h2 class="text-xl text-gray-800 leading-tight">

            <span class="font-semibold">
                Planificación institucional |
            </span>

            <span class="font-normal">
                {{ $title }}
            </span>

        </h2>

    </x-slot>


    <div class="flex min-w-0 w-full">

        <!-- Submenú -->
        @if(
            request()->routeIs('objetivos.ods') ||
            request()->routeIs('objetivos.pnd') ||
            request()->routeIs('objetivos.oei')
        )

            <div id="submenuContainer"
                 class="w-52 shrink-0 border-r border-gray-300">

                @include('submenus.objetivos')

            </div>

        @endif


        <!-- Contenido -->
        <div class="min-w-0 max-w-full flex-1 px-4 pt-1 pb-4">

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

        function ajustarSubmenu() {
            submenu.classList.toggle('hidden', window.innerWidth < 768);
        }

        ajustarSubmenu();

        window.addEventListener('resize', ajustarSubmenu);

        boton.addEventListener('click', function () {
            const contraer = submenu.classList.contains('w-52');

            submenu.classList.toggle('w-52', !contraer);
            submenu.classList.toggle('w-8', contraer);

            menu.classList.toggle('hidden', contraer);

            boton.setAttribute('aria-expanded', String(!contraer));

            boton.innerHTML = contraer
                ? '<i class="bi bi-chevron-double-right" aria-hidden="true"></i>'
                : '<i class="bi bi-chevron-double-left" aria-hidden="true"></i>';
        });
    });
</script>