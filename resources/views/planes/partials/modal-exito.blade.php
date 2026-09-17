{{-- Modal: paso 1 completado --}}
@if(session('plan_registrado'))

    <div id="modalPlan"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4"
         role="dialog"
         aria-modal="true"
         aria-labelledby="tituloModalPlan">

        <div class="w-full max-w-[440px] rounded-xl bg-white p-6 shadow-xl">

            <div class="text-center">

                <i class="bi bi-check-circle-fill text-5xl text-green-600"></i>

                <h2 id="tituloModalPlan"
                    class="mt-3 text-xl font-semibold text-gray-800">

                    Plan registrado correctamente

                </h2>

                <p class="mt-2 text-sm leading-relaxed text-gray-500">

                    El plan

                    <strong class="font-semibold text-gray-700">
                        {{ session('plan_codigo') }}
                    </strong>

                    fue creado en estado

                    <strong class="font-semibold text-gray-700">
                        {{ session('plan_estado_proceso') }}
                    </strong>

                    y con la versión

                    <strong class="font-semibold text-gray-700">
                        v{{ session('plan_version') }}
                    </strong>.

                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Puede continuar con el registro de los objetivos estratégicos institucionales.
                </p>

            </div>

            <div class="mt-6 flex flex-wrap justify-end gap-3">

                <a href="{{ route('planes.listar') }}"
                   class="inline-flex h-10 items-center justify-center rounded-md
                          bg-gray-200 px-4 text-sm font-medium text-gray-700
                          transition hover:bg-gray-300
                          focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">

                    Volver al listado

                </a>

                <a href="{{ route('objetivos.create', [
                            'plan_id' => session('plan_id')
                        ]) }}"
                   class="inline-flex h-10 items-center justify-center rounded-md
                          bg-[#18874E] px-4 text-sm font-medium text-white
                          transition hover:bg-green-700
                          focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">

                    Continuar con Objetivos

                </a>

            </div>

        </div>

    </div>

@endif