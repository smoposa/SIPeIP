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

            <div class="flex items-center space-x-8">

                <!-- Borrador -->
                <label class="inline-flex items-center">

                    <input
                        type="radio"
                        name="estado"
                        value="Borrador"
                        {{ old('estado', 'Borrador') == 'Borrador' ? 'checked' : '' }}
                        class="text-blue-600 border-gray-300 focus:ring-blue-500">

                    <span class="ml-2 text-sm text-gray-700">
                        Borrador
                    </span>

                </label>

                <!-- Activo -->
                <label class="inline-flex items-center">

                    <input
                        type="radio"
                        name="estado"
                        value="Activo"
                        {{ old('estado') == 'Activo' ? 'checked' : '' }}
                        class="text-blue-600 border-gray-300 focus:ring-blue-500">

                    <span class="ml-2 text-sm text-gray-700">
                        Activo
                    </span>

                </label>

            </div>

        </div>

    </div>

</div>