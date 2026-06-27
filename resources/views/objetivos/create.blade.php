<x-objetivos-layout title="Crear Objetivo">

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
<div class="bg-white border-b border-gray-300 mb-6">

    <div class="flex">

        <a href="{{ route('objetivos.index') }}"
           class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
            Información General
        </a>

        <a href="{{ route('objetivos.create') }}"
           class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
            Crear Objetivo
        </a>

        <a href="{{ route('objetivos.listar') }}"
           class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
            Consultar Objetivos
        </a>

    </div>

</div>

<!-- Encabezado -->
<div class="mb-8">

    <h2 class="text-3xl font-bold text-gray-900">
        Registrar Objetivo de Desarrollo Sostenible (ODS)
    </h2>

    <p class="mt-2 text-gray-600">
        Registre un Objetivo de Desarrollo Sostenible que servirá como base para la planificación institucional.
    </p>

</div>

<form action="{{ route('objetivos.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

<div class="bg-white rounded-lg border border-gray-200 shadow-sm">

    <div class="p-8 space-y-8">

        <!-- Tipo -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Tipo de objetivo
            </label>

            <input
                type="text"
                value="ODS - Objetivos de Desarrollo Sostenible"
                class="w-full rounded-md bg-gray-100 border-gray-300"
                readonly>

            <input
                type="hidden"
                name="tipo"
                value="ODS">

        </div>

        <!-- Código -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Código
            </label>

            <input
                type="text"
                name="codigo"
                value="{{ $codigo }}"
                class="w-full rounded-md bg-gray-100 border-gray-300"
                readonly>

        </div>

        <!-- Nombre -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Nombre
            </label>

            <input
                type="text"
                name="nombre"
                value="{{ old('nombre') }}"
                placeholder="Ejemplo: Fin de la pobreza"
                class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">

            @error('nombre')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>

        <!-- Descripción -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Descripción
            </label>

            <textarea
                name="descripcion"
                rows="5"
                class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion') }}</textarea>

            @error('descripcion')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>

                <!-- Color -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Color representativo
            </label>

            <select
                name="color"
                class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                <option value="">Seleccione un color...</option>

                <option value="Rojo" {{ old('color') == 'Rojo' ? 'selected' : '' }}>
                    Rojo
                </option>

                <option value="Naranja" {{ old('color') == 'Naranja' ? 'selected' : '' }}>
                    Naranja
                </option>

                <option value="Amarillo" {{ old('color') == 'Amarillo' ? 'selected' : '' }}>
                    Amarillo
                </option>

                <option value="Verde" {{ old('color') == 'Verde' ? 'selected' : '' }}>
                    Verde
                </option>

                <option value="Celeste" {{ old('color') == 'Celeste' ? 'selected' : '' }}>
                    Celeste
                </option>

                <option value="Azul" {{ old('color') == 'Azul' ? 'selected' : '' }}>
                    Azul
                </option>

                <option value="Morado" {{ old('color') == 'Morado' ? 'selected' : '' }}>
                    Morado
                </option>

                <option value="Gris" {{ old('color') == 'Gris' ? 'selected' : '' }}>
                    Gris
                </option>

            </select>

            @error('color')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>


        <!-- Icono -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Icono
            </label>

            <select
                name="icono"
                class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                <option value="">Seleccione un icono...</option>

                <option value="bi-globe-americas"
                    {{ old('icono') == 'bi-globe-americas' ? 'selected' : '' }}>
                    🌍 Globo
                </option>

                <option value="bi-heart-pulse"
                    {{ old('icono') == 'bi-heart-pulse' ? 'selected' : '' }}>
                    ❤️ Salud
                </option>

                <option value="bi-book"
                    {{ old('icono') == 'bi-book' ? 'selected' : '' }}>
                    📚 Educación
                </option>

                <option value="bi-droplet"
                    {{ old('icono') == 'bi-droplet' ? 'selected' : '' }}>
                    💧 Agua
                </option>

                <option value="bi-tree"
                    {{ old('icono') == 'bi-tree' ? 'selected' : '' }}>
                    🌳 Medio Ambiente
                </option>

                <option value="bi-building"
                    {{ old('icono') == 'bi-building' ? 'selected' : '' }}>
                    🏙 Ciudad
                </option>

                <option value="bi-people"
                    {{ old('icono') == 'bi-people' ? 'selected' : '' }}>
                    👥 Igualdad
                </option>

                <option value="bi-diagram-3"
                    {{ old('icono') == 'bi-diagram-3' ? 'selected' : '' }}>
                    🤝 Alianzas
                </option>

            </select>

            @error('icono')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>


        <!-- Número de metas -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Número de metas
            </label>

            <input
                type="number"
                name="numero_metas"
                value="{{ old('numero_metas') }}"
                min="1"
                class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">

            @error('numero_metas')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>


        <!-- Documento -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Documento Agenda 2030 (PDF)
            </label>

            <input
                type="file"
                name="documento"
                accept=".pdf"
                class="block w-full rounded-md border border-gray-300 p-2">

            <p class="mt-2 text-xs text-gray-500">
                Adjunte el documento oficial correspondiente al Objetivo de Desarrollo Sostenible.
            </p>

            @error('documento')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>


        <!-- Objetivo Padre -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Objetivo Padre
            </label>

            <input
                type="text"
                value="No aplica para Objetivos ODS"
                class="w-full rounded-md bg-gray-100 border-gray-300"
                readonly>

            <input
                type="hidden"
                name="objetivo_padre_id"
                value="">

        </div>

                <!-- Estado -->

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Estado
            </label>

            <select
                name="estado"
                class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">

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
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>

    </div>

    <!-- Botones -->

    <div class="bg-gray-50 border-t border-gray-200 px-8 py-5 flex justify-end gap-3">

        <a href="{{ route('objetivos.listar') }}"
           class="px-6 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100">

            Cancelar

        </a>

        <button
            type="submit"
            class="px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">

            <i class="bi bi-floppy mr-2"></i>

            Guardar Objetivo

        </button>

    </div>

</div>

</form>

</x-objetivos-layout>


