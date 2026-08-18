<div class="space-y-4">

    <!-- Código Institucional -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Código Institucional <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="codigoInstitucional"
            value="{{ old('codigoInstitucional', $entidad->codigoInstitucional ?? '') }}"
            maxlength="50"
            required
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

    </div>


    <!-- RUC -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            RUC <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="ruc"
            value="{{ old('ruc', $entidad->ruc ?? '') }}"
            maxlength="13"
            required
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

    </div>


    <!-- Nombre -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Nombre de la Entidad <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="nombre"
            value="{{ old('nombre', $entidad->nombre ?? '') }}"
            maxlength="255"
            required
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

    </div>


    <!-- Siglas -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Siglas
        </label>

        <input
            type="text"
            name="siglas"
            value="{{ old('siglas', $entidad->siglas ?? '') }}"
            maxlength="50"
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

    </div>


    <!-- Tipo de Entidad -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Tipo de Entidad <span class="text-red-500">*</span>
        </label>

        <select
            name="tipoEntidad"
            required
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

            <option value="">Seleccione</option>

            <option value="Secretaría"
                @selected(old('tipoEntidad', $entidad->tipoEntidad ?? '') === 'Secretaría')>
                Secretaría
            </option>

            <option value="Ministerio"
                @selected(old('tipoEntidad', $entidad->tipoEntidad ?? '') === 'Ministerio')>
                Ministerio
            </option>

            <option value="GAD Provincial"
                @selected(old('tipoEntidad', $entidad->tipoEntidad ?? '') === 'GAD Provincial')>
                GAD Provincial
            </option>

            <option value="GAD Municipal"
                @selected(old('tipoEntidad', $entidad->tipoEntidad ?? '') === 'GAD Municipal')>
                GAD Municipal
            </option>

            <option value="GAD Parroquial"
                @selected(old('tipoEntidad', $entidad->tipoEntidad ?? '') === 'GAD Parroquial')>
                GAD Parroquial
            </option>

        </select>

    </div>


    <!-- Nivel de Gobierno -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Nivel de Gobierno <span class="text-red-500">*</span>
        </label>

        <select
            name="nivelGobierno"
            required
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

            <option value="">Seleccione</option>

            <option value="Central"
                @selected(old('nivelGobierno', $entidad->nivelGobierno ?? '') === 'Central')>
                Central
            </option>

            <option value="Provincial"
                @selected(old('nivelGobierno', $entidad->nivelGobierno ?? '') === 'Provincial')>
                Provincial
            </option>

            <option value="Municipal"
                @selected(old('nivelGobierno', $entidad->nivelGobierno ?? '') === 'Municipal')>
                Municipal
            </option>

            <option value="Parroquial"
                @selected(old('nivelGobierno', $entidad->nivelGobierno ?? '') === 'Parroquial')>
                Parroquial
            </option>

        </select>

    </div>


    <!-- Provincia -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Provincia <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="provincia"
            value="{{ old('provincia', $entidad->provincia ?? '') }}"
            maxlength="100"
            required
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

    </div>


    <!-- Cantón -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Cantón <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="canton"
            value="{{ old('canton', $entidad->canton ?? '') }}"
            maxlength="100"
            required
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

    </div>


    <!-- Parroquia -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Parroquia
        </label>

        <input
            type="text"
            name="parroquia"
            value="{{ old('parroquia', $entidad->parroquia ?? '') }}"
            maxlength="100"
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

    </div>


    <!-- Teléfono -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Teléfono
        </label>

        <input
            type="text"
            name="telefono"
            value="{{ old('telefono', $entidad->telefono ?? '') }}"
            maxlength="30"
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

    </div>


    <!-- Correo Institucional -->
    <div class="flex items-center">

        <label class="w-48 text-sm font-medium text-gray-700">
            Correo Institucional
        </label>

        <input
            type="email"
            name="correoInstitucional"
            value="{{ old('correoInstitucional', $entidad->correoInstitucional ?? '') }}"
            maxlength="255"
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">

    </div>


    <!-- Dirección -->
    <div class="flex items-start">

        <label class="w-48 text-sm font-medium text-gray-700 pt-2">
            Dirección
        </label>

        <textarea
            name="direccion"
            rows="3"
            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('direccion', $entidad->direccion ?? '') }}</textarea>

    </div>

</div>