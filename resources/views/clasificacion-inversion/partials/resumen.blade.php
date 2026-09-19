<div class="grid grid-cols-1 gap-3 sm:grid-cols-3">

    {{-- Macrosectores --}}
    <div class="rounded-lg border border-gray-200 bg-white px-4 py-3">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 flex-shrink-0 items-center
                        justify-center rounded-lg bg-slate-100">

                <i class="bi bi-grid-1x2 text-slate-600"></i>

            </div>

            <div>

                <p class="text-xl font-semibold text-gray-800">
                    {{ $totalMacrosectores }}
                </p>

                <p class="text-xs text-gray-500">
                    Macrosectores
                </p>

            </div>

        </div>

    </div>

    {{-- Sectores --}}
    <div class="rounded-lg border border-gray-200 bg-white px-4 py-3">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 flex-shrink-0 items-center
                        justify-center rounded-lg bg-slate-100">

                <i class="bi bi-diagram-2 text-slate-600"></i>

            </div>

            <div>

                <p class="text-xl font-semibold text-gray-800">
                    {{ $totalSectores }}
                </p>

                <p class="text-xs text-gray-500">
                    Sectores
                </p>

            </div>

        </div>

    </div>

    {{-- Subsectores --}}
    <div class="rounded-lg border border-gray-200 bg-white px-4 py-3">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 flex-shrink-0 items-center
                        justify-center rounded-lg bg-slate-100">

                <i class="bi bi-list-nested text-slate-600"></i>

            </div>

            <div>

                <p class="text-xl font-semibold text-gray-800">
                    {{ $totalSubsectores }}
                </p>

                <p class="text-xs text-gray-500">
                    Subsectores
                </p>

            </div>

        </div>

    </div>

</div>