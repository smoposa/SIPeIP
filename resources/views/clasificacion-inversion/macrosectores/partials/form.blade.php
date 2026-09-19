<!-- Nombre del macrosector -->
<div>

    <label
        for="nombre"
        class="mb-1.5 block text-sm font-medium text-gray-700"
    >
        Nombre del macrosector

        <span class="text-red-500">*</span>
    </label>

    <input
        type="text"
        id="nombre"
        name="nombre"
        value="{{ old('nombre', $macrosector->nombre ?? '') }}"
        maxlength="150"
        required
        autofocus
        placeholder="Ejemplo: Desarrollo Social"
        class="w-full rounded-md border border-gray-300 px-3 py-2
               text-sm text-gray-700 shadow-sm
               focus:border-blue-500 focus:ring-blue-500
               @error('nombre') border-red-400 @enderror"
    >

    @error('nombre')

        <p class="mt-1 text-xs text-red-600">
            {{ $message }}
        </p>

    @enderror

    <p class="mt-1.5 text-xs text-gray-500">
        Ingrese un nombre único para identificar el macrosector.
    </p>

</div>