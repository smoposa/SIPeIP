{{-- ================= CONTEXTO DE PLANIFICACIÓN ================= --}}
@if($planSeleccionado && $objetivoSeleccionado && $metaSeleccionada)

<div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">

    <div class="px-5 py-3 border-b border-gray-200">

        <h3 class="text-base font-semibold text-[#024687]">

            Contexto de Planificación

        </h3>

        <p class="text-sm text-gray-500 mt-1">

            La información corresponde al plan, objetivo y meta seleccionados en el asistente.

        </p>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-5">

        <!-- Plan -->
        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-1">

                Plan Estratégico

            </label>

            <div class="bg-gray-50 border rounded-md px-3 py-2">

                <div class="text-sm font-medium text-[#024687]">

                    {{ $planSeleccionado->codigo }}

                </div>

                <div class="text-sm text-gray-600">

                    {{ $planSeleccionado->nombre }}

                </div>

            </div>

        </div>

        <!-- Objetivo -->
        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-1">

                Objetivo Estratégico

            </label>

            <div class="bg-gray-50 border rounded-md px-3 py-2">

                <div class="text-sm font-medium text-[#024687]">

                    {{ $objetivoSeleccionado->codigo }}

                </div>

                <div class="text-sm text-gray-600">

                    {{ $objetivoSeleccionado->nombre }}

                </div>

            </div>

        </div>

        <!-- Meta -->
        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-1">

                Meta Institucional

            </label>

            <div class="bg-gray-50 border rounded-md px-3 py-2">

                <div class="text-sm font-medium text-[#024687]">

                    {{ $metaSeleccionada->codigo }}

                </div>

                <div class="text-sm text-gray-600">

                    {{ $metaSeleccionada->nombre }}

                </div>

            </div>

        </div>

    </div>

</div>

@endif