<x-app-layout>

    <div class="p-6">

        <!-- Bienvenida -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">

            <h1 class="text-2xl font-bold text-[#024687]">
                Sistema Integral de Planificación e Inversión Pública
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                SIPeIP
            </p>

            <div class="mt-5">

                <p class="text-lg text-gray-800">
                    Bienvenido,
                    <span class="font-semibold text-[#16A34A]">
                        {{ Auth::user()->nombres }}
                        {{ Auth::user()->apellidos }}
                    </span>
                </p>

                <p class="text-sm text-gray-600">
                    {{ Auth::user()->rol->nombre }}
                </p>

            </div>

            <div class="mt-5 border-t pt-4">

                <p class="text-gray-600 leading-relaxed">

                    Bienvenido al Sistema Integral de Planificación e
                    Inversión Pública.

                    Desde esta plataforma podrá administrar la planificación
                    institucional, la inversión pública y el seguimiento
                    de programas y proyectos de su institución.

                </p>

            </div>

        </div>
<br><br><br><br>
        <!-- Pie -->
        <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200">

            <div class="p-5 text-center">

                <h3 class="font-semibold text-[#024687]">
                    Sistema Integral de Planificación e Inversión Pública
                </h3>

                <p class="text-gray-500 mt-1">
                    SIPeIP v1.0
                </p>

                <p class="text-sm text-gray-500 mt-3">
                    Universidad Técnica Particular de Loja
                </p>

                <p class="text-xs text-gray-400">
                    2026
                </p>

            </div>

        </div>

    </div>

</x-app-layout>