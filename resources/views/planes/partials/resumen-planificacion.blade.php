<!-- ================= PLAN ================= -->
<div class="border rounded-lg overflow-hidden">

    <div class="bg-[#024687] px-4 py-2">

        <h3 class="text-sm font-semibold text-white">

            Plan Institucional

        </h3>

    </div>

    <div class="p-5">

        <div class="grid grid-cols-2 gap-5">

            <div>

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Código

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $plan->codigo }}

                </p>

            </div>

            <div>

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Entidad

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $plan->entidad->nombre }}

                </p>

            </div>

            <div class="col-span-2">

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Nombre

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $plan->nombre }}

                </p>

            </div>

        </div>

    </div>

</div>

<!-- ================= OBJETIVO ================= -->
<div class="border rounded-lg overflow-hidden">

    <div class="bg-[#024687] px-4 py-2">

        <h3 class="text-sm font-semibold text-white">

            Objetivo Estratégico Institucional

        </h3>

    </div>

    <div class="p-5">

        <div class="grid grid-cols-2 gap-5">

            <div>

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Código

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $objetivo->codigo }}

                </p>

            </div>

            <div>

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Estado

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $objetivo->estado }}

                </p>

            </div>

            <div class="col-span-2">

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Nombre

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $objetivo->nombre }}

                </p>

            </div>

        </div>

    </div>

</div>

<!-- ================= META ================= -->
<div class="border rounded-lg overflow-hidden">

    <div class="bg-[#024687] px-4 py-2">

        <h3 class="text-sm font-semibold text-white">

            Meta Institucional

        </h3>

    </div>

    <div class="p-5">

        <div class="grid grid-cols-2 gap-5">

            <div>

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Código

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $meta->codigo }}

                </p>

            </div>

            <div>

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Responsable

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $meta->responsable->nombres }}
                    {{ $meta->responsable->apellidos }}

                </p>

            </div>

            <div class="col-span-2">

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Nombre

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $meta->nombre }}

                </p>

            </div>

        </div>

    </div>

</div>

<!-- ================= INDICADOR ================= -->
<div class="border rounded-lg overflow-hidden">

    <div class="bg-[#024687] px-4 py-2">

        <h3 class="text-sm font-semibold text-white">

            Indicador Institucional

        </h3>

    </div>

    <div class="p-5">

        <div class="grid grid-cols-2 gap-5">

            <div>

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Código

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $indicador->codigo }}

                </p>

            </div>

            <div>

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Frecuencia

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $indicador->frecuencia }}

                </p>

            </div>

            <div class="col-span-2">

                <span class="text-xs font-semibold text-gray-500 uppercase">

                    Nombre

                </span>

                <p class="mt-1 text-gray-800 font-medium">

                    {{ $indicador->nombre }}

                </p>

            </div>

        </div>

    </div>

</div>