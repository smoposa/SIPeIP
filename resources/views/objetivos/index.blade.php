<x-objetivos-layout title="Gestión de Objetivos Estratégicos">

<!-- Encabezado -->

<div class="mb-8">

    <h2 class="text-3xl font-bold text-gray-900">

        Gestión de Objetivos Estratégicos

    </h2>

    <p class="mt-2 text-gray-600">

        Administre la estructura nacional de objetivos utilizada por el
        Sistema Integral de Planificación e Inversión Pública (SIPeIP).

    </p>

</div>

<!-- Panel Informativo -->

<div class="bg-white rounded-lg border border-gray-200 shadow-sm mb-8">

    <div class="p-8">

        <div class="flex items-center justify-between">

            <div>

                <h3 class="text-2xl font-semibold text-gray-800">

                    Catálogo Nacional de Objetivos

                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed max-w-4xl">

                    El módulo de Objetivos concentra la estructura estratégica utilizada
                    por el Estado para la planificación pública. La planificación inicia
                    con los Objetivos de Desarrollo Sostenible (ODS), continúa con los
                    Objetivos del Plan Nacional de Desarrollo (PND) y culmina con los
                    Objetivos Estratégicos Institucionales (OEI), a partir de los cuales
                    se construyen las metas, indicadores, programas y proyectos.

                </p>

            </div>

            <div>

                <i class="bi bi-diagram-3-fill text-7xl text-blue-600"></i>

            </div>

        </div>

    </div>

</div>

<!-- Tarjetas -->

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- ========================== ODS ========================== -->

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">

        <div class="p-6">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-2xl font-bold text-gray-800">

                        ODS

                    </h3>

                    <p class="text-sm text-gray-500 mt-1">

                        Objetivos de Desarrollo Sostenible

                    </p>

                </div>

                <i class="bi bi-globe-americas text-5xl text-blue-600"></i>

            </div>

            <div class="mt-8">

                <div class="text-5xl font-bold text-gray-800">

                    17

                </div>

                <div class="text-sm text-gray-500">

                    Objetivos registrados

                </div>

            </div>

            <div class="mt-6">

                <div class="text-sm text-gray-600">

                    <strong>Responsable:</strong>

                    Organización de las Naciones Unidas (ONU)

                </div>

                <div class="text-sm text-gray-600 mt-2">

                    <strong>Administración:</strong>

                    Secretaría Nacional de Planificación

                </div>

            </div>

            <div class="mt-8">

                <a href="{{ route('objetivos.listar') }}"
                    class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                    Administrar ODS →

                </a>

            </div>

        </div>

    </div>
        <!-- ========================== PND ========================== -->

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">

        <div class="p-6">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-2xl font-bold text-gray-800">

                        PND

                    </h3>

                    <p class="text-sm text-gray-500 mt-1">

                        Objetivos del Plan Nacional de Desarrollo

                    </p>

                </div>

                <i class="bi bi-flag-fill text-5xl text-green-600"></i>

            </div>

            <div class="mt-8">

                <div class="text-5xl font-bold text-gray-800">

                    0

                </div>

                <div class="text-sm text-gray-500">

                    Objetivos registrados

                </div>

            </div>

            <div class="mt-6">

                <div class="text-sm text-gray-600">

                    <strong>Responsable:</strong>

                    Secretaría Nacional de Planificación

                </div>

                <div class="text-sm text-gray-600 mt-2">

                    <strong>Administración:</strong>

                    Dirección de Planificación Nacional

                </div>

            </div>

            <div class="mt-6">

                <span
                    class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">

                    <i class="bi bi-shield-check mr-2"></i>

                    Uso exclusivo del Administrador

                </span>

            </div>

            <div class="mt-8">

                <a href="#"
                    class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                    Administrar PND →

                </a>

            </div>

        </div>

    </div>





    <!-- ========================== OEI ========================== -->

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">

        <div class="p-6">

            <div class="flex justify-between items-center">

                <div>

                    <h3 class="text-2xl font-bold text-gray-800">

                        OEI

                    </h3>

                    <p class="text-sm text-gray-500 mt-1">

                        Objetivos Estratégicos Institucionales

                    </p>

                </div>

                <i class="bi bi-building-fill text-5xl text-cyan-600"></i>

            </div>

            <div class="mt-8">

                <div class="text-5xl font-bold text-gray-800">

                    0

                </div>

                <div class="text-sm text-gray-500">

                    Objetivos registrados

                </div>

            </div>

            <div class="mt-6">

                <div class="text-sm text-gray-600">

                    <strong>Responsable:</strong>

                    Cada Institución Pública

                </div>

                <div class="text-sm text-gray-600 mt-2">

                    <strong>Administración:</strong>

                    Usuario Institucional

                </div>

            </div>

            <div class="mt-6">

                <span
                    class="inline-flex items-center rounded-full bg-cyan-100 px-3 py-1 text-sm text-cyan-700">

                    <i class="bi bi-building mr-2"></i>

                    Gestionado por cada Entidad

                </span>

            </div>

            <div class="mt-8">

                <a href="#"
                    class="text-blue-600 hover:text-blue-800 hover:underline font-medium">

                    Administrar OEI →

                </a>

            </div>

        </div>

    </div>

