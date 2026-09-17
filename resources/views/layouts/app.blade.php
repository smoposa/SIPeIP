    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ config('app.name', 'Laravel') }}</title>

            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

            <!-- Bootstrap Icons -->
            <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

            <!-- Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>

        <body class="overflow-x-hidden font-sans antialiased">

            <div class="flex min-h-screen w-full bg-white">

                <!-- Sidebar -->
                <aside class="w-64 flex-shrink-0 bg-white border-r border-gray-200 shadow-sm">

                    @include('layouts.sidebar')

                </aside>

                <!-- Contenido -->
                <div class="min-w-0 flex-1">

                    @include('layouts.navigation')
                    {{-- @include('layouts.navigation') --}}

                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-white border-b border-gray-200">
                            <div class="px-6 py-3">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- Page Content -->
                    <main class="min-w-0 max-w-full overflow-x-hidden">
                        {{ $slot }}
                    </main>

                </div>

            </div>

        </body>
    </html>
