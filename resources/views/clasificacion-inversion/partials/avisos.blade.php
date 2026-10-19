@if(session('success'))
    <div id="avisoClasificacion" role="status"
         class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function () {
            document.getElementById('avisoClasificacion')?.remove();
        }, 3000);
    </script>
@endif
