<x-usuarios-layout title="Editar Estado de Usuario">

    @if(session('error'))

    <div id="alertError"
         class="fixed top-5 right-5 z-50
                bg-red-600 text-white
                px-6 py-3 rounded-lg shadow-lg">

        <div class="flex items-center gap-2">

            <i class="bi bi-exclamation-circle-fill"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    </div>

    <script>
        setTimeout(() => {

            const alerta = document.getElementById('alertError');

            if (alerta) {
                alerta.remove();
            }

        }, 4000);
    </script>

@endif

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300">

        <div class="flex">

            <a href="{{ route('usuarios.show', $usuario->id) }}"
               class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

        </div>

    </div>

    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <div class="p-6">

            <h2 class="text-2xl font-semibold text-gray-800">
                Editar estado del usuario
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Habilite o deshabilite el usuario dentro del sistema.
            </p>

        </div>

        <div class="bg-white p-4">

            <form method="POST"
                  action="{{ route('usuarios.actualizarestado', $usuario->id) }}">

                @csrf
                @method('PUT')

                <div class="flex items-center gap-20">

                    <label class="text-sm font-medium text-gray-700">
                        Usuario habilitado
                    </label>

                    <!-- Si el checkbox está desmarcado -->
                    <input
                        type="hidden"
                        name="estado"
                        value="Inactivo">

                    <!-- Si está marcado -->
                    <input
                        type="checkbox"
                        name="estado"
                        value="Activo"
                        {{ $usuario->estado === 'Activo' ? 'checked' : '' }}
                        class="w-5 h-5">

                </div>

                <div class="flex gap-3 mt-20">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">

                        Guardar

                    </button>

                    <a href="{{ route('usuarios.show', $usuario->id) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-usuarios-layout>