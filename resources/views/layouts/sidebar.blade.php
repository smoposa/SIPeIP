<div class="h-screen flex flex-col bg-[#f3f2f1]">

    <!-- Logo -->
    <div class="text-center pt-2 pb-2 border-b">

        <a href="{{ route('dashboard') }}">

            <img
                src="{{ asset('images/menusidebar.png') }}"
                alt="SIPeIP"
                class="mx-auto h-12">

            <div class="text-xs text-gray-500">
                Planificación e Inversión Pública
            </div>

        </a>

    </div>

    <!-- Menú -->
    <nav class="flex-1 overflow-y-auto py-3">

        <!-- Inicio -->
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'sidebar-active' : 'sidebar-link' }}">

            <i class="bi bi-house-door"></i>
            <span>Inicio</span>

        </a>

        <!-- ================= CONFIGURACIÓN ================= -->

        <details class="mt-2"
            {{ request()->routeIs('roles.*')
            || request()->routeIs('usuarios.*')
            || request()->routeIs('entidades.*')
            || request()->routeIs('unidades.*')
            ? 'open' : '' }}>

            <summary class="{{ request()->routeIs('roles.*')
                || request()->routeIs('usuarios.*')
                || request()->routeIs('entidades.*')
                || request()->routeIs('unidades.*')
                ? 'sidebar-active'
                : 'sidebar-group' }}">

                <div class="flex items-center gap-3">

                    <i class="bi bi-gear"></i>

                    <span>Configuración</span>

                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-4 mt-1 space-y-0.5">

                <a href="{{ route('roles.listar') }}"
                   class="{{ request()->routeIs('roles.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                    Roles
                </a>

                <a href="{{ route('usuarios.index') }}"
                   class="{{ request()->routeIs('usuarios.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                    Usuarios
                </a>

                <a href="{{ route('entidades.index') }}"
                   class="{{ request()->routeIs('entidades.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                    Entidades
                </a>

                <a href="#"
                   class="sidebar-submenu">
                    Unidades Organizacionales
                </a>

            </div>

        </details>

        <!-- ================= PLANIFICACIÓN ================= -->

        <details class="mt-2"
            {{ request()->routeIs('planes.*')
            || request()->routeIs('objetivos.*')
            || request()->routeIs('metas.*')
            || request()->routeIs('indicadores.*')
            ? 'open' : '' }}>

            <summary class="{{ request()->routeIs('planes.*')
                || request()->routeIs('objetivos.*')
                || request()->routeIs('metas.*')
                || request()->routeIs('indicadores.*')
                ? 'sidebar-active'
                : 'sidebar-group' }}">

                <div class="flex items-center gap-3">

                    <i class="bi bi-diagram-3"></i>

                    <span>Planificación</span>

                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-4 mt-1 space-y-0.5">

                <a href="{{ route('planes.index') }}"
                   class="{{ request()->routeIs('planes.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                    Planes
                </a>

                <a href="{{ route('objetivos.index') }}"
                   class="{{ request()->routeIs('objetivos.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                    Objetivos
                </a>

                <a href="#"
                   class="{{ request()->routeIs('metas.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                    Metas
                </a>

                <a href="#"
                   class="{{ request()->routeIs('indicadores.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                    Indicadores
                </a>

            </div>

        </details>

        <!-- ================= INVERSIÓN ================= -->

        <details class="mt-2">

            <summary class="sidebar-group">

                <div class="flex items-center gap-3">

                    <i class="bi bi-cash-stack"></i>

                    <span>Inversión</span>

                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-4 mt-1 space-y-0.5">

                <a href="#"
                   class="sidebar-submenu">
                    Proyectos
                </a>

                <a href="#"
                   class="sidebar-submenu">
                    POA
                </a>

                <a href="#"
                   class="sidebar-submenu">
                    Presupuesto
                </a>

            </div>

        </details>

        <!-- ================= SEGUIMIENTO ================= -->

        <details class="mt-2">

            <summary class="sidebar-group">

                <div class="flex items-center gap-3">

                    <i class="bi bi-clipboard-check"></i>

                    <span>Seguimiento</span>

                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-4 mt-1 space-y-0.5">

                <a href="#"
                   class="sidebar-submenu">
                    Seguimiento
                </a>

                <a href="#"
                   class="sidebar-submenu">
                    Evaluación
                </a>

            </div>

        </details>

        <!-- ================= ADMINISTRACIÓN ================= -->

        <details class="mt-2">

            <summary class="sidebar-group">

                <div class="flex items-center gap-3">

                    <i class="bi bi-shield-check"></i>

                    <span>Administración</span>

                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-4 mt-1 space-y-0.5">

                <a href="#"
                   class="sidebar-submenu">
                    Reportes
                </a>

                <a href="#"
                   class="sidebar-submenu">
                    Auditoría
                </a>

            </div>

        </details>

    </nav>

    <!-- Footer -->
    <div class="border-t p-4 text-center">

        <div class="text-sm font-semibold text-gray-800">
            {{ Auth::user()->name ?? 'Administrador' }}
        </div>

        <div class="text-xs text-gray-500">
            Usuario del sistema
        </div>

    </div>

</div>