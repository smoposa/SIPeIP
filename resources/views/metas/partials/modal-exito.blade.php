{{-- Modal: paso 3 completado --}}
@if(session('meta_registrada'))

    <div id="modalMeta"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4"
         role="dialog"
         aria-modal="true"
         aria-labelledby="tituloModalMeta">

        <div class="w-full max-w-[420px] rounded-xl bg-white p-6 shadow-xl">

            <div class="text-center">

                <i class="bi bi-check-circle-fill text-5xl text-green-600"></i>

                <h2 id="tituloModalMeta"
                    class="mt-3 text-xl font-semibold text-gray-800">

                    Meta registrada correctamente

                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    La meta institucional se registró exitosamente.
                </p>

            </div>

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a href="{{ route('metas.listar') }}"
                   class="inline-flex h-10 items-center justify-center rounded-md
                          bg-gray-200 px-4 text-sm font-medium text-gray-700
                          transition hover:bg-gray-300">

                    Ver listado

                </a>

                <a href="{{ route('indicadores.create') }}"
                   class="inline-flex h-10 items-center justify-center rounded-md
                          bg-[#18874E] px-4 text-sm font-medium text-white
                          transition hover:bg-green-700">

                    Continuar con Indicadores

                </a>

            </div>

        </div>

    </div>

@endif