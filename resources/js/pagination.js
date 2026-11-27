
/**
 * Paginación adaptable según la altura del navegador.
 */

function obtenerRegistrosPorPagina() {

    const altura = window.innerHeight;

    if (altura < 700) {
        return 7;
    }

    if (altura < 900) {
        return 10;
    }

    return 15;
}

function actualizarPaginacion() {

    // Aplicar únicamente en pantallas con paginación.
    if (!document.querySelector('[data-pagination]')) {
        return;
    }

    const url = new URL(window.location.href);
    const cantidad = obtenerRegistrosPorPagina();

    if (url.searchParams.get('per_page') === String(cantidad)) {
        return;
    }

    url.searchParams.set('per_page', cantidad);
    url.searchParams.set('page', '1');

    window.location.replace(url.toString());
}

// Detectar la altura al cargar la página.
document.addEventListener('DOMContentLoaded', actualizarPaginacion);

// Detectar cambios en el tamaño de la ventana.
let temporizadorPaginacion;

window.addEventListener('resize', function () {

    clearTimeout(temporizadorPaginacion);

    temporizadorPaginacion = setTimeout(
        actualizarPaginacion,
        400
    );

});
