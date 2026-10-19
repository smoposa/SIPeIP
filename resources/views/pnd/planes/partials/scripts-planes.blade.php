@php

    $planesPanel = $planes->getCollection()->map(function ($plan) {
        return [
            'id' => $plan->id,
            'nombre' => $plan->nombre,
            'periodo_inicio' => $plan->periodo_inicio,
            'periodo_fin' => $plan->periodo_fin,
            'descripcion' => $plan->descripcion,
            'estado' => $plan->estado,
            'url' => route('pnd.planes.update', ['pnd' => $plan->id]),
        ];
    })->values()->all();

    $datosAnteriores = [
        'formulario' => old('_pnd_form'),
        'nombre' => old('nombre'),
        'periodo_inicio' => old('periodo_inicio'),
        'periodo_fin' => old('periodo_fin'),
        'descripcion' => old('descripcion'),
        'estado' => old('estado'),
    ];

@endphp


<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Buscador y filtro.
        const buscador = document.getElementById('buscarPlanPnd');
        const filtro = document.getElementById('filtroEstadoPnd');
        const filas = document.querySelectorAll('.fila-plan-pnd');
        const sinResultados = document.getElementById('sinResultadosPlanPnd');

        function filtrarPlanes() {

            const texto = buscador.value.toLowerCase().trim();
            const estadoSeleccionado = filtro.value;

            let visibles = 0;

            filas.forEach(function (fila) {

                const nombre = (fila.dataset.nombre || '').toLowerCase();
                const periodo = (fila.dataset.periodo || '').toLowerCase();

                const coincideTexto =
                    nombre.includes(texto) ||
                    periodo.includes(texto);

                const coincideEstado =
                    estadoSeleccionado === '' ||
                    fila.dataset.estado === estadoSeleccionado;

                const mostrar = coincideTexto && coincideEstado;

                fila.style.display = mostrar ? '' : 'none';

                if (mostrar) {
                    visibles++;
                }

            });

            sinResultados.classList.toggle(
                'hidden',
                visibles > 0 || filas.length === 0
            );

        }

        buscador.addEventListener('input', filtrarPlanes);
        filtro.addEventListener('change', filtrarPlanes);

        filtrarPlanes();


        // Panel lateral.
        const contenedor = document.getElementById('gestionPlanesPnd');
        const panel = document.getElementById('panelPlanPnd');
        const formulario = document.getElementById('formularioPlanPnd');

        const titulo = document.getElementById('tituloPanelPlanPnd');
        const metodo = document.getElementById('metodoPlanPnd');
        const origen = document.getElementById('origenPlanPnd');
        const errores = document.getElementById('erroresPanelPlanPnd');

        const nombre = document.getElementById('nombrePlanPnd');
        const inicio = document.getElementById('inicioPlanPnd');
        const fin = document.getElementById('finPlanPnd');
        const descripcion = document.getElementById('descripcionPlanPnd');

        const grupoEstado = document.getElementById('grupoEstadoPlanPnd');
        const estado = document.getElementById('estadoPlanPnd');
        const estadoInactivo = document.getElementById('estadoInactivoPlanPnd');

        const registrar = document.getElementById('registrarPlanPnd');
        const editar = document.getElementById('editarPanelPlanPnd');
        const guardar = document.getElementById('guardarPanelPlanPnd');
        const cerrar = document.getElementById('cerrarPanelPlanPnd');

        const planes = {{ Illuminate\Support\Js::from($planesPanel) }};
        const anteriores = {{ Illuminate\Support\Js::from($datosAnteriores) }};

        const puedeCrear = {{ Illuminate\Support\Js::from(puedeHacer('pnd', 'crear')) }};
        const puedeEditar = {{ Illuminate\Support\Js::from(puedeHacer('pnd', 'editar')) }};
        const puedeEstado = {{ Illuminate\Support\Js::from(puedeHacer('pnd', 'estado')) }};

        const urlCrear = {{ Illuminate\Support\Js::from(route('pnd.planes.store')) }};

        let planActual = null;
        let modoActual = 'ver';
        let ultimoBoton = null;

        function actualizarPeriodo() {

            fin.min = inicio.value || '1901';

        }

        function cambiarModo(modo) {

            if (modo === 'crear' && !puedeCrear) {
                return;
            }

            if (
                modo === 'editar'
                && (!planActual || (!puedeEditar && !puedeEstado))
            ) {
                return;
            }

            modoActual = modo;

            const creando = modo === 'crear';
            const editando = modo === 'editar';
            const modificando = creando || editando;

            const editarCampos =
                (creando && puedeCrear) ||
                (editando && puedeEditar);

            if (creando) {
                titulo.textContent = 'Registrar plan nacional';
            } else if (editando) {
                titulo.textContent = 'Editar plan nacional';
            } else {
                titulo.textContent = 'Información del plan';
            }

            nombre.disabled = !editarCampos;
            inicio.disabled = !editarCampos;
            fin.disabled = !editarCampos;
            descripcion.disabled = !editarCampos;

            grupoEstado.hidden = creando;
            estado.disabled = !editando || !puedeEstado;
            estadoInactivo.disabled = !editando || !puedeEstado;

            if (editar) {
                editar.hidden = modificando;
            }

            guardar.hidden = !modificando;
            guardar.disabled = !modificando;

            cerrar.textContent = modificando ? 'Cancelar' : 'Cerrar';

        }

        function abrirPanel(plan = null, boton = null) {

            if (plan === null && !puedeCrear) {
                return;
            }

            planActual = plan;
            ultimoBoton = boton;

            formulario.reset();

            const creando = planActual === null;

            formulario.action = creando ? urlCrear : planActual.url;
            metodo.value = creando ? 'POST' : 'PUT';
            origen.value = creando ? 'crear' : String(planActual.id);

            nombre.value = planActual?.nombre ?? '';
            inicio.value = planActual?.periodo_inicio ?? '';
            fin.value = planActual?.periodo_fin ?? '';
            descripcion.value = planActual?.descripcion ?? '';
            estado.checked = (planActual?.estado ?? 'Activo') === 'Activo';

            if (errores) {
                errores.hidden = true;
            }

            actualizarPeriodo();
            cambiarModo(creando ? 'crear' : 'ver');

            if (!panel.open) {
                panel.showModal();
            }

            if (creando) {
                nombre.focus();
            }

        }


        // Registrar un plan.
        if (registrar) {

            registrar.addEventListener('click', function () {
                abrirPanel(null, registrar);
            });

        }


        // Consultar un plan.
        contenedor.querySelectorAll('[data-ver-plan]').forEach(function (boton) {

            boton.addEventListener('click', function () {

                const plan = planes.find(function (item) {
                    return String(item.id) === boton.dataset.verPlan;
                });

                if (plan) {
                    abrirPanel(plan, boton);
                }

            });

        });


        // Habilitar edición.
        if (editar) {

            editar.addEventListener('click', function () {

                cambiarModo('editar');

                if (modoActual !== 'editar') {
                    return;
                }

                if (puedeEditar) {
                    nombre.focus();
                } else if (puedeEstado) {
                    estado.focus();
                }

            });

        }


        // Proteger el envío en modo lectura.
        formulario.addEventListener('submit', function (evento) {

            const puedeEnviar =
                (modoActual === 'crear' && puedeCrear) ||
                (modoActual === 'editar' && (puedeEditar || puedeEstado));

            if (!puedeEnviar) {
                evento.preventDefault();
            }

        });

        inicio.addEventListener('input', actualizarPeriodo);


        // Cerrar sin guardar.
        panel.querySelectorAll('[data-cerrar-panel-pnd]').forEach(function (boton) {

            boton.addEventListener('click', function () {
                panel.close();
            });

        });

        panel.addEventListener('close', function () {

            if (ultimoBoton && ultimoBoton.isConnected) {
                ultimoBoton.focus();
            }

        });


        // Recuperar el formulario tras un error.
        if (anteriores.formulario !== null) {

            let recuperado = false;

            if (anteriores.formulario === 'crear' && puedeCrear) {

                abrirPanel(null, registrar);
                recuperado = true;

            } else {

                const plan = planes.find(function (item) {
                    return String(item.id) === String(anteriores.formulario);
                });

                if (plan && (puedeEditar || puedeEstado)) {

                    const boton = contenedor.querySelector(
                        '[data-ver-plan="' + plan.id + '"]'
                    );

                    abrirPanel(plan, boton);
                    cambiarModo('editar');

                    recuperado = true;

                }

            }

            if (recuperado) {

                if (!nombre.disabled) {

                    nombre.value = anteriores.nombre ?? '';
                    inicio.value = anteriores.periodo_inicio ?? '';
                    fin.value = anteriores.periodo_fin ?? '';
                    descripcion.value = anteriores.descripcion ?? '';

                    actualizarPeriodo();

                }

                if (!estado.disabled && anteriores.estado !== null) {
                    estado.checked = anteriores.estado === 'Activo';
                }

                if (errores) {
                    errores.hidden = false;
                }

            }

        }

    });
</script>