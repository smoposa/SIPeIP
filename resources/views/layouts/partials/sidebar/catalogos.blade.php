<!-- ================= CATÁLOGOS ================= -->

@if(puedeVer('ods') || puedeVer('pnd'))

    <details class="mt-2"
        {{ request()->routeIs('ods.*')
        || request()->routeIs('pnd.*')
        ? 'open' : '' }}>

        <summary class="{{ request()->routeIs('ods.*')
            || request()->routeIs('pnd.*')
            ? 'sidebar-active'
            : 'sidebar-group' }}">

            <div class="flex items-center gap-3">

                <i class="bi bi-journal-bookmark"></i>

                <span>Catálogos</span>

            </div>

            <i class="bi bi-chevron-down text-sm"></i>

        </summary>

        <div class="ml-4 mt-1 space-y-0.5">

            <!-- ODS -->
            @if(puedeVer('ods'))

                <a href="{{ route('ods.index') }}"
                   class="{{ request()->routeIs('ods.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    ODS

                </a>

            @endif


            <!-- PND -->
            @if(puedeVer('pnd'))

                <a href="{{ route('pnd.index') }}"
                   class="{{ request()->routeIs('pnd.*')
                        ? 'sidebar-submenu-active'
                        : 'sidebar-submenu' }}">

                    PND

                </a>

            @endif

        </div>

    </details>

@endif