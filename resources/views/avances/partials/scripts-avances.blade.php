<script>
    (() => {
        function inicializarAvances() {
            const buscador = document.getElementById('buscarAvance');
            const filtro = document.getElementById('filtroEstadoAvance');
            const listado = document.getElementById('gestionAvances');
            const sinResultados = document.getElementById('sinResultadosAvance');

            if (!buscador || !filtro || !listado || !sinResultados) return;

            function normalizar(valor) {
                return String(valor ?? '')
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .toLowerCase()
                    .trim();
            }

            const registros = Array.from(
                listado.querySelectorAll('.fila-avance')
            ).map(fila => ({
                fila,
                estado: fila.dataset.estado,
                texto: normalizar([
                    fila.dataset.proyecto,
                    fila.dataset.indicador,
                    fila.dataset.periodo,
                    fila.dataset.anio
                ].join(' '))
            }));

            function filtrar() {
                const palabras = normalizar(buscador.value)
                    .split(/\s+/)
                    .filter(Boolean);

                let visibles = 0;

                registros.forEach(registro => {
                    const mostrar =
                        palabras.every(palabra => registro.texto.includes(palabra)) &&
                        (!filtro.value || registro.estado === filtro.value);

                    registro.fila.classList.toggle('hidden', !mostrar);

                    if (mostrar) visibles++;
                });

                sinResultados.classList.toggle(
                    'hidden',
                    registros.length === 0 || visibles > 0
                );
            }

            buscador.addEventListener('input', filtrar);
            filtro.addEventListener('change', filtrar);

            filtrar();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', inicializarAvances, { once: true });
        } else {
            inicializarAvances();
        }
    })();
</script>