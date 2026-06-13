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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">

        <div class="min-h-screen flex items-center justify-center">

            <div class="w-full min-h-screen flex">

                <!-- Panel izquierdo -->
                <div class="w-3/5 bg-[#08203A] text-white flex flex-col justify-center items-center px-20 relative">

                    <h1 class="text-7xl font-bold mb-10">
                        SIPeIP
                    </h1>

                    <p class="text-center text-3xl font-semibold leading-relaxed">
                        Sistema Integral de Planificación e Inversión Pública
                    </p>

                    <div class="absolute bottom-8 left-0 right-0 text-center text-base text-gray-300">
                        © 2026 Secretaría Nacional de Planificación
                        <br>
                        <span class="text-gray-400">Versión 1.0</span>
                    </div>
                </div>
                

                <!-- Panel derecho -->
                <div class="w-2/5 bg-gray-100 flex items-center justify-center p-16">

                    <div class="w-full max-w-md">
                        {{ $slot }}
                    </div>

                </div>

            </div>

        </div>

    </body>
</html>
