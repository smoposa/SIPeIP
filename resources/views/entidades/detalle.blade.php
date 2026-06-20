<x-entidades-layout title="Detalle de Entidad">

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('entidades.index') }}"
               class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Inicio
            </a>

            <a href="{{ route('entidades.listar') }}"
               class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Consultar entidades
            </a>

        </div>

    </div>

    <!-- Encabezado -->
    <div class="mb-6">

        <h2 class="text-2xl font-semibold text-gray-800">
            Detalle de Entidad
        </h2>

        <p class="mt-1 text-gray-500">
            Información completa de la entidad registrada en el Sistema Integral de Planificación e Inversión Pública (SIPeIP).
        </p>

    </div>

    <!-- Información -->
    <div class="bg-white border border-gray-200 rounded-lg p-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Código Institucional
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->codigoInstitucional }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    RUC
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->ruc }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Nombre
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->nombre }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Tipo de Entidad
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->tipoEntidad }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Nivel de Gobierno
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->nivelGobierno }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Provincia
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->provincia }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Cantón
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->canton }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Parroquia
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->parroquia }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Dirección
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->direccion }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Teléfono
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->telefono }}
                </p>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">
                    Estado
                </label>

                <p class="mt-1 text-gray-600">
                    {{ $entidad->estado }}
                </p>
            </div>

        </div>

        <!-- Botones -->
        <div class="mt-8 flex gap-3">

            <a href="{{ route('entidades.listar') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">
                Regresar
            </a>

            <a href="#"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">
                Editar entidad
            </a>

        </div>

    </div>

</x-entidades-layout>