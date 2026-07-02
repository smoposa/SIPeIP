<x-roles-layout title="Crear Rol">
    
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

                    <a href="{{ route('roles.listar') }}"
            class="py-2 text-sm font-medium text-blue-500 hover:text-blue-800 mr-8">

                <i class="bi bi-chevron-left"></i>
                Regresar

            </a>

        </div>

    </div>

    <!-- Marco general del contenido -->
    <div class="bg-white p-6 shadow-sm">

        <!-- Encabezado -->
       <div class="mb-6">
        
            <h2 class="text-2xl font-semibold text-gray-800">
                Registrar un nuevo rol
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Registre un rol dentro del Sistema.
            </p>
            
        </div>

        <!-- Scroll del contenido  -->
        <div class="overflow-y-auto" style="height: calc(100vh - 280px);">
            
            <!-- Formulario -->
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf

                <div class="space-y-4">

                    <!-- Nombre -->
                    <div class="flex items-center">

                        <label class="w-40 flex-shrink-0 text-sm font-medium text-gray-700">
                            Nombre del Rol <span class="text-red-500">*</span>
                        </label>

                        <div class="flex-1">
                            <input
                                type="text"
                                name="nombre"
                                maxlength="100"
                                required
                                class="w-full h-9 border border-gray-300 rounded-md px-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                    </div>

                    <!-- Descripción -->
                    <div class="flex items-start">

                        <label class="w-40 flex-shrink-0 pt-2 text-sm font-medium text-gray-700">
                            Descripción
                        </label>

                        <div class="flex-1">

                            <textarea
                                name="descripcion"
                                rows="4"
                                maxlength="255"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"></textarea>

                        </div>

                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end gap-3 mt-6">

                        <div class="col-span-10 col-start-3 flex gap-3">

                            <button
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">
                                Guardar
                            </button>

                            <a href="{{ route('roles.listar') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md">
                                Cancelar
                            </a>

                        </div>

                    </div>
                </div>

            </form>
        </div>
        
    </div>

</x-roles-layout>