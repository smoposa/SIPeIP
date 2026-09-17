<!-- Acciones -->
<div class="mt-8 border-t border-gray-200 pt-6">

    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

        <button type="submit"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-md
                       bg-[#024687] px-5 text-sm font-medium text-white
                       transition hover:bg-[#01325f]">

            <i class="bi bi-check-circle"></i>

            Guardar meta

        </button>

        <a href="{{ route('metas.listar') }}"
           class="inline-flex h-10 items-center justify-center rounded-md
                  bg-gray-200 px-5 text-sm font-medium text-gray-700
                  transition hover:bg-gray-300">

            Cancelar

        </a>

    </div>

</div>