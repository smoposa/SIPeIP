@if(session('success'))

    <div id="alertSuccess"
         class="fixed top-5 right-5 bg-green-600 text-white
                px-6 py-3 rounded-lg shadow-lg z-50">

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