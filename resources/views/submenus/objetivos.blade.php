<div class="h-full bg-[#ffffff]">

    <!-- Botón ocultar -->
    <div class="flex justify-end px-2 py-2 border-b">

        <button id="toggleSubmenu" class="text-gray-600 hover:text-[#024687]">
            <i class="bi bi-chevron-double-left"></i>
        </button>

    </div>

    <!-- Opciones -->
<nav id="menuObjetivos">

    <a href="{{ route('objetivos.index') }}"
       class="{{ request()->routeIs('objetivos.index') ? 'sidebar-link-active' : 'sidebar-link' }}">
        Página de inicio
    </a>

    <a href="{{ route('objetivos.ods') }}"
       class="{{ request()->routeIs('objetivos.ods') ? 'sidebar-link-active' : 'sidebar-link' }}">
        Objetivos de Desarrollo Sostenible (ODS)
    </a>

    <a href="{{ route('objetivos.pnd') }}"
       class="{{ request()->routeIs('objetivos.pnd') ? 'sidebar-link-active' : 'sidebar-link' }}">
        Plan Nacional de Desarrollo (PND)
    </a>

    <a href="{{ route('objetivos.oei') }}"
       class="{{ request()->routeIs('objetivos.oei') ? 'sidebar-link-active' : 'sidebar-link' }}">
        Objetivos Estratégicos Institucionales (OEI)
    </a>

</nav>

</div>