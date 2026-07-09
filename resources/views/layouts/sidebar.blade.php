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
            <span class="text-red-600">Inicio</span>

        </a>

        <!-- ================= CONFIGURACIÓN ================= -->
        @if(puedeVer('usuarios') || puedeVer('roles') || puedeVer('entidades'))
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

                @if(puedeVer('roles'))
                    <a href="{{ route('roles.listar') }}"
                    class="{{ request()->routeIs('roles.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                        Roles
                    </a>
                @endif

                @if(puedeVer('usuarios'))
                    <a href="{{ route('usuarios.index') }}"
                    class="{{ request()->routeIs('usuarios.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                        Usuarios
                    </a>
                @endif

                @if(puedeVer('entidades'))
                    <a href="{{ route('entidades.index') }}"
                    class="{{ request()->routeIs('entidades.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                        Entidades
                    </a>
                @endif

                    <!--
                    <a href="#"
                    class="sidebar-submenu">
                        <span class="text-red-500">
                            Unidades Organizacionales
                        </span>
                    </a> -->

                </div>

            </details>
        @endif

        <!-- ================= PLANIFICACIÓN ================= -->
        @if(puedeVer('planes') || puedeVer('objetivos') || puedeVer('metas') || puedeVer('indicadores'))
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

                    @if(puedeVer('planes'))    
                        <a href="{{ route('planes.index') }}"
                        class="{{ request()->routeIs('planes.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                            Planes
                        </a>
                        @endif

                    @if(puedeVer('objetivos'))
                        <a href="{{ route('objetivos.index') }}"
                        class="{{ request()->routeIs('objetivos.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                            Objetivos
                        </a>
                        @endif

                    @if(puedeVer('metas'))
                        <a href="#"
                        class="{{ request()->routeIs('metas.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                            Metas
                        </a>
                        @endif

                    @if(puedeVer('indicadores'))
                        <!-- <a href="#"
                        class="{{ request()->routeIs('indicadores.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                            Indicadores
                        </a> -->
                    @endif


                    
                    <a href="#"
                    class="sidebar-submenu">
                        <span class="text-red-500">
                            Indicadores
                        </span>
                    </a>

                </div>

            </details>
        @endif

        <!-- ================= INVERSIÓN ================= -->
        @if(puedeVer('proyectos') || puedeVer('presupuesto'))
            <details class="mt-2">

                <summary class="sidebar-group">

                    <div class="flex items-center gap-3">

                        <i class="bi bi-cash-stack"></i>

                        <span class="text-red-600">Inversión</span>

                    </div>

                    <i class="bi bi-chevron-down text-sm"></i>

                </summary>

                <div class="ml-4 mt-1 space-y-0.5">

                @if(puedeVer('proyectos'))
                    <a href="#"
                    class="sidebar-submenu">
                        Proyectos
                    </a>
                @endif

                @if(puedeVer('proyectos'))
                    <a href="#"
                    class="sidebar-submenu">
                        POA
                    </a>
                @endif
                
                @if(puedeVer('presupuesto'))
                    <a href="#"
                    class="sidebar-submenu">
                        Presupuesto
                    </a>
                @endif

                </div>

            </details>
        @endif     

        <!-- ================= SEGUIMIENTO ================= -->
        @if(puedeVer('seguimiento') || puedeVer('evaluacion'))
            <details class="mt-2">

                <summary class="sidebar-group">

                    <div class="flex items-center gap-3">

                        <i class="bi bi-clipboard-check"></i>

                        <span class="text-red-600">Seguimiento</span>

                    </div>

                    <i class="bi bi-chevron-down text-sm"></i>

                </summary>

                <div class="ml-4 mt-1 space-y-0.5">

                    @if(puedeVer('seguimiento'))    
                        <a href="#"
                        class="sidebar-submenu">
                            Seguimiento
                        </a>
                    @endif  

                    @if(puedeVer('evaluacion'))
                        <a href="#"
                        class="sidebar-submenu">
                            Evaluación
                        </a>
                    @endif  

                </div>

            </details>
        @endif  

        <!-- ================= ADMINISTRACIÓN ================= -->
        @if(puedeVer('reportes') || puedeVer('auditoria'))
            <details class="mt-2">

                <summary class="sidebar-group">

                    <div class="flex items-center gap-3">

                        <i class="bi bi-shield-check"></i>

                        <span class="text-red-600">Administración</span>

                    </div>

                    <i class="bi bi-chevron-down text-sm"></i>

                </summary>

                <div class="ml-4 mt-1 space-y-0.5">

                    @if(puedeVer('reportes'))    
                        <a href="#"
                        class="sidebar-submenu">
                            Reportes
                        </a>
                    @endif

                    @if(puedeVer('auditoria'))
                        <a href="#"
                        class="sidebar-submenu">
                            Auditoría
                        </a>
                    @endif

                </div>

            </details>
        @endif  

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