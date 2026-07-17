<!-- Estado -->
<div class="mb-8">

    <!-- Encabezado -->
    <div class="bg-[#F3F2F1] border-b border-gray-200 px-4 py-2 mb-5">

        <h2 class="text-sm font-semibold text-gray-700">
            Estado
        </h2>

    </div>

    <!-- Contenido -->
    <div class="pl-8">

        <div class="flex items-center">

            <label class="w-52 text-sm font-semibold text-gray-700">
                Estado
            </label>

            <div class="flex flex-wrap gap-6">

                <!-- Planificado -->
                <label class="inline-flex items-center">

                    <input
                        type="radio"
                        name="estado"
                        value="Planificado"
                        {{ old('estado', $proyecto->estado ?? 'Planificado') == 'Planificado' ? 'checked' : '' }}
                        class="text-blue-600 border-gray-300 focus:ring-blue-500">

                    <span class="ml-2 text-sm text-gray-700">
                        Planificado
                    </span>

                </label>

                <!-- En ejecución -->
                <label class="inline-flex items-center">

                    <input
                        type="radio"
                        name="estado"
                        value="En ejecución"
                        {{ old('estado', $proyecto->estado ?? '') == 'En ejecución' ? 'checked' : '' }}
                        class="text-blue-600 border-gray-300 focus:ring-blue-500">

                    <span class="ml-2 text-sm text-gray-700">
                        En ejecución
                    </span>

                </label>

                <!-- Finalizado -->
                <label class="inline-flex items-center">

                    <input
                        type="radio"
                        name="estado"
                        value="Finalizado"
                        {{ old('estado', $proyecto->estado ?? '') == 'Finalizado' ? 'checked' : '' }}
                        class="text-blue-600 border-gray-300 focus:ring-blue-500">

                    <span class="ml-2 text-sm text-gray-700">
                        Finalizado
                    </span>

                </label>

                <!-- Suspendido -->
                <label class="inline-flex items-center">

                    <input
                        type="radio"
                        name="estado"
                        value="Suspendido"
                        {{ old('estado', $proyecto->estado ?? '') == 'Suspendido' ? 'checked' : '' }}
                        class="text-blue-600 border-gray-300 focus:ring-blue-500">

                    <span class="ml-2 text-sm text-gray-700">
                        Suspendido
                    </span>

                </label>

            </div>

        </div>

    </div>

</div>