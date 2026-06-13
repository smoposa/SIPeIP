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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">

        <div class="min-h-screen flex items-center justify-center">

            <div class="w-full min-h-screen flex">

                <!-- Panel izquierdo -->
                <div class="w-3/5 bg-[#024687] text-white relative flex flex-col">

                    <!-- HEADER -->
                    <div class="text-center pt-6">
                        <p class="text-sm text-gray-300 uppercase tracking-wider">
                            Gobierno del Ecuador
                        </p>

                        <p class="text-base text-gray-300">
                            Secretaría Nacional de Planificación
                        </p>
                    </div>

                    <!-- BODY -->
                    <div class="flex-1 flex flex-col justify-center items-center px-20">

                        <img src="{{ asset('images/logosystem.png') }}"
                            alt="Logo SIPeIP"
                            class="h-24">

                        <h1 class="text-xl font-light text-gray-300 text-center">
                            Sistema Integral de Planificación <br>
                            e Inversión Pública
                        </h1>

                    </div>

                    <!-- FOOTER -->
                    <div class="pb-8 text-center text-base text-gray-300">
                        SIPeIP
                        <span class="text-gray-300"> | Versión 1.0</span>
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