</div>
<!-- Flujo Nacional de Planificación -->

<div class="mt-10 bg-white rounded-lg border border-gray-200 shadow-sm">

    <div class="p-8">

        <h3 class="text-2xl font-semibold text-gray-800">

            Flujo Nacional de Planificación

        </h3>

        <p class="mt-2 text-gray-600">

            La planificación estratégica del Estado ecuatoriano se desarrolla de manera
            jerárquica. Los Objetivos de Desarrollo Sostenible (ODS) constituyen el marco
            internacional; el Plan Nacional de Desarrollo (PND) adapta estos objetivos al
            contexto nacional y cada institución formula sus Objetivos Estratégicos
            Institucionales (OEI), de los cuales se derivan las metas, indicadores,
            programas y proyectos.

        </p>

        <div class="mt-10 flex flex-col items-center space-y-3">

            <!-- ONU -->

            <div class="text-center">

                <div class="text-sm text-gray-500">

                    ORGANIZACIÓN DE LAS NACIONES UNIDAS

                </div>

            </div>

            <i class="bi bi-arrow-down text-2xl text-gray-400"></i>

            <!-- ODS -->

            <div class="w-64 rounded-lg border border-blue-200 bg-blue-50 py-4 text-center">

                <i class="bi bi-globe-americas text-4xl text-blue-600"></i>

                <div class="mt-2 font-bold text-lg">

                    ODS

                </div>

                <div class="text-sm text-gray-600">

                    Objetivos de Desarrollo Sostenible

                </div>

            </div>

            <i class="bi bi-arrow-down text-2xl text-gray-400"></i>

            <!-- PND -->

            <div class="w-64 rounded-lg border border-green-200 bg-green-50 py-4 text-center">

                <i class="bi bi-flag-fill text-4xl text-green-600"></i>

                <div class="mt-2 font-bold text-lg">

                    PND

                </div>

                <div class="text-sm text-gray-600">

                    Plan Nacional de Desarrollo

                </div>

            </div>

            <i class="bi bi-arrow-down text-2xl text-gray-400"></i>

            <!-- OEI -->

            <div class="w-64 rounded-lg border border-cyan-200 bg-cyan-50 py-4 text-center">

                <i class="bi bi-building-fill text-4xl text-cyan-600"></i>

                <div class="mt-2 font-bold text-lg">

                    OEI

                </div>

                <div class="text-sm text-gray-600">

                    Objetivos Estratégicos Institucionales

                </div>

            </div>

            <i class="bi bi-arrow-down text-2xl text-gray-400"></i>

            <!-- Metas -->

            <div class="w-56 rounded-lg border border-yellow-200 bg-yellow-50 py-3 text-center">

                <i class="bi bi-bullseye text-3xl text-yellow-600"></i>

                <div class="mt-2 font-semibold">

                    Metas

                </div>

            </div>

            <i class="bi bi-arrow-down text-2xl text-gray-400"></i>

            <!-- Indicadores -->

            <div class="w-56 rounded-lg border border-purple-200 bg-purple-50 py-3 text-center">

                <i class="bi bi-graph-up-arrow text-3xl text-purple-600"></i>

                <div class="mt-2 font-semibold">

                    Indicadores

                </div>

            </div>

            <i class="bi bi-arrow-down text-2xl text-gray-400"></i>

            <!-- Programas -->

            <div class="w-56 rounded-lg border border-orange-200 bg-orange-50 py-3 text-center">

                <i class="bi bi-list-task text-3xl text-orange-600"></i>

                <div class="mt-2 font-semibold">

                    Programas

                </div>

            </div>

            <i class="bi bi-arrow-down text-2xl text-gray-400"></i>

            <!-- Proyectos -->

            <div class="w-56 rounded-lg border border-red-200 bg-red-50 py-3 text-center">

                <i class="bi bi-folder-fill text-3xl text-red-600"></i>

                <div class="mt-2 font-semibold">

                    Proyectos

                </div>

            </div>

        </div>

    </div>

</div>

</x-objetivos-layout>