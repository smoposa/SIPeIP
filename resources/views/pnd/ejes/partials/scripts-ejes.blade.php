@php

    $ejesPanel = $pnd->ejes->map(function ($eje) {
        return [
            'id' => $eje->id,
            'numero' => $eje->numero,
            'nombre' => $eje->nombre,
            'descripcion' => $eje->descripcion,
            'estado' => $eje->estado,
            'url' => route('pnd.ejes.update', ['eje' => $eje->id]),
        ];
    })->values()->all();

    $datosAnterioresEje = [
        'formulario' => old('_eje_form'),
        'numero' => old('numero'),
        'nombre' => old('nombre'),
        'descripcion' => old('descripcion'),
        'estado' => old('estado'),
    ];

@endphp


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const contenedor = document.getElementById('gestionEjesPnd');
        const panel = document.getElementById('panelEjePnd');

        if (!contenedor || !panel) {
            return;
        }


        // Datos y permisos.
        const ejes = {{ Illuminate\Support\Js::from($ejesPanel) }};
        const anteriores = {{ Illuminate\Support\Js::from($datosAnterioresEje) }};

        const puedeCrear = {{ Illuminate\Support\Js::from(puedeHacer('pnd', 'crear')) }};
        const puedeEditar = {{ Illuminate\Support\Js::from(puedeHacer('pnd', 'editar')) }};
        const puedeEstado = {{ Illuminate\Support\Js::from(puedeHacer('pnd', 'estado')) }};

        const urlCrear = {{ Illuminate\Support\Js::from(
            route('pnd.ejes.store', ['pnd' => $pnd->id])
        ) }};


        // Elementos del formulario.
        const formulario = document.getElementById('formularioEjePnd');
        const titulo = document.getElementById('tituloPanelEjePnd');
        const metodo = document.getElementById('metodoEjePnd');
        const origen = document.getElementById('origenEjePnd');
        const errores = document.getElementById('erroresPanelEjePnd');

        const numero = document.getElementById('numeroEjePnd');
        const nombre = document.getElementById('nombreEjePnd');
        const descripcion = document.getElementById('descripcionEjePnd');

        const grupoEstado = document.getElementById('grupoEstadoEjePnd');
        const estado = document.getElementById('estadoEjePnd');
        const estadoInactivo = document.getElementById('estadoEjePndInactivo');

        const botonRegistrar = document.getElementById('registrarEjePnd');
        const botonEditar = document.getElementById('editarPanelEjePnd');
        const botonGuardar = document.getElementById('guardarPanelEjePnd');
        const botonCerrar = document.getElementById('cerrarPanelEjePnd');

        let ejeActual = null;
        let modoActual = 'ver';
        let ultimoBoton = null;


        // Cambiar entre consulta, registro y edición.
        function cambiarModo(modo) {

            if (modo === 'crear' && !puedeCrear) {
                return;
            }

            if (
                modo === 'editar'
                && (!ejeActual || !(puedeEditar || puedeEstado))
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
                ? 'Registrar eje'
                : editando
                    ? 'Editar eje'
                    : 'Información del eje';

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
        function abrirPanel(eje = null, boton = null) {

            if (!eje && !puedeCrear) {
                return;
            }

            ejeActual = eje;
            ultimoBoton = boton;

            formulario.reset();

            formulario.action = eje ? eje.url : urlCrear;
            metodo.value = eje ? 'PUT' : 'POST';
            origen.value = eje ? String(eje.id) : 'crear';

            numero.value = eje?.numero ?? '';
            nombre.value = eje?.nombre ?? '';
            descripcion.value = eje?.descripcion ?? '';
            estado.checked = eje ? eje.estado === 'Activo' : true;

            if (errores) {
                errores.hidden = true;
            }

            cambiarModo(eje ? 'ver' : 'crear');

            if (!panel.open) {
                panel.showModal();
            }

            if (!eje) {
                numero.focus();
            }

        }


        // Registrar un nuevo eje.
        if (botonRegistrar) {

            botonRegistrar.addEventListener('click', function () {
                abrirPanel(null, botonRegistrar);
            });

        }


        // Consultar un eje.
        contenedor.querySelectorAll('[data-ver-eje-pnd]').forEach(function (boton) {

            boton.addEventListener('click', function () {

                const eje = ejes.find(function (item) {
                    return String(item.id) === boton.dataset.verEjePnd;
                });

                if (eje) {
                    abrirPanel(eje, boton);
                }

            });

        });


        // Habilitar edición.
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


        // Evitar envíos desde el modo lectura.
        formulario.addEventListener('submit', function (evento) {

            if (modoActual === 'ver') {
                evento.preventDefault();
            }

        });


        // Cerrar sin guardar.
        panel.querySelectorAll('[data-cerrar-panel-eje-pnd]').forEach(function (boton) {

            boton.addEventListener('click', function () {
                panel.close();
            });

        });


        panel.addEventListener('close', function () {

            if (ultimoBoton && ultimoBoton.isConnected) {
                ultimoBoton.focus();
            }

        });


        // Recuperar datos después de un error de validación.
        if (anteriores.formulario !== null) {

            const creando = anteriores.formulario === 'crear';

            const eje = creando
                ? null
                : ejes.find(function (item) {
                    return String(item.id) === String(anteriores.formulario);
                });

            const puedeRecuperar = creando
                ? puedeCrear
                : Boolean(eje) && (puedeEditar || puedeEstado);

            if (puedeRecuperar) {

                const boton = creando
                    ? botonRegistrar
                    : contenedor.querySelector(
                        '[data-ver-eje-pnd="' + eje.id + '"]'
                    );

                abrirPanel(eje, boton);

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


        // Buscador y filtro.
        const buscador = document.getElementById('buscarEjePnd');
        const filtro = document.getElementById('filtroEstadoEjePnd');
        const filas = contenedor.querySelectorAll('.fila-eje-pnd');
        const sinResultados = document.getElementById('sinResultadosEjePnd');

        function filtrarEjes() {

            const texto = buscador.value.toLowerCase().trim();
            const estadoSeleccionado = filtro.value;

            let visibles = 0;

            filas.forEach(function (fila) {

                const numeroEje = (fila.dataset.numero || '').toLowerCase();
                const nombreEje = (fila.dataset.nombre || '').toLowerCase();

                const coincideTexto =
                    numeroEje.includes(texto) ||
                    nombreEje.includes(texto);

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

        buscador.addEventListener('input', filtrarEjes);
        filtro.addEventListener('change', filtrarEjes);

        filtrarEjes();

    });
</script>