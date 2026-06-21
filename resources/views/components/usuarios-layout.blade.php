<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="flex">

        <!-- Submenu -->
        <div id="submenuContainer"
             class="w-52 border-r border-gray-300">

            @include('submenus.usuarios')

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

    if(localStorage.getItem('submenuOculto') === 'true') {
        submenu.style.display = 'none';
    }

    window.toggleSubmenu = function() {

        if(submenu.style.display === 'none') {
            submenu.style.display = 'block';
            localStorage.setItem('submenuOculto', 'false');
        } else {
            submenu.style.display = 'none';
            localStorage.setItem('submenuOculto', 'true');
        }
    }

});
</script>