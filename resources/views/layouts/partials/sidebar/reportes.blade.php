<!-- ================= REPORTES ================= -->
@if(puedeVer('reportes'))
    <a href="{{ route('reportes.index') }}"
       title="Reportes"
       class="{{ request()->routeIs('reportes.*') ? 'sidebar-link-active' : 'sidebar-link' }}"
       :class="sidebarCollapsed ? '!justify-center !gap-0 !px-0' : ''">
        <i class="bi bi-bar-chart-line flex-shrink-0"></i>
        <span x-show="!sidebarCollapsed" x-cloak class="whitespace-nowrap">Reportes</span>
    </a>
@endif
