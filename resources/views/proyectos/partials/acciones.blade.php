{{-- ================= ACCIONES ================= --}}
<div class="flex items-center justify-between pt-2 pb-6">

    <a href="{{ route('proyectos.listar') }}"
        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md
               text-sm font-medium text-gray-700 bg-white
               hover:bg-gray-50 transition">

        <i class="bi bi-arrow-left mr-2"></i>

        Cancelar

    </a>

    <button
        type="submit"
        class="inline-flex items-center px-5 py-2 bg-blue-600
               hover:bg-blue-700 text-white text-sm font-medium
               rounded-md transition">

        <i class="bi bi-floppy mr-2"></i>

        Guardar proyecto

    </button>

</div>