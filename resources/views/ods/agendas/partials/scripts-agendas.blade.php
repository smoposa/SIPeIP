@php

    $agendasPanel = $agendas->getCollection()->map(function ($agenda) {
        return [
            'id' => $agenda->id,
            'nombre' => $agenda->nombre,
            'periodo_inicio' => $agenda->periodo_inicio,
            'periodo_fin' => $agenda->periodo_fin,
            'descripcion' => $agenda->descripcion,
            'estado' => $agenda->estado,
            'url' => route('ods.agendas.update', $agenda->id),
        ];
    })->values()->all();

    $datosAnteriores = [
        'formulario' => old('_agenda_form'),
        'nombre' => old('nombre'),
        'periodo_inicio' => old('periodo_inicio'),
        'periodo_fin' => old('periodo_fin'),
        'descripcion' => old('descripcion'),
        'estado' => old('estado'),
    ];

@endphp


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const contenedor = document.getElementById('gestionAgendas');
        const panel = document.getElementById('panelAgenda');

        if (!contenedor || !panel) {
            return;
        }

        const formulario = document.getElementById('formularioAgenda');
        const titulo = document.getElementById('tituloPanelAgenda');
        const nombrePanel = document.getElementById('nombrePanelAgenda');
        const metodo = document.getElementById('metodoAgenda');
        const origen = document.getElementById('origenAgenda');
        const errores = document.getElementById('erroresPanelAgenda');

        const nombre = document.getElementById('nombreAgenda');
        const periodoInicio = document.getElementById('periodoInicioAgenda');
        const periodoFin = document.getElementById('periodoFinAgenda');
        const descripcion = document.getElementById('descripcionAgenda');

        const grupoEstado = document.getElementById('grupoEstadoAgenda');
        const estado = document.getElementById('estadoAgenda');
        const estadoInactivo = document.getElementById('estadoAgendaInactivo');

        const botonCrear = document.getElementById('crearAgenda');
        const botonEditar = document.getElementById('editarPanelAgenda');
        const botonGuardar = document.getElementById('guardarPanelAgenda');
        const botonCerrar = document.getElementById('cerrarPanelAgenda');

        const agendas = {{ Illuminate\Support\Js::from($agendasPanel) }};
        const anteriores = {{ Illuminate\Support\Js::from($datosAnteriores) }};

        const puedeCrear = {{ Illuminate\Support\Js::from(puedeHacer('ods', 'crear')) }};
        const puedeEditar = {{ Illuminate\Support\Js::from(puedeHacer('ods', 'editar')) }};
        const puedeEstado = {{ Illuminate\Support\Js::from(puedeHacer('ods', 'estado')) }};

        const urlCrear = {{ Illuminate\Support\Js::from(route('ods.agendas.store')) }};

        let ultimoBoton = null;
        let agendaActual = null;
        let modoActual = 'ver';

        function actualizarPeriodo() {

            periodoFin.min = periodoInicio.value || '1901';

        }

        function cambiarModo(modo) {

            if (modo === 'crear' && !puedeCrear) {
                return;
            }

            if (
                modo === 'editar'
                && (!agendaActual || (!puedeEditar && !puedeEstado))
            ) {
                return;
            }

            modoActual = modo;

            const creando = modoActual === 'crear';
            const editando = modoActual === 'editar';
            const modificando = creando || editando;

            const editarCampos =
                (creando && puedeCrear) ||
                (editando && puedeEditar);

            if (creando) {

                titulo.textContent = 'Crear agenda';
                nombrePanel.textContent = 'Agenda de Desarrollo Sostenible';

            } else {

                titulo.textContent = editando
                    ? 'Editar agenda'
                    : 'Información de la agenda';

                nombrePanel.textContent = agendaActual?.nombre ?? '';

            }

            nombre.disabled = !editarCampos;
            periodoInicio.disabled = !editarCampos;
            periodoFin.disabled = !editarCampos;
            descripcion.disabled = !editarCampos;

            // Al crear, el servicio asigna automáticamente el estado Activo.
            grupoEstado.hidden = creando;

            estado.disabled = !editando || !puedeEstado;
            estadoInactivo.disabled = !editando || !puedeEstado;

            if (botonEditar) {
                botonEditar.hidden = modificando;
            }

            botonGuardar.hidden = !modificando;
            botonGuardar.disabled = !modificando;

            botonCerrar.textContent = modificando ? 'Cancelar' : 'Cerrar';

        }

        function abrirPanel(agenda = null, boton = null) {

            if (agenda === null && !puedeCrear) {
                return;
            }

            ultimoBoton = boton;
            agendaActual = agenda;

            formulario.reset();

            const creando = agendaActual === null;

            formulario.action = creando ? urlCrear : agendaActual.url;
            metodo.value = creando ? 'POST' : 'PUT';
            origen.value = creando ? 'crear' : String(agendaActual.id);

            nombre.value = agendaActual?.nombre ?? '';
            periodoInicio.value = agendaActual?.periodo_inicio ?? '';
            periodoFin.value = agendaActual?.periodo_fin ?? '';
            descripcion.value = agendaActual?.descripcion ?? '';
            estado.checked = (agendaActual?.estado ?? 'Activo') === 'Activo';

            if (errores) {
                errores.hidden = true;
            }

            actualizarPeriodo();

            // Los registros existentes abren en lectura.
            cambiarModo(creando ? 'crear' : 'ver');

            if (!panel.open) {
                panel.showModal();
            }

            if (creando) {
                nombre.focus();
            }

        }


        // Abrir el formulario de creación.
        if (botonCrear) {

            botonCrear.addEventListener('click', function () {
                abrirPanel(null, botonCrear);
            });

        }


        // Consultar una agenda existente.
        contenedor.querySelectorAll('[data-ver-agenda]').forEach(function (boton) {

            boton.addEventListener('click', function () {

                const agenda = agendas.find(function (item) {
                    return String(item.id) === boton.dataset.verAgenda;
                });

                if (agenda) {
                    abrirPanel(agenda, boton);
                }

            });

        });


        // Habilitar los campos autorizados.
        if (botonEditar) {

            botonEditar.addEventListener('click', function () {

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


        // Impedir el envío en modo lectura.
        formulario.addEventListener('submit', function (evento) {

            const puedeEnviar =
                (modoActual === 'crear' && puedeCrear) ||
                (modoActual === 'editar' && (puedeEditar || puedeEstado));

            if (!puedeEnviar) {
                evento.preventDefault();
            }

        });


        // Mantener el año final igual o posterior al inicial.
        periodoInicio.addEventListener('input', actualizarPeriodo);


        // Cerrar sin guardar.
        panel.querySelectorAll('[data-cerrar-panel-agenda]').forEach(function (boton) {

            boton.addEventListener('click', function () {
                panel.close();
            });

        });


        // Devolver el foco al botón de origen.
        panel.addEventListener('close', function () {

            if (ultimoBoton && ultimoBoton.isConnected) {
                ultimoBoton.focus();
            }

        });


        // Recuperar el formulario tras un error de validación.
        if (anteriores.formulario !== null) {

            let formularioRecuperado = false;

            if (anteriores.formulario === 'crear' && puedeCrear) {

                abrirPanel(null, botonCrear);
                formularioRecuperado = true;

            } else {

                const agenda = agendas.find(function (item) {
                    return String(item.id) === String(anteriores.formulario);
                });

                if (agenda && (puedeEditar || puedeEstado)) {

                    const boton = contenedor.querySelector(
                        '[data-ver-agenda="' + agenda.id + '"]'
                    );

                    abrirPanel(agenda, boton);
                    cambiarModo('editar');

                    formularioRecuperado = true;

                }

            }

            if (formularioRecuperado) {

                if (!nombre.disabled) {

                    nombre.value = anteriores.nombre ?? '';
                    periodoInicio.value = anteriores.periodo_inicio ?? '';
                    periodoFin.value = anteriores.periodo_fin ?? '';
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