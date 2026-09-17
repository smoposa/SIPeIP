<!-- Acciones -->
<div class="mt-8 border-t border-gray-200 pt-6">

    <div class="flex flex-wrap justify-end gap-3">

        <button type="submit"
                class="inline-flex h-10 items-center justify-center gap-2 rounded-md
                       bg-[#024687] px-5 text-sm font-medium text-white
                       transition hover:bg-[#01325f]
                       focus:outline-none focus:ring-2 focus:ring-[#024687] focus:ring-offset-2">

            <i class="bi bi-check-circle"></i>

            Guardar objetivo

        </button>

        <a href="{{ route('objetivos.listar') }}"
           class="inline-flex h-10 items-center justify-center rounded-md
                  bg-gray-200 px-5 text-sm font-medium text-gray-700
                  transition hover:bg-gray-300
                  focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">

            Cancelar

        </a>

    </div>

</div>