@php
    $recuperarInformacion =
        (string) old('_entidad_form', '') === (string) $entidad->id;

    $recuperarEstado =
        (string) old('_entidad_estado_form', '') === (string) $entidad->id;

    $hayFormularioAnterior =
        $recuperarInformacion || $recuperarEstado;

    $abrirInformacion = $recuperarInformacion
        || (
            !$hayFormularioAnterior
            && session('abrir_panel_entidad') === 'informacion'
        );

    $abrirEstado = $recuperarEstado
        || (
            !$hayFormularioAnterior
            && session('abrir_panel_entidad') === 'estado'
        );
@endphp


<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Configurar la apertura y el cierre de un panel.
        function configurarPanel(opciones) {

            const panel = document.getElementById(opciones.panel);
            const formulario = document.getElementById(opciones.formulario);

            if (!panel || !formulario) {
                return;
            }

            const botonesAbrir = document.querySelectorAll(
                opciones.selectorAbrir
            );

            const botonesCerrar = panel.querySelectorAll(
                opciones.selectorCerrar
            );

            let ultimoBoton = null;

            // Abrir el panel y enfocar el primer campo.
            function abrirPanel(boton = null) {

                ultimoBoton = boton;

                if (!panel.open) {
                    panel.showModal();
                }

                const primerCampo = formulario.querySelector(
                    'input:not([type="hidden"]):not([disabled]), select:not([disabled]), textarea:not([disabled])'
                );

                primerCampo?.focus();

            }

            // Abrir desde los botones del detalle.
            botonesAbrir.forEach(function (boton) {

                boton.addEventListener('click', function (evento) {

                    evento.preventDefault();

                    abrirPanel(boton);

                });

            });

            // Cerrar sin enviar el formulario.
            botonesCerrar.forEach(function (boton) {

                boton.addEventListener('click', function () {
                    panel.close();
                });

            });

            // Descartar cambios no guardados y devolver el foco.
            panel.addEventListener('close', function () {

                formulario.reset();

                if (ultimoBoton && ultimoBoton.isConnected) {
                    ultimoBoton.focus();
                }

            });

            // Abrir después de una redirección o un error de validación.
            if (opciones.abrirAlCargar) {

                abrirPanel(botonesAbrir[0] ?? null);

                const errores = panel.querySelector('[role="alert"]');

                if (errores) {
                    errores.scrollIntoView({
                        block: 'nearest'
                    });
                }

            }

        }

        // Panel de información básica.
        configurarPanel({
            panel: 'panelEditarEntidad',
            formulario: 'formularioEditarEntidad',
            selectorAbrir: '[data-editar-entidad]',
            selectorCerrar: '[data-cerrar-panel-entidad]',
            abrirAlCargar: {{
                Illuminate\Support\Js::from($abrirInformacion)
            }}
        });

        // Panel de estado.
        configurarPanel({
            panel: 'panelEstadoEntidad',
            formulario: 'formularioEstadoEntidad',
            selectorAbrir: '[data-editar-estado-entidad]',
            selectorCerrar: '[data-cerrar-panel-estado-entidad]',
            abrirAlCargar: {{
                Illuminate\Support\Js::from($abrirEstado)
            }}
        });

    });
</script>