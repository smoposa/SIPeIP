<!-- Notificación de éxito -->
@if(session('success'))
    <div id="alertSuccess" role="status"
         class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            const alerta = document.getElementById('alertSuccess');
            if (alerta) alerta.remove();
        }, 3000);
    </script>
@endif

<!-- Los errores permanecen visibles para corregir el formulario -->
@if($errors->any())
    <div role="alert" class="mb-4 rounded-md bg-red-50 px-4 py-3 text-sm text-red-800">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
