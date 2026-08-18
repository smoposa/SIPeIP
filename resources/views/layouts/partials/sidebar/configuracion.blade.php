<!-- ================= CONFIGURACIÓN ================= -->

@if(puedeVer('usuarios') || puedeVer('roles') || puedeVer('entidades'))

    <details class="mt-2"
        {{ request()->routeIs('roles.*')
        || request()->routeIs('usuarios.*')
        || request()->routeIs('entidades.*')
        ? 'open' : '' }}>

        <summary class="{{ request()->routeIs('roles.*')
            || request()->routeIs('usuarios.*')
            || request()->routeIs('entidades.*')
            ? 'sidebar-active'
            : 'sidebar-group' }}">

            <div class="flex items-center gap-3">

                <i class="bi bi-gear"></i>

                <span>Configuración</span>

            </div>

            <i class="bi bi-chevron-down text-sm"></i>

        </summary>

        <div class="ml-4 mt-1 space-y-0.5">

            <!-- Roles -->
            @if(puedeVer('roles'))

                <a href="{{ route('roles.index') }}"
                   class="{{ request()->routeIs('roles.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    Roles

                </a>

            @endif


            <!-- Entidades -->
            @if(puedeVer('entidades'))

                <a href="{{ route('entidades.index') }}"
                   class="{{ request()->routeIs('entidades.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    Entidades

                </a>

            @endif


            <!-- Usuarios -->
            @if(puedeVer('usuarios'))

                <a href="{{ route('usuarios.listar') }}"
                   class="{{ request()->routeIs('usuarios.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    Usuarios

                </a>

            @endif

        </div>

    </details>

@endif