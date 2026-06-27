<x-plan-layout title="Crear plan">

    <div class="space-y-6">

        <!-- Encabezado -->
        <div>

            <h2 class="text-2xl font-semibold text-gray-900">
                Crear Plan Estratégico Institucional
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Registre un nuevo Plan Estratégico Institucional (PEI) dentro del Sistema Integral de Planificación e Inversión Pública (SIPeIP).
            </p>

        </div>

        <form action="{{ route('planes.store') }}" method="POST">

            @csrf

            <div class="bg-white border border-gray-200 rounded-lg p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Nombre -->
                    <div class="md:col-span-2">

                        <x-input-label
                            for="nombre"
                            value="Nombre del Plan Estratégico Institucional" />

                        <x-text-input
                            id="nombre"
                            name="nombre"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('nombre')" />

                        <x-input-error
                            :messages="$errors->get('nombre')"
                            class="mt-2" />

                    </div>

                    <!-- Entidad -->
                    <div class="md:col-span-2">

                        <x-input-label
                            for="entidad_id"
                            value="Entidad" />

                        <select
                            id="entidad_id"
                            name="entidad_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            <option value="">
                                Seleccione una entidad...
                            </option>

                            @foreach($entidades as $entidad)

                                <option
                                    value="{{ $entidad->id }}"
                                    {{ old('entidad_id') == $entidad->id ? 'selected' : '' }}>

                                    {{ $entidad->nombre }}

                                </option>

                            @endforeach

                        </select>

                        <x-input-error
                            :messages="$errors->get('entidad_id')"
                            class="mt-2" />

                    </div>

                    <!-- Período Inicio -->
                    <div>

                        <x-input-label
                            for="periodo_inicio"
                            value="Período inicio" />

                        <select
                            id="periodo_inicio"
                            name="periodo_inicio"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            <option value="">Seleccione...</option>

                            @foreach($anios as $anio)

                                <option
                                    value="{{ $anio }}"
                                    {{ old('periodo_inicio') == $anio ? 'selected' : '' }}>

                                    {{ $anio }}

                                </option>

                            @endforeach

                        </select>

                        <x-input-error
                            :messages="$errors->get('periodo_inicio')"
                            class="mt-2" />

                    </div>

                    <!-- Período Fin -->
                    <div>

                        <x-input-label
                            for="periodo_fin"
                            value="Período fin" />

                        <select
                            id="periodo_fin"
                            name="periodo_fin"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            <option value="">Seleccione...</option>

                            @foreach($anios as $anio)

                                <option
                                    value="{{ $anio }}"
                                    {{ old('periodo_fin') == $anio ? 'selected' : '' }}>

                                    {{ $anio }}

                                </option>

                            @endforeach

                        </select>

                        <x-input-error
                            :messages="$errors->get('periodo_fin')"
                            class="mt-2" />

                    </div>

                    <!-- Fecha Inicio -->
                    <div>

                        <x-input-label
                            for="fecha_inicio"
                            value="Fecha inicio" />

                        <x-text-input
                            id="fecha_inicio"
                            name="fecha_inicio"
                            type="date"
                            class="mt-1 block w-full"
                            :value="old('fecha_inicio')" />

                        <x-input-error
                            :messages="$errors->get('fecha_inicio')"
                            class="mt-2" />

                    </div>

                    <!-- Fecha Fin -->
                    <div>

                        <x-input-label
                            for="fecha_fin"
                            value="Fecha fin" />

                        <x-text-input
                            id="fecha_fin"
                            name="fecha_fin"
                            type="date"
                            class="mt-1 block w-full"
                            :value="old('fecha_fin')" />

                        <x-input-error
                            :messages="$errors->get('fecha_fin')"
                            class="mt-2" />

                    </div>

                    <!-- Estado -->
                    <div>

                        <x-input-label
                            for="estado"
                            value="Estado" />

                        <select
                            id="estado"
                            name="estado"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                            <option
                                value="Activo"
                                {{ old('estado') == 'Activo' ? 'selected' : '' }}>
                                Activo
                            </option>

                            <option
                                value="Finalizado"
                                {{ old('estado') == 'Finalizado' ? 'selected' : '' }}>
                                Finalizado
                            </option>

                        </select>

                        <x-input-error
                            :messages="$errors->get('estado')"
                            class="mt-2" />

                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">

                        <x-input-label
                            for="descripcion"
                            value="Descripción del Plan Estratégico Institucional" />

                        <textarea
                            id="descripcion"
                            name="descripcion"
                            rows="5"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion') }}</textarea>

                    </div>

                </div>

            </div>

            <div class="flex justify-end gap-3 mt-6">

                <a href="{{ route('planes.index') }}"
                    class="px-5 py-2 border rounded-md text-gray-700 hover:bg-gray-100">

                    Cancelar

                </a>

                <x-primary-button>

                    Guardar Plan

                </x-primary-button>

            </div>

        </form>

    </div>

</x-plan-layout>