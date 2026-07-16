<x-planes-layout title="Crear Plan Institucional">

    @if(session('success'))
        <div id="alertSuccess"
             class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const alerta = document.getElementById('alertSuccess');
                if (alerta) {
                    alerta.remove();
                }
            }, 3000);
        </script>
    @endif


    @if(session('plan_registrado'))

        <div id="modalPlan"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

            <div class="bg-white rounded-xl shadow-xl w-[420px] p-6">

                <div class="text-center">

                    <i class="bi bi-check-circle-fill text-5xl text-green-600"></i>

                    <h2 class="mt-3 text-xl font-semibold text-gray-800">
                        Plan registrado correctamente
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        El plan institucional se registró exitosamente.
                    </p>

                </div>

                <div class="mt-6 flex justify-end gap-3">

                    <a href="{{ route('planes.listar') }}"
                    class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700">

                        Volver al listado

                    </a>

                    <a href="{{ route('objetivos.create') }}"
                    class="px-4 py-2 rounded-md bg-[#18874E] hover:bg-green-700 text-white">

                        Continuar con Objetivos

                    </a>

                </div>

            </div>

        </div>

    @endif

<!-- Marco general del contenido -->
<div class="bg-white p-6 shadow-sm">

    <!-- Encabezado -->
    <div class="mb-1">

        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            Registrar un nuevo plan institucional
        </h2>

        <a href="{{ route('planes.listar') }}"
           class="inline-flex items-center mt-0.5 text-sm font-medium text-blue-600 hover:text-blue-800">

            <i class="bi bi-arrow-left-short text-lg mr-1"></i>

            Regresar

        </a>

    </div>

    <!-- Barra de progreso -->
    <div class="border-t border-b border-gray-200 py-3 mb-2">

        <div class="grid grid-cols-12 items-center gap-6">

            <!-- Información -->
            <div class="col-span-2 text-center">

                <div class="text-sm font-semibold text-gray-500">
                    Proceso del registro
                </div>

                <div class="text-xs text-gray-500 mt-0.5">
                    Paso <strong>1</strong> de <strong>4</strong>
                </div>

            </div>

            <!-- Barra -->
            <div class="col-span-10">

                <div class="flex items-center">

                    <!-- Paso 1 -->
                    <div class="flex flex-col items-center">

                        <div class="w-6 h-6 rounded-full bg-[#18874E] text-white text-xs font-semibold flex items-center justify-center">
                            1
                        </div>

                        <span class="mt-0.5 text-xs font-medium text-[#18874E]">
                            Plan
                        </span>

                    </div>

                    <div class="flex-1 h-px bg-gray-300 mx-2"></div>

                    <!-- Paso 2 -->
                    <div class="flex flex-col items-center">

                        <div class="w-6 h-6 rounded-full bg-gray-300 text-white text-xs font-semibold flex items-center justify-center">
                            2
                        </div>

                        <span class="mt-0.5 text-xs text-gray-500">
                            Objetivos
                        </span>

                    </div>

                    <div class="flex-1 h-px bg-gray-300 mx-2"></div>

                    <!-- Paso 3 -->
                    <div class="flex flex-col items-center">

                        <div class="w-6 h-6 rounded-full bg-gray-300 text-white text-xs font-semibold flex items-center justify-center">
                            3
                        </div>

                        <span class="mt-0.5 text-xs text-gray-500">
                            Metas
                        </span>

                    </div>

                    <div class="flex-1 h-px bg-gray-300 mx-2"></div>

                    <!-- Paso 4 -->
                    <div class="flex flex-col items-center">

                        <div class="w-6 h-6 rounded-full bg-gray-300 text-white text-xs font-semibold flex items-center justify-center">
                            4
                        </div>

                        <span class="mt-0.5 text-xs text-gray-500">
                            Indicadores
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Marco general del contenido -->
    <div class="bg-white p-6 shadow-sm">

    <!-- Mensajes de validación -->
    @if ($errors->any())

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
            <ul class="list-disc list-inside text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <!-- Scroll del contenido  -->
    <div class="overflow-y-auto" style="height: calc(100vh - 280px);">

        <!-- Formulario -->
        <form action="{{ route('planes.store') }}" method="POST">
            @csrf

            @include('planes.partials.form')

        </form>

    </div>

</x-planes-layout>