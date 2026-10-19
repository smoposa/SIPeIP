<style>
    #detalleObjetivoPnd [hidden] { display: none !important; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const contenedor = document.getElementById('detalleObjetivoPnd');
        if (!contenedor) return;

        const pestanas = Array.from(contenedor.querySelectorAll('[data-pestana-pnd]'));
        const contenidos = Array.from(contenedor.querySelectorAll('[data-contenido-pnd]'));
        const buscador = document.getElementById('buscarContenidoObjetivoPnd');
        const botonPolitica = document.getElementById('registrarPoliticaPnd');
        const botonMeta = document.getElementById('registrarMetaPnd');
        const filasPoliticas = Array.from(contenedor.querySelectorAll('[data-fila-politica]'));
        const filasMetas = Array.from(contenedor.querySelectorAll('[data-fila-meta]'));
        const sinPoliticas = contenedor.querySelector('[data-sin-politicas]');
        const sinMetas = contenedor.querySelector('[data-sin-metas]');
        let contenidoActual = 'contenidoPoliticasPnd';

        function normalizar(texto) {
            return texto.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim();
        }

        function filtrar() {
            const texto = normalizar(buscador?.value || '');

            if (contenidoActual === 'contenidoMetasPnd') {
                let visibles = 0;
                filasMetas.forEach(function (fila) {
                    const mostrar = normalizar(fila.dataset.busqueda || '').includes(texto);
                    fila.hidden = !mostrar;
                    if (mostrar) visibles++;
                });
                if (sinMetas) sinMetas.hidden = visibles > 0 || filasMetas.length === 0;
                return;
            }

            let visibles = 0;
            filasPoliticas.forEach(function (fila) {
                const coincidePolitica = normalizar(fila.dataset.busqueda || '').includes(texto);
                let estrategiasVisibles = 0;

                // Solo se filtran los registros, nunca los encabezados ni los botones.
                fila.querySelectorAll('[data-fila-estrategia]').forEach(function (estrategia) {
                    const mostrar = coincidePolitica || normalizar(estrategia.dataset.busqueda || '').includes(texto);
                    estrategia.hidden = !mostrar;
                    if (mostrar) estrategiasVisibles++;
                });

                const mostrar = coincidePolitica || estrategiasVisibles > 0;
                fila.hidden = !mostrar;
                if (mostrar) visibles++;

                if (texto && !coincidePolitica && estrategiasVisibles > 0) {
                    const desplegable = fila.querySelector('details');
                    if (desplegable) desplegable.open = true;
                }
            });
            if (sinPoliticas) sinPoliticas.hidden = visibles > 0 || filasPoliticas.length === 0;
        }

        function activar(pestanaActiva, moverFoco = false) {
            contenidoActual = pestanaActiva.getAttribute('aria-controls');
            const politicas = contenidoActual === 'contenidoPoliticasPnd';

            pestanas.forEach(function (pestana) {
                const activa = pestana === pestanaActiva;
                pestana.setAttribute('aria-selected', String(activa));
                pestana.tabIndex = activa ? 0 : -1;
                pestana.classList.toggle('bg-gray-100', activa);
                pestana.classList.toggle('text-blue-700', activa);
                pestana.classList.toggle('text-gray-700', !activa);
            });

            contenidos.forEach(function (contenido) {
                contenido.hidden = contenido.id !== contenidoActual;
            });

            if (botonPolitica) botonPolitica.hidden = !politicas;
            if (botonMeta) botonMeta.hidden = politicas;
            if (buscador) {
                const etiqueta = politicas ? 'Buscar política o estrategia' : 'Buscar meta';
                buscador.placeholder = etiqueta + '...';
                buscador.setAttribute('aria-label', etiqueta);
            }
            filtrar();
            if (moverFoco) pestanaActiva.focus();
        }

        pestanas.forEach(function (pestana, indice) {
            pestana.addEventListener('click', function () { activar(pestana); });
            pestana.addEventListener('keydown', function (evento) {
                let destino;
                switch (evento.key) {
                    case 'ArrowRight': destino = (indice + 1) % pestanas.length; break;
                    case 'ArrowLeft': destino = (indice - 1 + pestanas.length) % pestanas.length; break;
                    case 'Home': destino = 0; break;
                    case 'End': destino = pestanas.length - 1; break;
                    default: return;
                }
                evento.preventDefault();
                activar(pestanas[destino], true);
            });
        });

        if (buscador) buscador.addEventListener('input', filtrar);

        // Volver a la pestaña de metas o a la política guardada.
        function restaurarUbicacion() {
            const esMeta = window.location.hash === '#metas';
            const inicial = document.getElementById(esMeta ? 'tabMetasPnd' : 'tabPoliticasPnd');
            if (inicial) activar(inicial);

            const hash = window.location.hash.slice(1);
            if (/^politica-\d+$/.test(hash)) {
                const politica = document.getElementById(hash);
                if (politica && politica.tagName === 'DETAILS') politica.open = true;
            }
        }
        restaurarUbicacion();
        window.addEventListener('hashchange', restaurarUbicacion);
    });
</script>
