@php
    $editando = isset($programa);

    $rutaCancelar = $editando
        ? route('programas.detalle', $programa->id)
        : route('programas.listar');
@endphp

<div class="flex flex-col-reverse gap-2 pb-6 pt-2
            sm:flex-row sm:items-center sm:justify-between">

    <a
        href="{{ $rutaCancelar }}"
        class="inline-flex items-center justify-center gap-2
               rounded-md border border-gray-300 bg-white
               px-4 py-2 text-sm font-medium text-gray-700
               transition hover:bg-gray-50"
    >
        <i class="bi bi-arrow-left"></i>

        Cancelar
    </a>

    <button
        type="submit"
        class="inline-flex items-center justify-center gap-2
               rounded-md bg-blue-600 px-5 py-2
               text-sm font-medium text-white
               transition hover:bg-blue-700"
    >
        <i class="bi bi-floppy"></i>

        {{ $editando
            ? 'Actualizar programa'
            : 'Guardar programa' }}
    </button>

</div>