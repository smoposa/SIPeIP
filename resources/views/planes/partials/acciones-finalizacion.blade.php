<!-- Acciones -->
<div class="border-t border-gray-200 pt-8 mt-10">

    <div class="flex justify-end gap-3">

        <a href="{{ route('planes.detalle', $plan->id) }}"
            class="px-5 py-2 bg-white border border-[#024687] text-[#024687] rounded-lg hover:bg-blue-50 transition">

            <i class="bi bi-eye mr-1"></i>

            Ver detalle del Plan

        </a>

        <a href="{{ route('planes.create') }}"
            class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">

            <i class="bi bi-plus-circle mr-1"></i>

            Nuevo Plan

        </a>

        <a href="{{ route('planes.listar') }}"
            class="px-5 py-2 bg-[#024687] hover:bg-[#01325f] text-white rounded-lg transition">

            <i class="bi bi-list-ul mr-1"></i>

            Ir al listado

        </a>

    </div>

</div>