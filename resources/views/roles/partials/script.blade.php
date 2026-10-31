@php
    $recuperarInformacion =
        (string) old('_rol_form', '') === (string) $rol->id;

    $recuperarEstado =
        (string) old('_rol_estado_form', '') === (string) $rol->id;

    $hayFormularioAnterior =
        $recuperarInformacion || $recuperarEstado;

    $abrirInformacion = $recuperarInformacion
        || (
            !$hayFormularioAnterior
            && session('abrir_panel_rol') === 'informacion'
        );

    $abrirEstado = $recuperarEstado
        || (
            !$hayFormularioAnterior
            && session('abrir_panel_rol') === 'estado'
        );
@endphp


<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Configurar un panel y sus botones.
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


            // Abrir el panel.
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


            // Abrir desde los enlaces del detalle.
            botonesAbrir.forEach(function (boton) {

                boton.setAttribute('aria-haspopup', 'dialog');
                boton.setAttribute('aria-controls', opciones.panel);

                boton.addEventListener('click', function (evento) {

                    evento.preventDefault();

                    abrirPanel(boton);

                });

            });


            // Cerrar sin guardar.
            botonesCerrar.forEach(function (boton) {

                boton.addEventListener('click', function () {
                    panel.close();
                });

            });


            // Restablecer los campos y devolver el foco.
            panel.addEventListener('close', function () {

                formulario.reset();

                if (ultimoBoton && ultimoBoton.isConnected) {
                    ultimoBoton.focus();
                }

            });


            // Abrir tras una redirección o un error de validación.
            if (opciones.abrirAlCargar) {

                abrirPanel(botonesAbrir[0] ?? null);

                const errores = panel.querySelector('[role="alert"]');

                errores?.scrollIntoView({
                    block: 'nearest'
                });

            }

        }


        // Panel de información.
        configurarPanel({
            panel: 'panelEditarRol',
            formulario: 'formularioEditarRol',
            selectorAbrir: '[data-editar-rol]',
            selectorCerrar: '[data-cerrar-panel-rol]',
            abrirAlCargar: {{
                Illuminate\Support\Js::from($abrirInformacion)
            }}
        });


        // Panel de estado.
        configurarPanel({
            panel: 'panelEstadoRol',
            formulario: 'formularioEstadoRol',
            selectorAbrir: '[data-editar-estado-rol]',
            selectorCerrar: '[data-cerrar-panel-estado-rol]',
            abrirAlCargar: {{
                Illuminate\Support\Js::from($abrirEstado)
            }}
        });

    });
</script>