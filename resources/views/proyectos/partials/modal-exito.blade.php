{{-- ================= MODAL REGISTRO COMPLETADO ================= --}}
@if(session('proyecto_registrado'))

    <div id="modalProyecto"
         class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-xl w-[460px] p-6">

            <div class="text-center">

                <i class="bi bi-check-circle-fill text-5xl text-green-600"></i>

                <h2 class="mt-3 text-xl font-semibold text-gray-800">

                    Proyecto registrado correctamente

                </h2>

                <p class="mt-2 text-sm text-gray-500">

                    El proyecto de inversión fue registrado exitosamente.
                    Con este paso se completa el proceso de planificación de
                    programas y proyectos institucionales.

                </p>

            </div>

            <div class="mt-6 flex flex-col gap-3">

                <a href="{{ route('proyectos.create') }}"
                   class="w-full text-center px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white">

                    Registrar otro Proyecto

                </a>

                <a href="{{ route('proyectos.listar') }}"
                   class="w-full text-center px-4 py-2 rounded-md bg-[#18874E] hover:bg-green-700 text-white">

                    Ver Proyectos registrados

                </a>

                <a href="{{ route('programas.listar') }}"
                   class="w-full text-center px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700">

                    Ver Programas registrados

                </a>

            </div>

        </div>

    </div>

@endif