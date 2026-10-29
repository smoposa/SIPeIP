<script>
    (() => {
        function inicializarPlanes() {

            // Notificación de éxito
            const aviso = document.getElementById('avisoExitoPlanes');

            if (aviso) {
                window.setTimeout(() => aviso.remove(), 3000);
            }


            // Buscador y filtro
            const buscador = document.getElementById('buscarPlanInstitucional');
            const filtro = document.getElementById('filtroEstadoPlanInstitucional');
            const listado = document.getElementById('gestionPlanesInstitucionales');
            const sinResultados = document.getElementById('sinResultadosPlanInstitucional');

            if (!buscador || !filtro || !listado || !sinResultados) {
                return;
            }

            const filas = Array.from(
                listado.querySelectorAll('.fila-plan-institucional')
            );


            // Permite buscar sin distinguir mayúsculas ni tildes.
            function normalizar(valor) {
                return String(valor ?? '')
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .toLowerCase()
                    .trim();
            }


            const registros = filas.map(fila => ({
                fila,
                estado: fila.dataset.estado,
                texto: normalizar([
                    fila.dataset.codigo,
                    fila.dataset.nombre,
                    fila.dataset.entidad,
                    fila.dataset.periodo
                ].join(' '))
            }));


            function filtrarPlanes() {
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

                // Evita duplicar el mensaje cuando no hay registros.
                sinResultados.classList.toggle(
                    'hidden',
                    registros.length === 0 || visibles > 0
                );
            }


            buscador.addEventListener('input', filtrarPlanes);
            filtro.addEventListener('change', filtrarPlanes);

            filtrarPlanes();
        }


        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                inicializarPlanes,
                { once: true }
            );
        } else {
            inicializarPlanes();
        }
    })();
</script>