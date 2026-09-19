<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fuentes -->
    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <!-- Evitar parpadeo de Alpine -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>


    <!-- CSS y JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="overflow-x-hidden font-sans antialiased">

    <div
        x-data="{
            sidebarCollapsed:
                localStorage.getItem('sipeip-sidebar-collapsed') === 'true',

            toggleSidebar() {
                this.sidebarCollapsed = !this.sidebarCollapsed;

                localStorage.setItem(
                    'sipeip-sidebar-collapsed',
                    this.sidebarCollapsed
                );
            }
        }"
        class="flex min-h-screen w-full bg-white"
    >


        <!-- =================================================
             CONTENEDOR DEL SIDEBAR
        ================================================== -->

        <div
            :class="sidebarCollapsed
                ? 'sidebar-collapsed w-[72px]'
                : 'w-72'"
            class="relative z-30 flex-shrink-0
                   transition-all duration-300 ease-in-out"
        >


            <!-- =============================================
                 SIDEBAR
            ============================================== -->

            <aside
                class="h-full w-full overflow-hidden
                       border-r border-gray-200 bg-[#f3f2f1]
                       shadow-sm"
            >

                @include('layouts.sidebar')

            </aside>


            <!-- =============================================
                 BOTÓN EXTERNO PARA CONTRAER O EXPANDIR
            ============================================== -->

            <button
                type="button"
                @click="toggleSidebar()"
                :title="sidebarCollapsed
                    ? 'Expandir menú'
                    : 'Contraer menú'"
                :aria-label="sidebarCollapsed
                    ? 'Expandir menú lateral'
                    : 'Contraer menú lateral'"
                class="absolute right-0 top-5 z-50
                       flex h-8 w-8 translate-x-1/2
                       items-center justify-center
                       rounded-full
                       border border-gray-200
                       bg-white text-[#024687]
                       shadow-md
                       transition-colors duration-200
                       hover:border-[#024687]
                       hover:bg-[#eef4f8]
                       focus:outline-none
                       focus:ring-2
                       focus:ring-[#024687]/30"
            >

                <i
                    class="bi text-sm"
                    :class="sidebarCollapsed
                        ? 'bi-chevron-right'
                        : 'bi-chevron-left'"
                ></i>

            </button>

        </div>


        <!-- =================================================
             CONTENIDO PRINCIPAL
        ================================================== -->

        <div class="min-w-0 flex-1">

            <!-- Barra superior -->
            @include('layouts.navigation')


            <!-- Encabezado de la página -->
            @isset($header)

                <header class="border-b border-gray-200 bg-white">

                    <div class="px-6 py-3">
                        {{ $header }}
                    </div>

                </header>

            @endisset


            <!-- Contenido de la página -->
            <main class="min-w-0 max-w-full overflow-x-hidden">

                {{ $slot }}

            </main>

        </div>

    </div>

    @stack('scripts')

</body>

</html>