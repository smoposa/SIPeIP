{{-- ================= ESTADO ================= --}}
<div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">

    <h3 class="text-lg font-semibold text-gray-800 mb-5">
        Estado del programa
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>

            <label for="estado"
                class="block text-sm font-medium text-gray-700 mb-1">

                Estado
                <span class="text-red-500">*</span>

            </label>

            <select
                id="estado"
                name="estado"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <option value="Activo"
                    {{ old('estado', 'Activo') == 'Activo' ? 'selected' : '' }}>

                    Activo

                </option>

                <option value="Inactivo"
                    {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>

                    Inactivo

                </option>

            </select>

            @error('estado')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

    </div>

</div>