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


    <!-- Menú principal -->
    <nav class="flex-1 overflow-y-auto py-3">

        <!-- Inicio -->
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard')
                ? 'sidebar-link-active'
                : 'sidebar-link' }}">

            <i class="bi bi-house-door"></i>

            <span>Inicio</span>

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


    <!-- Usuario autenticado -->
    <div class="border-t p-4 text-center">

        <div class="text-sm font-semibold text-gray-800">
            {{ Auth::user()->name ?? 'Usuario' }}
        </div>

        <div class="text-xs text-gray-500">
            {{ Auth::user()->rol?->nombre ?? 'Sin rol asignado' }}
        </div>

    </div>

</div>