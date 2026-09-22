            <div class="flex min-w-0 items-center gap-4 pb-6">

                <div class="flex h-16 w-16 flex-shrink-0 items-center
                            justify-center rounded-full bg-[#024687]
                            text-3xl text-white">

                    <i class="bi bi-graph-up-arrow"></i>

                </div>

                <div class="min-w-0">

                    <h2 class="break-words text-xl font-semibold text-gray-800">
                        {{ $indicador->nombre }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $indicador->codigo }} · {{ $indicador->tipo }}
                    </p>

                </div>

            </div>