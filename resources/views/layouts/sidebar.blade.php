<div class="flex h-screen flex-col bg-[#f3f2f1]">

    <!-- =====================================================
         LOGOTIPO
    ====================================================== -->
    <div class="h-[72px] flex-shrink-0 border-b border-gray-200">

        <!-- Logo completo -->
        <a
            x-show="!sidebarCollapsed"
            x-cloak
            href="{{ route('dashboard') }}"
            class="flex h-full flex-col items-center justify-center px-8"
            title="SIPeIP - Ir al inicio"
        >

            <img
                src="{{ asset('images/menusidebar.png') }}"
                alt="Sistema Integral de Planificación e Inversión Pública"
                class="h-11 w-auto object-contain"
            >

            <div class="mt-0.5 whitespace-nowrap text-xs text-gray-500">
                Planificación e Inversión Pública
            </div>

        </a>


        <!-- Logo compacto -->
        <a
            x-show="sidebarCollapsed"
            x-cloak
            href="{{ route('dashboard') }}"
            class="flex h-full items-center justify-center"
            title="SIPeIP - Ir al inicio"
        >

            <img
                src="{{ asset('images/logo-sipeip-compacto.png') }}"
                alt="SIPeIP"
                class="h-9 w-9 object-contain"
            >

        </a>

    </div>


    <!-- =====================================================
         MENÚ PRINCIPAL
    ====================================================== -->
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-3">

        <!-- Inicio -->
        <a
            href="{{ route('dashboard') }}"
            title="Inicio"
            class="{{ request()->routeIs('dashboard')
                ? 'sidebar-link-active'
                : 'sidebar-link' }}"
            :class="sidebarCollapsed
                ? '!justify-center !gap-0 !px-0'
                : ''"
        >

            <i class="bi bi-house-door flex-shrink-0"></i>

            <span
                x-show="!sidebarCollapsed"
                x-cloak
                class="whitespace-nowrap"
            >
                Inicio
            </span>

        </a>


        <!-- Secciones del sistema -->
        @include('layouts.partials.sidebar.configuracion')

        @include('layouts.partials.sidebar.catalogos')

        @include('layouts.partials.sidebar.planificacion')

        @include('layouts.partials.sidebar.inversion')

        @include('layouts.partials.sidebar.seguimiento')

        @include('layouts.partials.sidebar.reportes')

        @include('layouts.partials.sidebar.auditoria')

    </nav>


    <!-- =====================================================
         USUARIO AUTENTICADO
    ====================================================== -->
    <div
        class="flex-shrink-0 border-t border-gray-200"
        :class="sidebarCollapsed ? 'p-2' : 'p-4'"
    >

        <!-- Información completa del usuario -->
        <div
            x-show="!sidebarCollapsed"
            x-cloak
            class="text-center"
        >

            <div class="truncate text-sm font-semibold text-gray-800">
                {{ Auth::user()->name ?? 'Usuario' }}
            </div>

            <div class="truncate text-xs text-gray-500">
                {{ Auth::user()->rol?->nombre ?? 'Sin rol asignado' }}
            </div>

        </div>


        <!-- Usuario en modo compacto -->
        <div
            x-show="sidebarCollapsed"
            x-cloak
            class="flex justify-center"
            title="{{ Auth::user()->name ?? 'Usuario' }} — {{ Auth::user()->rol?->nombre ?? 'Sin rol asignado' }}"
        >

            <div
                class="flex h-9 w-9 items-center justify-center
                       rounded-full bg-white text-[#024687]
                       shadow-sm ring-1 ring-gray-200"
            >

                <i class="bi bi-person text-lg"></i>

            </div>

        </div>

    </div>

</div>