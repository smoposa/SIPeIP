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

                <span>Planificación Nacional</span>

            </div>

            <i class="bi bi-chevron-down text-sm"></i>

        </summary>

        <div class="ml-4 mt-1 space-y-0.5">

            <!-- Planes -->
            @if(puedeVer('planes'))

                <a href="{{ route('planes.listar') }}"
                   class="{{ request()->routeIs('planes.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    Planes

                </a>

            @endif


            <!-- Objetivos -->
            @if(puedeVer('objetivos'))

                <a href="{{ route('objetivos.listar') }}"
                   class="{{ request()->routeIs('objetivos.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    Objetivos

                </a>

            @endif


            <!-- Metas -->
            @if(puedeVer('metas'))

                <a href="{{ route('metas.listar') }}"
                   class="{{ request()->routeIs('metas.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    Metas

                </a>

            @endif


            <!-- Indicadores -->
            @if(puedeVer('indicadores'))

                <a href="{{ route('indicadores.listar') }}"
                   class="{{ request()->routeIs('indicadores.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    Indicadores

                </a>

            @endif

        </div>

    </details>

@endif