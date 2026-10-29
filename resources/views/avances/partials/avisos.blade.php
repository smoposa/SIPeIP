@if(session('success'))

    <div id="avisoExitoAvances"
         role="status"
         aria-live="polite"
         class="fixed right-5 top-5 z-50 max-w-sm rounded-lg
                bg-green-600 px-6 py-3 text-sm text-white shadow-lg">

        <div class="flex items-center gap-2">

            <i class="bi bi-check-circle-fill" aria-hidden="true"></i>

            <span>{{ session('success') }}</span>

        </div>

    </div>

    <script>
        window.setTimeout(() => {
            document.getElementById('avisoExitoAvances')?.remove();
        }, 3000);
    </script>

@endif