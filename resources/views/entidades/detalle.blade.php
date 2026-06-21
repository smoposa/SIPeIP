<x-entidades-layout title="Detalle de Entidad">

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

    <!-- Barra de acciones -->
    <div class="bg-white border-b border-gray-300 mb-0">

        <div class="flex">

            <a href="{{ route('entidades.listar') }}"
            class="px-5 py-3 text-sm font-medium text-blue-500 hover:text-blue-800">
                <i class="bi bi-chevron-left"></i>
                Regresar
            </a>  
            
            <span class="px-5 py-3 text-sm font-medium text-black">
                Información General
            </span>

             <!--<a href="#"
            class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Editar
            </a>

            <a href="#"
            class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Cambiar Estado
            </a>

            <a href="#"
            class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Exportar
            </a> -->

        </div>

    </div>




    <!-- Encabezado 
    <div class="mb-6">

        <h2 class="text-2xl font-semibold text-gray-800">
            Detalle de Entidad
        </h2>

        <p class="mt-1 text-gray-500">
            Información completa de la entidad registrada en el Sistema Integral de Planificación e Inversión Pública (SIPeIP).
        </p>

    </div>-->

    <!-- Scroll vertical -->
    <div class="overflow-y-auto" style="height: calc(100vh - 180px);">

        <!-- Información -->
        <div class="bg-white p-6 shadow-sm">

            <!-- Cabecera de la entidad -->
            <div class="flex items-center gap-4 mb-0 pb-6 ">

                <div class="w-20 h-20 rounded-full bg-[#024687]
                            flex items-center justify-center
                            text-white text-4xl">

                    <i class="bi bi-building"></i>

                </div>

                <div>

                    <h2 class="text-2xl font-semibold text-gray-800">
                        {{ $entidad->nombre }}
                    </h2>

                    <p class="text-gray-500">
                        {{ $entidad->codigoInstitucional }}
                    </p>

                    <p class="text-gray-500">
                        {{ $entidad->tipoEntidad }}
                        |
                        {{ $entidad->nivelGobierno }}
                    </p>

                </div>

            </div>

            

<!-- Encabezado de sección -->
<div class="bg-gray-100 border-b border-gray-200 mb-4">

    <div class="flex justify-between items-center px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Información básica
        </h4>

        <a href="{{ route('entidades.edit', $entidad->id) }}"
           class="text-sm text-blue-600 hover:text-blue-800">

            <i class="bi bi-pencil me-1"></i>
            Editar

        </a>

    </div>

</div>

            <!-- Datos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-4 mb-6">

                <div class="flex items-center">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Código Institucional
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $entidad->codigoInstitucional }}
                    </span>
                </div>

                <div class="flex">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        RUC
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $entidad->ruc }}
                    </span>
                </div>

                <div class="flex">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Tipo de Entidad
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $entidad->tipoEntidad }}
                    </span>
                </div>

                <div class="flex">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Nivel de Gobierno
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $entidad->nivelGobierno }}
                    </span>
                </div>

                <div class="flex">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Provincia
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $entidad->provincia }}
                    </span>
                </div>

                <div class="flex">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Cantón
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $entidad->canton }}
                    </span>
                </div>

                <div class="flex">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Parroquia
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $entidad->parroquia ?: 'No registra' }}
                    </span>
                </div>

                <div class="flex">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Teléfono
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $entidad->telefono ?: 'No registra' }}
                    </span>
                </div>

                <div class="md:col-span-2 flex">
                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Dirección
                    </span>

                    <span class="text-sm text-gray-600">
                        {{ $entidad->direccion ?: 'No registra' }}
                    </span>
                </div>

               <!-- <div class="flex items-center">

                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Estado de la entidad
                    </span>

                    @if($entidad->estado == 'Activo')

                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Habilitado
                        </span>

                    @else

                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                            Deshabilitado
                        </span>

                    @endif

                    <a href="#"
                    class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Editar
                    </a>

                </div> -->




                

                
            </div>


<!-- Encabezado de sección -->
<div class="bg-gray-100 border-b border-gray-200 mb-4">

    <div class="px-4 py-2">

        <h4 class="text-sm font-semibold text-gray-800">
            Estado
        </h4>

    </div>

</div>

<!-- Contenido -->
<div class="px-4 py-3">

    <div class="flex items-center">


                <div class="flex items-center">

                    <span class="w-40 text-sm font-semibold text-gray-700">
                        Estado de la entidad
                    </span>

                    @if($entidad->estado == 'Activo')

                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Habilitado
                        </span>

                    @else

                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                            Deshabilitado
                        </span>

                    @endif

<a href="{{ route('entidades.editarestado', $entidad->id) }}"
class="ml-10 text-sm text-blue-600 hover:text-blue-800 hover:underline">
    Editar
</a>

                </div> 
    </div>

</div>






        
            <!-- Tarjeta Estado 
        <div class="mt-8">

            <div class="w-[30%] min-w-[320px] bg-white border border-gray-200 rounded-lg p-5 shadow-sm">

                <div class="flex gap-4">

                    <i class="bi bi-building-fill text-4xl text-cyan-500"></i>

                    <div>



                        <p class="mt-2 text-sm text-gray-700">

                            @if($entidad->estado == 'Activo')
                                <i class="bi bi-check-circle-fill"></i>
                                Habilitado
                            @else
                                <i class="bi bi-x-circle-fill"></i>
                                Deshabilitado
                            @endif

                        </p>

                        <a href="#"
                        class="block mt-2 text-blue-600 text-sm hover:text-blue-800">
                            Editar
                        </a>

                    </div>

                </div>

            </div>

        </div> -->

            
            
        </div>
    
    </div>
    
</x-entidades-layout>