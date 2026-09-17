{{-- Modal: paso 2 completado --}}
@if(session('objetivo_registrado'))

    <div id="modalObjetivo"
         class="fixed inset-0 z-50 flex items-center justify-center
                bg-black/50 px-4"
         role="dialog"
         aria-modal="true"
         aria-labelledby="tituloModalObjetivo">

        <div class="w-full max-w-[420px] rounded-xl bg-white p-6 shadow-xl">

            <div class="text-center">

                <i class="bi bi-check-circle-fill text-5xl text-green-600"></i>

                <h2 id="tituloModalObjetivo"
                    class="mt-3 text-xl font-semibold text-gray-800">

                    Objetivo registrado correctamente

                </h2>

                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    El objetivo estratégico institucional se registró exitosamente.
                </p>

                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    Puede continuar con el registro de las metas institucionales.
                </p>

            </div>

            <div class="mt-6 flex flex-col-reverse gap-3
                        sm:flex-row sm:justify-end">

                <a href="{{ route('objetivos.listar') }}"
                   class="inline-flex h-10 items-center justify-center rounded-md
                          bg-gray-200 px-4 text-sm font-medium text-gray-700
                          transition hover:bg-gray-300
                          focus:outline-none focus:ring-2 focus:ring-gray-400
                          focus:ring-offset-2">

                    Volver al listado

                </a>

                <a href="{{ route('metas.create', [
                            'objetivo_id' => session('objetivo_id')
                        ]) }}"
                   class="inline-flex h-10 items-center justify-center rounded-md
                          bg-[#18874E] px-4 text-sm font-medium text-white
                          transition hover:bg-green-700
                          focus:outline-none focus:ring-2 focus:ring-green-600
                          focus:ring-offset-2">

                    Continuar con Metas

                </a>

            </div>

        </div>

    </div>

@endif