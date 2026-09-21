<!-- ================= SEGUIMIENTO ================= -->

@if(puedeVer('avances') || puedeVer('presupuestos'))

    <details class="mt-2"
        {{ request()->routeIs('avances.*') || request()->routeIs('presupuestos.*') ? 'open' : '' }}>

        <summary class="{{ request()->routeIs('avances.*') || request()->routeIs('presupuestos.*') ? 'sidebar-active' : 'sidebar-group' }}">

            <div class="flex items-center gap-3">

                <i class="bi bi-clipboard-check"></i>

                <span>Seguimiento</span>

            </div>

            <i class="bi bi-chevron-down text-sm"></i>

        </summary>

        <div class="ml-4 mt-1 space-y-0.5">

            <!-- Avances -->
            @if(puedeVer('avances'))

                <a href="{{ route('avances.listar') }}"
                   class="{{ request()->routeIs('avances.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                    Avances

                </a>

            @endif


            <!-- Presupuesto -->
            @if(puedeVer('presupuestos'))

                <a href="{{ route('presupuestos.listar') }}"
                   class="{{ request()->routeIs('presupuestos.*') ? 'sidebar-submenu-active' : 'sidebar-submenu' }}">
                    Presupuestos

                </a>

            @endif

        </div>

    </details>

@endif
