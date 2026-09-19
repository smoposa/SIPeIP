@if(session('success'))

    <div
        id="alertSuccess"
        class="fixed right-5 top-5 z-50 rounded-lg bg-green-600
               px-6 py-3 text-sm text-white shadow-lg"
        role="alert"
    >
        {{ session('success') }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alerta = document.getElementById('alertSuccess');

            if (!alerta) {
                return;
            }

            setTimeout(function () {
                alerta.remove();
            }, 3000);
        });
    </script>

@endif