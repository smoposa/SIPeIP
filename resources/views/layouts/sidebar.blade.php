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
    <nav class="flex-1 overflow-y-auto px-0 py-3">

        <!-- Inicio -->
        <a href="{{ route('dashboard') }}"
        class="{{ request()->routeIs('dashboard') ? 'sidebar-active' : 'sidebar-link' }}">

            <i class="bi bi-house-door"></i>
            <span>Inicio</span>

        </a>

        <!-- Gestión Institucional -->
        <details class="mt-2"
            {{ request()->routeIs('roles.*') ? 'open' : '' }}>

            <summary class="{{ request()->routeIs('roles.*') ? 'sidebar-active' : 'sidebar-group' }}">

                <div class="flex items-center gap-3">
                    <i class="bi bi-building"></i>
                    <span>Gestión Institucional</span>
                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-8 mt-1 space-y-1">

                <a href="#" class="sidebar-link">
                    Entidades
                </a>

                <a href="#" class="sidebar-link">
                    Usuarios
                </a>

                <a href="{{ route('roles.index') }}" 
                class="{{ request()->routeIs('roles.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    Roles
                </a>

            </div>

        </details>

        <!-- Planificación -->
        <details class="mt-2">

            <summary class="sidebar-group">

                <div class="flex items-center gap-3">
                    <i class="bi bi-journal-text"></i>
                    <span>Planificación</span>
                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-8 mt-1 space-y-1">

                <a href="#" class="sidebar-link">
                    Planes
                </a>

                <a href="#" class="sidebar-link">
                    Objetivos
                </a>

                <a href="#" class="sidebar-link">
                    Metas
                </a>

                <a href="#" class="sidebar-link">
                    Indicadores
                </a>

            </div>

        </details>

        <!-- Inversión Pública -->
        <details class="mt-2">

            <summary class="sidebar-group">

                <div class="flex items-center gap-3">
                    <i class="bi bi-briefcase"></i>
                    <span>Inversión Pública</span>
                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-8 mt-1">

                <a href="#" class="sidebar-link">
                    Proyectos
                </a>

            </div>

        </details>

        <!-- Seguimiento y Control -->
        <details class="mt-2">

            <summary class="sidebar-group">

                <div class="flex items-center gap-3">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Seguimiento y Control</span>
                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-8 mt-1 space-y-1">

                <a href="#" class="sidebar-link">
                    Seguimientos
                </a>

                <a href="#" class="sidebar-link">
                    Auditoría
                </a>

                <a href="#" class="sidebar-link">
                    Versiones
                </a>

            </div>

        </details>

        <!-- Informes -->
        <details class="mt-2">

            <summary class="sidebar-group">

                <div class="flex items-center gap-3">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Informes</span>
                </div>

                <i class="bi bi-chevron-down text-sm"></i>

            </summary>

            <div class="ml-8 mt-1">

                <a href="#" class="sidebar-link">
                    Reportes
                </a>

            </div>

        </details>

    </nav>

    <!-- Footer Usuario -->
    <div class="border-t p-4 text-center">

        <div class="text-sm font-semibold text-gray-800">
            {{ Auth::user()->name ?? 'Administrador' }}
        </div>

        <div class="text-xs text-gray-500">
            Usuario del sistema
        </div>

    </div>

</div>