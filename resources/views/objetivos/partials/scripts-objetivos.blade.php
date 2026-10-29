<script>
    (() => {
        function inicializarObjetivos() {

            // Notificación de éxito
            const aviso = document.getElementById('avisoExitoObjetivos');

            if (aviso) {
                window.setTimeout(() => aviso.remove(), 3000);
            }


            // Buscador y filtro
            const buscador = document.getElementById('buscarObjetivo');
            const filtro = document.getElementById('filtroEstadoObjetivo');
            const listado = document.getElementById('gestionObjetivos');
            const sinResultados = document.getElementById('sinResultadosObjetivo');

            if (!buscador || !filtro || !listado || !sinResultados) {
                return;
            }


            // Buscar sin distinguir mayúsculas ni tildes.
            function normalizar(valor) {
                return String(valor ?? '')
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .toLowerCase()
                    .trim();
            }


            const registros = Array.from(
                listado.querySelectorAll('.fila-objetivo')
            ).map(fila => ({
                fila,
                estado: fila.dataset.estado,
                texto: normalizar([
                    fila.dataset.codigo,
                    fila.dataset.nombre,
                    fila.dataset.entidad,
                    fila.dataset.plan
                ].join(' '))
            }));


            function filtrarObjetivos() {
                const palabras = normalizar(buscador.value)
                    .split(/\s+/)
                    .filter(Boolean);

                const estado = filtro.value;
                let visibles = 0;

                registros.forEach(registro => {
                    const coincideBusqueda = palabras.every(
                        palabra => registro.texto.includes(palabra)
                    );

                    const coincideEstado =
                        estado === '' || registro.estado === estado;

                    const mostrar = coincideBusqueda && coincideEstado;

                    registro.fila.classList.toggle('hidden', !mostrar);

                    if (mostrar) {
                        visibles++;
                    }
                });

                sinResultados.classList.toggle(
                    'hidden',
                    registros.length === 0 || visibles > 0
                );
            }


            buscador.addEventListener('input', filtrarObjetivos);
            filtro.addEventListener('change', filtrarObjetivos);

            filtrarObjetivos();
        }


        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                inicializarObjetivos,
                { once: true }
            );
        } else {
            inicializarObjetivos();
        }
    })();
</script>