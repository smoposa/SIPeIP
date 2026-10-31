@php
    $recuperarInformacion =
        (string) old('_plan_form', '') === (string) $plan->id;

    $recuperarEstado =
        (string) old('_plan_estado_form', '') === (string) $plan->id;

    $panelInicialPlan = $recuperarInformacion
        ? 'informacion'
        : ($recuperarEstado ? 'estado' : session('abrir_panel_plan'));

    $panelesPlan = [
        [
            'nombre' => 'informacion',
            'panel' => 'panelEditarPlan',
            'formulario' => 'formularioEditarPlan',
            'abrir' => '[data-editar-plan]',
            'cerrar' => '[data-cerrar-panel-plan]',
        ],
        [
            'nombre' => 'estado',
            'panel' => 'panelEstadoPlan',
            'formulario' => 'formularioEstadoPlan',
            'abrir' => '[data-editar-estado-plan]',
            'cerrar' => '[data-cerrar-panel-estado-plan]',
        ],
    ];
@endphp

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const paneles = {{
            Illuminate\Support\Js::from($panelesPlan)
        }};

        const panelInicial = {{
            Illuminate\Support\Js::from($panelInicialPlan)
        }};

        const inicio = document.getElementById('inicioPanelPlan');
        const fin = document.getElementById('finPanelPlan');


        // Mantener el año final igual o posterior al inicial.
        function actualizarPeriodoPlan() {

            if (!inicio || !fin) {
                return;
            }

            const anio = Number(inicio.value);

            fin.min = inicio.value && Number.isFinite(anio)
                ? String(Math.max(2000, anio))
                : '2000';

        }

        inicio?.addEventListener('input', actualizarPeriodoPlan);

        actualizarPeriodoPlan();


        // Configurar los paneles de edición.
        paneles.forEach(function (opciones) {

            const panel = document.getElementById(opciones.panel);
            const formulario = document.getElementById(opciones.formulario);

            if (!panel || !formulario) {
                return;
            }

            const enlacesAbrir = document.querySelectorAll(opciones.abrir);

            let ultimoEnlace = null;


            function abrirPanel(enlace = null) {

                ultimoEnlace = enlace;

                if (!panel.open) {
                    panel.showModal();
                }

                formulario.querySelector(
                    'input:not([type="hidden"]):not([disabled]), select:not([disabled]), textarea:not([disabled])'
                )?.focus();

                panel.querySelector('[role="alert"]')?.scrollIntoView({
                    block: 'nearest'
                });

            }


            // Abrir desde los enlaces del detalle.
            enlacesAbrir.forEach(function (enlace) {

                enlace.setAttribute('aria-haspopup', 'dialog');
                enlace.setAttribute('aria-controls', opciones.panel);

                enlace.addEventListener('click', function (evento) {

                    if (
                        evento.ctrlKey || evento.metaKey
                        || evento.shiftKey || evento.altKey
                    ) {
                        return;
                    }

                    evento.preventDefault();

                    abrirPanel(enlace);

                });

            });


            // Cerrar sin guardar.
            panel.querySelectorAll(opciones.cerrar).forEach(function (boton) {

                boton.addEventListener('click', function () {
                    panel.close();
                });

            });


            // Restablecer los datos y devolver el foco.
            panel.addEventListener('close', function () {

                formulario.reset();

                if (opciones.nombre === 'informacion') {
                    actualizarPeriodoPlan();
                }

                if (ultimoEnlace && ultimoEnlace.isConnected) {
                    ultimoEnlace.focus({
                        preventScroll: true
                    });
                }

            });


            // Recuperar el panel después de una redirección.
            if (panelInicial === opciones.nombre) {
                abrirPanel(enlacesAbrir[0] ?? null);
            }

        });


        // Configurar los paneles de consulta de objetivos.
        document.querySelectorAll(
            '[data-panel-consulta-objetivo]'
        ).forEach(function (panel) {

            let ultimoBoton = null;

            const botonesAbrir = document.querySelectorAll(
                '[data-consultar-objetivo]'
            );


            // Abrir solamente el panel del objetivo seleccionado.
            botonesAbrir.forEach(function (boton) {

                if (boton.dataset.panelObjetivo !== panel.id) {
                    return;
                }

                boton.addEventListener('click', function () {

                    ultimoBoton = boton;

                    if (!panel.open) {
                        panel.showModal();
                    }

                    panel.querySelector(
                        '[data-cerrar-consulta-objetivo]'
                    )?.focus({
                        preventScroll: true
                    });

                });

            });


            // Cerrar desde los botones del panel.
            panel.querySelectorAll(
                '[data-cerrar-consulta-objetivo]'
            ).forEach(function (boton) {

                boton.addEventListener('click', function () {
                    panel.close();
                });

            });


            // Volver al botón original sin desplazar la página.
            panel.addEventListener('close', function () {

                if (ultimoBoton && ultimoBoton.isConnected) {
                    ultimoBoton.focus({
                        preventScroll: true
                    });
                }

            });

        });

    });
</script>

<style>
    #panelEditarPlan::backdrop,
    #panelEstadoPlan::backdrop,
    [data-panel-consulta-objetivo]::backdrop {
        background: rgb(0 0 0 / 20%);
    }
</style>