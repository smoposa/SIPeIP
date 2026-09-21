            <!-- Cabecera -->
            <div class="flex items-center justify-between gap-4 pb-6">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 rounded-full bg-[#0F766E]
                                flex items-center justify-center
                                text-white text-3xl">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                    <div>

                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ $plan->nombre }}
                        </h2>

                        <p class="text-gray-500">
                            {{ $plan->codigo }}
                            ·
                            Período {{ $plan->periodo_inicio }} - {{ $plan->periodo_fin }}
                        </p>

                    </div>

                </div>

                <!-- Versión -->
                <div class="text-right">

                    <p class="text-xs text-gray-500">
                        Versión
                    </p>

                    <span class="inline-flex mt-1 px-3 py-1
                                 text-sm font-semibold
                                 rounded-md bg-gray-100 text-gray-700">

                        v{{ $plan->version }}

                    </span>

                </div>

            </div>