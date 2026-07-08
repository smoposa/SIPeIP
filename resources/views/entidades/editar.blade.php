<x-entidades-layout title="Editar Entidad">

    @if(session('success'))
        <div id="alertSuccess"
            class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const alerta = document.getElementById('alertSuccess');
                if (alerta) {
                    alerta.remove();
                }
            }, 3000);
        </script>
    @endif

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">
        <div class="flex">
            <a href="{{ route('entidades.detalle', $entidad->id) }}"
                class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">
                <i class="bi bi-chevron-left"></i>
                Regresar
            </a>  
        </div>
    </div>

    <!-- Información -->
    <div class="bg-white p-6 shadow-sm">

        <!-- Encabezado -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">
                Actualizar información de la entidad
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Acontinuacion puede actualizar los datos de la entidad.
            </p>
        </div>

        <!-- Validaciones -->
        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                <ul class="list-disc list-inside text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Scroll del contenido  -->
        <div class="overflow-y-auto" style="height: calc(100vh - 300px);">
           
            <!-- Formulario -->
            <form method="POST" action="{{ route('entidades.update', $entidad->id) }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <!-- Código Institucional -->
                    <div class="flex items-center">
                        <label class="w-48 text-sm font-medium text-gray-700">
                            Código Institucional <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="codigoInstitucional"
                            maxlength="50"
                            required
                            value="{{ old('codigoInstitucional', $entidad->codigoInstitucional) }}"
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
                            maxlength="13"
                            required
                            value="{{ old('ruc', $entidad->ruc) }}"
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
                            maxlength="255"
                            required
                            value="{{ old('nombre', $entidad->nombre) }}"
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
                            maxlength="50"
                            value="{{ old('siglas', $entidad->siglas) }}"
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
                                    {{ old('tipoEntidad', $entidad->tipoEntidad) == 'Secretaría' ? 'selected' : '' }}>
                                    Secretaría
                                </option>

                                <option value="Ministerio"
                                    {{ old('tipoEntidad', $entidad->tipoEntidad) == 'Ministerio' ? 'selected' : '' }}>
                                    Ministerio
                                </option>

                                <option value="GAD Provincial"
                                    {{ old('tipoEntidad', $entidad->tipoEntidad) == 'GAD Provincial' ? 'selected' : '' }}>
                                    GAD Provincial
                                </option>

                                <option value="GAD Municipal"
                                    {{ old('tipoEntidad', $entidad->tipoEntidad) == 'GAD Municipal' ? 'selected' : '' }}>
                                    GAD Municipal
                                </option>

                                <option value="GAD Parroquial"
                                    {{ old('tipoEntidad', $entidad->tipoEntidad) == 'GAD Parroquial' ? 'selected' : '' }}>
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
                                    {{ old('nivelGobierno', $entidad->nivelGobierno) == 'Central' ? 'selected' : '' }}>
                                    Central
                                </option>

                                <option value="Provincial"
                                    {{ old('nivelGobierno', $entidad->nivelGobierno) == 'Provincial' ? 'selected' : '' }}>
                                    Provincial
                                </option>

                                <option value="Municipal"
                                    {{ old('nivelGobierno', $entidad->nivelGobierno) == 'Municipal' ? 'selected' : '' }}>
                                    Municipal
                                </option>

                                <option value="Parroquial"
                                    {{ old('nivelGobierno', $entidad->nivelGobierno) == 'Parroquial' ? 'selected' : '' }}>
                                    Parroquial
                                </option>

                            </select>
                    </div>

                    <!-- Provincia -->
                    <div class="flex items-center">
                        <label class="w-48 text-sm font-medium text-gray-700">
                            Provincia
                        </label>
                        <input
                            type="text"
                            name="provincia"
                            maxlength="100"
                            value="{{ old('provincia', $entidad->provincia) }}"
                            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Cantón -->
                    <div class="flex items-center">
                        <label class="w-48 text-sm font-medium text-gray-700">
                            Cantón
                        </label>
                        <input
                            type="text"
                            name="canton"
                            maxlength="100"
                            value="{{ old('canton', $entidad->canton) }}"
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
                            maxlength="100"
                            value="{{ old('parroquia', $entidad->parroquia) }}"
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
                            maxlength="20"
                            value="{{ old('telefono', $entidad->telefono) }}"
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
                            maxlength="150"
                            value="{{ old('correoInstitucional', $entidad->correoInstitucional) }}"
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
                            class="w-2/3 text-sm border border-gray-300 rounded-md px-3 py-1 focus:ring-blue-500 focus:border-blue-500">{{ old('direccion', $entidad->direccion) }}</textarea>
                    </div>

                </div>

                <!-- Botones -->
                <div class="flex mt-6">

                    <div class="w-48 flex-shrink-0"></div>

                    <div class="w-2/3 flex justify-end gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                            Actualizar

                        </button>

                        <a href="{{ route('entidades.detalle', $entidad->id) }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                            Cancelar

                        </a>

                    </div>

                </div>

            </form>

        </div>

</x-entidades-layout>
