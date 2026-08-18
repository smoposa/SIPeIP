<!-- ================= INVERSIÓN PÚBLICA ================= -->

@if(puedeVer('programas') || puedeVer('proyectos'))

    <details class="mt-2"
        {{ request()->routeIs('programas.*')
        || request()->routeIs('proyectos.*')
        ? 'open' : '' }}>

        <summary class="{{ request()->routeIs('programas.*')
            || request()->routeIs('proyectos.*')
            ? 'sidebar-active'
            : 'sidebar-group' }}">

            <div class="flex items-center gap-3">

                <i class="bi bi-cash-stack"></i>

                <span>Inversión Pública</span>

            </div>

            <i class="bi bi-chevron-down text-sm"></i>

        </summary>

        <div class="ml-4 mt-1 space-y-0.5">

            <!-- Programas -->
            @if(puedeVer('programas'))

                <a href="{{ route('programas.listar') }}"
                   class="{{ request()->routeIs('programas.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    Programas

                </a>

            @endif


            <!-- Proyectos -->
            @if(puedeVer('proyectos'))

                <a href="{{ route('proyectos.listar') }}"
                   class="{{ request()->routeIs('proyectos.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    Proyectos

                </a>

            @endif

        </div>

    </details>

@endif