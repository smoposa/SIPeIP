@php

    $objetivosPanelPnd = $eje->objetivos->map(function ($objetivo) {
        return [
            'id' => $objetivo->id,
            'numero' => $objetivo->numero,
            'nombre' => $objetivo->nombre,
            'descripcion' => $objetivo->descripcion,
            'estado' => $objetivo->estado,
            'url' => route('pnd.objetivos.update', [
                'objetivo' => $objetivo->id,
            ]),
        ];
    })->values()->all();

    $anterioresObjetivoPnd = [
        'formulario' => old('_objetivo_pnd_form'),
        'numero' => old('numero'),
        'nombre' => old('nombre'),
        'descripcion' => old('descripcion'),
        'estado' => old('estado'),
    ];

@endphp


<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Buscador y filtro.
        const buscador = document.getElementById('buscarObjetivoPnd');
        const filtro = document.getElementById('filtroEstadoObjetivoPnd');
        const filas = document.querySelectorAll('.fila-objetivo-pnd');
        const sinResultados = document.getElementById('sinResultadosObjetivoPnd');


        function filtrarObjetivos() {

            const texto = buscador.value.toLowerCase().trim();
            const estadoSeleccionado = filtro.value;

            let visibles = 0;

            filas.forEach(function (fila) {

                const numero = (fila.dataset.numero || '').toLowerCase();
                const nombre = (fila.dataset.nombre || '').toLowerCase();

                const coincideTexto =
                    numero.includes(texto) ||
                    nombre.includes(texto);

                const coincideEstado =
                    estadoSeleccionado === '' ||
                    fila.dataset.estado === estadoSeleccionado;

                const mostrar = coincideTexto && coincideEstado;

                fila.style.display = mostrar ? '' : 'none';

                if (mostrar) {
                    visibles++;
                }

            });

            if (sinResultados) {

                sinResultados.classList.toggle(
                    'hidden',
                    visibles > 0 || filas.length === 0
                );

            }

        }


        if (buscador && filtro) {

            buscador.addEventListener('input', filtrarObjetivos);
            filtro.addEventListener('change', filtrarObjetivos);

            filtrarObjetivos();

        }


        // Contenedor y panel.
        const contenedor = document.getElementById('gestionObjetivosPnd');
        const panel = document.getElementById('panelObjetivoPnd');

        if (!contenedor || !panel) {
            return;
        }


        // Datos y permisos.
        const objetivos = {{ Illuminate\Support\Js::from($objetivosPanelPnd) }};
        const anteriores = {{ Illuminate\Support\Js::from($anterioresObjetivoPnd) }};

        const puedeCrear = {{ Illuminate\Support\Js::from(puedeHacer('pnd', 'crear')) }};
        const puedeEditar = {{ Illuminate\Support\Js::from(puedeHacer('pnd', 'editar')) }};
        const puedeEstado = {{ Illuminate\Support\Js::from(puedeHacer('pnd', 'estado')) }};

        const urlCrear = {{ Illuminate\Support\Js::from(
            route('pnd.objetivos.store', ['eje' => $eje->id])
        ) }};


        // Formulario.
        const formulario = document.getElementById('formularioObjetivoPnd');
        const titulo = document.getElementById('tituloPanelObjetivoPnd');
        const metodo = document.getElementById('metodoObjetivoPnd');
        const origen = document.getElementById('origenObjetivoPnd');
        const errores = document.getElementById('erroresPanelObjetivoPnd');


        // Campos.
        const numero = document.getElementById('numeroObjetivoPnd');
        const nombre = document.getElementById('nombreObjetivoPnd');
        const descripcion = document.getElementById('descripcionObjetivoPnd');

        const grupoEstado = document.getElementById('grupoEstadoObjetivoPnd');
        const estado = document.getElementById('estadoObjetivoPnd');
        const estadoInactivo = document.getElementById('estadoObjetivoPndInactivo');


        // Botones.
        const botonRegistrar = document.getElementById('registrarObjetivoPnd');
        const botonEditar = document.getElementById('editarPanelObjetivoPnd');
        const botonGuardar = document.getElementById('guardarPanelObjetivoPnd');
        const botonCerrar = document.getElementById('cerrarPanelObjetivoPnd');

        let objetivoActual = null;
        let modoActual = 'ver';
        let ultimoBoton = null;


        // Cambiar entre consulta, registro y edición.
        function cambiarModo(modo) {

            if (modo === 'crear' && !puedeCrear) {
                return;
            }

            if (
                modo === 'editar'
                && (!objetivoActual || !(puedeEditar || puedeEstado))
            ) {
                return;
            }

            modoActual = modo;

            const creando = modo === 'crear';
            const editando = modo === 'editar';
            const modificando = creando || editando;

            const editarInformacion =
                (creando && puedeCrear) ||
                (editando && puedeEditar);

            titulo.textContent = creando
                ? 'Registrar objetivo'
                : editando
                    ? 'Editar objetivo'
                    : 'Información del objetivo';

            numero.disabled = !editarInformacion;
            nombre.disabled = !editarInformacion;
            descripcion.disabled = !editarInformacion;

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


        // Abrir el panel.
        function abrirPanel(objetivo = null, boton = null) {

            if (!objetivo && !puedeCrear) {
                return;
            }

            objetivoActual = objetivo;
            ultimoBoton = boton;

            formulario.reset();

            formulario.action = objetivo ? objetivo.url : urlCrear;
            metodo.value = objetivo ? 'PUT' : 'POST';
            origen.value = objetivo ? String(objetivo.id) : 'crear';

            numero.value = objetivo?.numero ?? '';
            nombre.value = objetivo?.nombre ?? '';
            descripcion.value = objetivo?.descripcion ?? '';

            estado.checked = objetivo
                ? objetivo.estado === 'Activo'
                : true;

            if (errores) {
                errores.hidden = true;
            }

            cambiarModo(objetivo ? 'ver' : 'crear');

            if (!panel.open) {
                panel.showModal();
            }

            if (!objetivo) {
                numero.focus();
            }

        }


        // Registrar objetivo.
        if (botonRegistrar) {

            botonRegistrar.addEventListener('click', function () {
                abrirPanel(null, botonRegistrar);
            });

        }


        // Consultar detalle en modo lectura.
        contenedor.querySelectorAll('[data-ver-objetivo-pnd]').forEach(function (boton) {

            boton.addEventListener('click', function () {

                const objetivo = objetivos.find(function (item) {
                    return String(item.id) === boton.dataset.verObjetivoPnd;
                });

                if (objetivo) {
                    abrirPanel(objetivo, boton);
                }

            });

        });


        // Habilitar edición según permisos.
        if (botonEditar) {

            botonEditar.addEventListener('click', function () {

                cambiarModo('editar');

                if (puedeEditar) {
                    nombre.focus();
                } else if (puedeEstado) {
                    estado.focus();
                }

            });

        }


        // Impedir el envío en modo lectura.
        formulario.addEventListener('submit', function (evento) {

            if (modoActual === 'ver') {
                evento.preventDefault();
            }

        });


        // Cerrar sin guardar.
        panel.querySelectorAll('[data-cerrar-panel-objetivo-pnd]').forEach(function (boton) {

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


        // Recuperar el formulario tras errores de validación.
        if (anteriores.formulario !== null) {

            const creando = anteriores.formulario === 'crear';

            const objetivo = creando
                ? null
                : objetivos.find(function (item) {
                    return String(item.id) === String(anteriores.formulario);
                });

            const puedeRecuperar = creando
                ? puedeCrear
                : Boolean(objetivo) && (puedeEditar || puedeEstado);

            if (puedeRecuperar) {

                const boton = creando
                    ? botonRegistrar
                    : contenedor.querySelector(
                        '[data-ver-objetivo-pnd="' + objetivo.id + '"]'
                    );

                abrirPanel(objetivo, boton);

                if (!creando) {
                    cambiarModo('editar');
                }

                if (creando || puedeEditar) {

                    numero.value = anteriores.numero ?? '';
                    nombre.value = anteriores.nombre ?? '';
                    descripcion.value = anteriores.descripcion ?? '';

                }

                if (!creando && puedeEstado && anteriores.estado !== null) {
                    estado.checked = anteriores.estado === 'Activo';
                }

                if (errores) {
                    errores.hidden = false;
                }

            }

        }

    });
</script>