<div class="h-full bg-[#ffffff]">

    <!-- Botón ocultar -->
    <div class="flex justify-end px-2 py-2 border-b">

        <button id="toggleSubmenu" class="text-gray-600 hover:text-[#024687]">
            <i class="bi bi-chevron-double-left"></i>
        </button>

    </div>

    <!-- Opciones -->
    <nav id="menuPlan">

        <a href="{{ route('planes.index') }}"
        class="{{ request()->routeIs('planes.index') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Página de inicio
        </a>

        <a href="{{ route('planes.listar') }}"
        class="{{ request()->routeIs('planes.listar') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Consultar planes
        </a>

        <a href="{{ route('planes.create') }}"
        class="{{ request()->routeIs('planes.create') ? 'sidebar-link-active' : 'sidebar-link' }}">
            Crear plan
        </a>

    </nav>

</div>