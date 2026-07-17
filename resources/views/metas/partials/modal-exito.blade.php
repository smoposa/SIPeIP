{{-- ================= MODAL PASO 3 COMPLETADO ================= --}}
@if(session('meta_registrada'))

    <div id="modalMeta"
         class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-xl w-[420px] p-6">

            <div class="text-center">

                <i class="bi bi-check-circle-fill text-5xl text-green-600"></i>

                <h2 class="mt-3 text-xl font-semibold text-gray-800">
                    Meta registrada correctamente
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    La meta estratégica institucional se registró exitosamente.
                </p>

            </div>

            <div class="mt-6 flex justify-end gap-3">

                <a href="{{ route('metas.listar') }}"
                   class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700">

                    Ver listado

                </a>

                <a href="{{ route('indicadores.create') }}"
                   class="px-4 py-2 rounded-md bg-[#18874E] hover:bg-green-700 text-white">

                    Continuar con Indicadores

                </a>

            </div>

        </div>

    </div>

@endif