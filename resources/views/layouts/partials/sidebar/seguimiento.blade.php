<!-- ================= SEGUIMIENTO ================= -->

@if(puedeVer('seguimiento') || puedeVer('evaluacion'))

    <details class="mt-2">

        <summary class="sidebar-group">

            <div class="flex items-center gap-3">

                <i class="bi bi-clipboard-check"></i>

                <span class="text-red-600">
                    Seguimiento
                </span>

            </div>

            <i class="bi bi-chevron-down text-sm"></i>

        </summary>

        <div class="ml-4 mt-1 space-y-0.5">

            <!-- Avances -->
            @if(puedeVer('seguimiento'))

                <a href="#"
                   class="sidebar-submenu">

                    <span class="text-red-500">
                        Avances
                    </span>

                </a>

            @endif


            <!-- Presupuesto -->
            @if(puedeVer('evaluacion'))

                <a href="#"
                   class="sidebar-submenu">

                    <span class="text-red-500">
                        Presupuesto
                    </span>

                </a>

            @endif

        </div>

    </details>

@endif