<x-objetivos-layout title="Registrar Objetivo">

    <!-- Barra de navegación -->

    <div class="bg-white border-b border-gray-300 mb-6">

        <div class="flex">

            <a href="{{ route('objetivos.index') }}"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                Información General
            </a>

            <a href="{{ route('objetivos.' . strtolower($tipo)) }}"
                class="px-5 py-3 text-sm font-medium text-gray-500 hover:text-black">
                {{ $tipo }}
            </a>

            <a href="#"
                class="px-5 py-3 text-sm font-medium text-black border-b-2 border-blue-600">
                Registrar {{ $tipo }}
            </a>

        </div>

    </div>


    <!-- Encabezado -->

    <div class="mb-8">

        <h2 class="text-2xl font-semibold text-gray-800">

            Registrar Objetivo

        </h2>

        <p class="mt-2 text-gray-600">

            Complete la información del objetivo estratégico.

        </p>

    </div>


    <!-- Formulario -->

    <form action="{{ route('objetivos.store') }}" method="POST">

        @csrf

        <input type="hidden"
               name="tipo"
               value="{{ $tipo }}">

        <div class="bg-white border border-gray-200 rounded-lg p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Código -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Código
                    </label>

                    <input
                        type="text"
                        name="codigo"
                        value="{{ old('codigo') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    @error('codigo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Nombre -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    @error('nombre')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>
                                <!-- Descripción -->

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        rows="4"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion') }}</textarea>

                    @error('descripcion')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>


                @if($tipo == 'OEI')

                    <!-- Entidad -->

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Entidad
                        </label>

                        <select
                            name="entidad_id"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Seleccione una entidad</option>

                            @foreach($entidades as $entidad)

                                <option value="{{ $entidad->id }}"
                                    {{ old('entidad_id') == $entidad->id ? 'selected' : '' }}>

                                    {{ $entidad->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Plan -->

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Plan
                        </label>

                        <select
                            name="plan_id"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Seleccione un plan</option>

                            @foreach($planes as $plan)

                                <option value="{{ $plan->id }}"
                                    {{ old('plan_id') == $plan->id ? 'selected' : '' }}>

                                    {{ $plan->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Responsable -->

                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Responsable
                        </label>

                        <input
                            type="text"
                            name="responsable"
                            value="{{ old('responsable') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    </div>

                @endif


                <!-- Fecha Inicio -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Inicio
                    </label>

                    <input
                        type="date"
                        name="fecha_inicio"
                        value="{{ old('fecha_inicio') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>


                <!-- Fecha Fin -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Finalización
                    </label>

                    <input
                        type="date"
                        name="fecha_fin"
                        value="{{ old('fecha_fin') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>
                                <!-- Estado -->

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Estado
                    </label>

                    <select
                        name="estado"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        <option value="Activo"
                            {{ old('estado') == 'Activo' ? 'selected' : '' }}>
                            Activo
                        </option>

                        <option value="Inactivo"
                            {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>
                            Inactivo
                        </option>

                    </select>

                </div>

            </div>

            <!-- Botones -->

            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">

                <a href="{{ route('objetivos.' . strtolower($tipo)) }}"
                    class="px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                    <i class="bi bi-check-circle mr-2"></i>

                    Guardar {{ $tipo }}

                </button>

            </div>

        </div>

    </form>

</x-objetivos-layout>