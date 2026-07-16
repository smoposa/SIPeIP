<div class="h-full bg-[#ffffff]">

    <!-- Botón ocultar -->
    <div class="flex justify-end px-2 py-2 border-b">

        <button id="toggleSubmenu" class="text-gray-600 hover:text-[#024687]">
            <i class="bi bi-chevron-double-left"></i>
        </button>

    </div>

    
    <!-- Opciones -->
    <nav id="menuEntidades">

        <a href="{{ route('entidades.index') }}"
        class="{{ request()->routeIs('entidades.index') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Página de inicio
        </a>

        <a href="{{ route('entidades.listar') }}"
        class="{{ request()->routeIs('entidades.listar') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Entidades registradas
        </a>

        <a href="{{ route('entidades.create') }}"
        class="{{ request()->routeIs('entidades.create') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Crear entidad
        </a>

        <!-- a href="#"
        class="{{ request()->routeIs('entidades.desactivadas') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Entidades desactivadas
        </a> -->

    </nav>

</div>