<div class="bg-white rounded-lg border border-gray-200 shadow-sm">

    <!-- Encabezado -->

    <div class="px-8 py-6 border-b border-gray-200">

        <h3 class="text-xl font-semibold text-gray-800">

            Datos Generales del Plan

        </h3>

        <p class="mt-1 text-sm text-gray-500">

            Complete la información correspondiente al plan institucional.

        </p>

    </div>

    <!-- Contenido -->

    <div class="p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Código -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Código del Plan

                </label>

                <input
                    type="text"
                    name="codigo"
                    value="{{ old('codigo', $plan->codigo ?? '') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Ej. PEI-2026">

            </div>

            <!-- Nombre -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Nombre del Plan

                </label>

                <input
                    type="text"
                    name="nombre"
                    value="{{ old('nombre', $plan->nombre ?? '') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Ingrese el nombre del plan">

            </div>

            <!-- Tipo -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Tipo de Plan

                </label>

                <select
                    name="tipo"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">Seleccione...</option>

                    <option value="PEI">Plan Estratégico Institucional (PEI)</option>

                    <option value="POA">Plan Operativo Anual (POA)</option>

                    <option value="PLURIANUAL">Plan Plurianual</option>

                    <option value="ESPECIAL">Plan Especial</option>

                </select>

            </div>
                        <!-- Estado -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Estado

                </label>

                <select
                    name="estado"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <option value="Activo"
                        {{ old('estado', $plan->estado ?? 'Activo') == 'Activo' ? 'selected' : '' }}>
                        Activo
                    </option>

                    <option value="Inactivo"
                        {{ old('estado', $plan->estado ?? '') == 'Inactivo' ? 'selected' : '' }}>
                        Inactivo
                    </option>

                </select>

            </div>

            <!-- Fecha Inicio -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Fecha de Inicio

                </label>

                <input
                    type="date"
                    name="fecha_inicio"
                    value="{{ old('fecha_inicio', $plan->fecha_inicio ?? '') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

            </div>

            <!-- Fecha Fin -->

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">

                    Fecha de Finalización

                </label>

                <input
                    type="date"
                    name="fecha_fin"
                    value="{{ old('fecha_fin', $plan->fecha_fin ?? '') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

            </div>

        </div>

        <!-- Descripción -->

        <div class="mt-8">

            <label class="block text-sm font-medium text-gray-700 mb-2">

                Descripción del Plan

            </label>

            <textarea
                name="descripcion"
                rows="5"
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                placeholder="Ingrese una descripción general del plan...">{{ old('descripcion', $plan->descripcion ?? '') }}</textarea>

        </div>
                <!-- Estado -->

        <div class="mt-8">

            <div class="flex items-center justify-between max-w-md">

                <label class="text-sm font-medium text-gray-700">

                    Plan habilitado

                </label>

                <input
                    type="checkbox"
                    name="estado"
                    value="Activo"
                    {{ old('estado', $plan->estado ?? 'Activo') == 'Activo' ? 'checked' : '' }}
                    class="w-5 h-5">

            </div>

        </div>

    </div>

    <!-- Botones -->

    <div class="px-8 py-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">

        <div class="flex justify-end gap-3">

            <a href="{{ route('planes.listar') }}"
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">

                Cancelar

            </a>

            <button
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                <i class="bi bi-check-circle me-2"></i>

                Guardar Plan

            </button>

        </div>

    </div>

</div>