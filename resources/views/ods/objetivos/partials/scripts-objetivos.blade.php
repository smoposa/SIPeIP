@php

    $objetivosPanel = $ods->map(function ($item) {
        return [
            'id' => $item->id,
            'codigo' => $item->codigo,
            'nombre' => $item->nombre,
            'descripcion' => $item->descripcion,
            'estado' => $item->estado,
            'url' => route('ods.objetivos.update', ['ods' => $item->id]),
        ];
    })->values()->all();

    $datosAnteriores = [
        'formulario' => old('_objetivo_form'),
        'codigo' => old('codigo'),
        'nombre' => old('nombre'),
        'descripcion' => old('descripcion'),
        'estado' => old('estado'),
    ];

@endphp


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const contenedor = document.getElementById('gestionObjetivos');
        const panel = document.getElementById('panelObjetivo');

        if (!contenedor || !panel) {
            return;
        }

        const formulario = document.getElementById('formularioObjetivo');
        const titulo = document.getElementById('tituloPanelObjetivo');
        const metodo = document.getElementById('metodoObjetivo');
        const origen = document.getElementById('origenObjetivo');
        const errores = document.getElementById('erroresPanelObjetivo');

        const codigo = document.getElementById('codigoObjetivo');
        const ayudaCodigo = document.getElementById('ayudaCodigoObjetivo');
        const nombre = document.getElementById('nombreObjetivo');
        const descripcion = document.getElementById('descripcionObjetivo');

        const grupoEstado = document.getElementById('grupoEstadoObjetivo');
        const estado = document.getElementById('estadoObjetivo');
        const estadoInactivo = document.getElementById('estadoObjetivoInactivo');

        const botonRegistrar = document.getElementById('registrarObjetivo');
        const botonEditar = document.getElementById('editarPanelObjetivo');
        const botonGuardar = document.getElementById('guardarPanelObjetivo');
        const botonCerrar = document.getElementById('cerrarPanelObjetivo');

        const objetivos = {{ Illuminate\Support\Js::from($objetivosPanel) }};
        const anteriores = {{ Illuminate\Support\Js::from($datosAnteriores) }};
        const codigoSugerido = {{ Illuminate\Support\Js::from($codigoSugerido) }};

        const puedeCrear = {{ Illuminate\Support\Js::from(puedeHacer('ods', 'crear')) }};
        const puedeEditar = {{ Illuminate\Support\Js::from(puedeHacer('ods', 'editar')) }};
        const puedeEstado = {{ Illuminate\Support\Js::from(puedeHacer('ods', 'estado')) }};

        const urlCrear = {{ Illuminate\Support\Js::from(
            route('ods.objetivos.store', ['agenda' => $agenda->id])
        ) }};

        let ultimoBoton = null;
        let objetivoActual = null;
        let modoActual = 'ver';

        function cambiarModo(modo) {

            if (modo === 'crear' && !puedeCrear) {
                return;
            }

            if (
                modo === 'editar'
                && (!objetivoActual || (!puedeEditar && !puedeEstado))
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
                titulo.textContent = 'Registrar objetivo';
            } else if (editando) {
                titulo.textContent = 'Editar objetivo';
            } else {
                titulo.textContent = 'Información del objetivo';
            }

            // Al crear, el código automático se muestra como lectura.
            codigo.disabled = !editarCampos;
            codigo.readOnly = creando;
            ayudaCodigo.hidden = !creando;

            nombre.disabled = !editarCampos;
            descripcion.disabled = !editarCampos;

            // El servicio establece el estado inicial Activo.
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

        function abrirPanel(objetivo = null, boton = null) {

            if (objetivo === null && !puedeCrear) {
                return;
            }

            ultimoBoton = boton;
            objetivoActual = objetivo;

            formulario.reset();

            const creando = objetivoActual === null;

            formulario.action = creando ? urlCrear : objetivoActual.url;
            metodo.value = creando ? 'POST' : 'PUT';
            origen.value = creando ? 'crear' : String(objetivoActual.id);

            codigo.value = creando
                ? (codigoSugerido ?? '')
                : (objetivoActual.codigo ?? '');

            nombre.value = objetivoActual?.nombre ?? '';
            descripcion.value = objetivoActual?.descripcion ?? '';
            estado.checked = (objetivoActual?.estado ?? 'Activo') === 'Activo';

            if (errores) {
                errores.hidden = true;
            }

            // Los registros existentes siempre abren en modo lectura.
            cambiarModo(creando ? 'crear' : 'ver');

            if (!panel.open) {
                panel.showModal();
            }

            if (creando) {
                nombre.focus();
            }

        }


        // Abrir el formulario de creación.
        if (botonRegistrar) {

            botonRegistrar.addEventListener('click', function () {
                abrirPanel(null, botonRegistrar);
            });

        }


        // Consultar un objetivo existente.
        contenedor.querySelectorAll('[data-ver-objetivo]').forEach(function (boton) {

            boton.addEventListener('click', function () {

                const objetivo = objetivos.find(function (item) {
                    return String(item.id) === boton.dataset.verObjetivo;
                });

                if (objetivo) {
                    abrirPanel(objetivo, boton);
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


        // Cerrar sin guardar.
        panel.querySelectorAll('[data-cerrar-panel-objetivo]').forEach(function (boton) {

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

                abrirPanel(null, botonRegistrar);
                formularioRecuperado = true;

            } else {

                const objetivo = objetivos.find(function (item) {
                    return String(item.id) === String(anteriores.formulario);
                });

                if (objetivo && (puedeEditar || puedeEstado)) {

                    const boton = contenedor.querySelector(
                        '[data-ver-objetivo="' + objetivo.id + '"]'
                    );

                    abrirPanel(objetivo, boton);
                    cambiarModo('editar');

                    formularioRecuperado = true;

                }

            }

            if (formularioRecuperado) {

                if (!nombre.disabled) {

                    nombre.value = anteriores.nombre ?? '';
                    descripcion.value = anteriores.descripcion ?? '';

                }

                // En creación se conserva la sugerencia actual del servidor.
                if (modoActual === 'editar' && !codigo.disabled) {
                    codigo.value = anteriores.codigo ?? '';
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