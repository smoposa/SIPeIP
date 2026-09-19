@php
    $esEdicion = isset($proyecto);

    $formularioDisponible =
        $programas->isNotEmpty()
        && $responsables->isNotEmpty()
        && $macrosectores->isNotEmpty();
@endphp

<div class="flex items-center justify-between pb-6 pt-2">

    <a href="{{ $esEdicion
            ? route('proyectos.detalle', $proyecto->id)
            : route('proyectos.listar') }}"
        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">

        <i class="bi bi-arrow-left mr-2"></i>
        Cancelar
    </a>

    <button
        type="submit"
        @disabled(!$formularioDisponible)
        class="inline-flex items-center rounded-md bg-blue-600 px-5 py-2 text-sm font-medium text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-gray-400">

        <i class="bi bi-floppy mr-2"></i>

        {{ $esEdicion
            ? 'Actualizar proyecto'
            : 'Guardar proyecto' }}
    </button>

</div>

@if (!$formularioDisponible)
    <p class="pb-6 text-right text-sm text-amber-700">
        Para registrar el proyecto deben existir programas, usuarios responsables
        y clasificaciones de intervención activas.
    </p>
@endif