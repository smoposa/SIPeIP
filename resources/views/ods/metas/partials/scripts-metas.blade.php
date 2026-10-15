@php

    $metasPanel = $ods->metas->map(function ($meta) use ($ods) {
        return [
            'id' => $meta->id,
            'codigo' => $meta->codigo,
            'nombre' => $meta->nombre,
            'descripcion' => $meta->descripcion,
            'estado' => $meta->estado,
            'url' => route('ods.metas.update', [
                'ods' => $ods->id,
                'meta' => $meta->id,
            ]),
        ];
    })->values()->all();

    $datosAnteriores = [
        'formulario' => old('_meta_form'),
        'codigo' => old('codigo'),
        'nombre' => old('nombre'),
        'descripcion' => old('descripcion'),
        'estado' => old('estado'),
    ];

@endphp


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const contenedor = document.getElementById('gestionMetas');
        const panel = document.getElementById('panelMeta');

        if (!contenedor || !panel) {
            return;
        }

        const formulario = document.getElementById('formularioMeta');
        const titulo = document.getElementById('tituloPanelMeta');
        const metodo = document.getElementById('metodoMeta');
        const origen = document.getElementById('origenMeta');
        const errores = document.getElementById('erroresPanelMeta');

        const codigo = document.getElementById('codigoMeta');
        const nombre = document.getElementById('nombreMeta');
        const descripcion = document.getElementById('descripcionMeta');
        const estado = document.getElementById('estadoMeta');
        const estadoInactivo = document.getElementById('estadoMetaInactivo');

        const botonEditar = document.getElementById('editarPanelMeta');
        const botonGuardar = document.getElementById('guardarPanelMeta');
        const botonCerrar = document.getElementById('cerrarPanelMeta');
        const registrar = document.getElementById('registrarMeta');

        const metas = {{ Illuminate\Support\Js::from($metasPanel) }};
        const anteriores = {{ Illuminate\Support\Js::from($datosAnteriores) }};

        const puedeCrear = {{ Illuminate\Support\Js::from(puedeHacer('ods', 'crear')) }};
        const puedeEditar = {{ Illuminate\Support\Js::from(puedeHacer('ods', 'editar')) }};
        const puedeEstado = {{ Illuminate\Support\Js::from(puedeHacer('ods', 'estado')) }};

        const urlCrear = {{ Illuminate\Support\Js::from(route('ods.metas.store', ['ods' => $ods->id])) }};

        let ultimoBoton = null;
        let metaActual = null;
        let modoActual = 'ver';

        function cambiarModo(modo) {

            if (modo === 'crear' && !puedeCrear) {
                return;
            }

            if (
                modo === 'editar'
                && (!metaActual || (!puedeEditar && !puedeEstado))
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
                titulo.textContent = 'Registrar meta';
            } else if (editando) {
                titulo.textContent = 'Editar meta';
            } else {
                titulo.textContent = 'Información de la meta';
            }

            codigo.disabled = !editarCampos;
            nombre.disabled = !editarCampos;
            descripcion.disabled = !editarCampos;

            estado.disabled = !modificando || !puedeEstado;
            estadoInactivo.disabled = !modificando || !puedeEstado;

            if (botonEditar) {
                botonEditar.hidden = modificando;
            }

            botonGuardar.hidden = !modificando;
            botonGuardar.disabled = !modificando;

            botonCerrar.textContent = modificando ? 'Cancelar' : 'Cerrar';

        }

        function abrirPanel(meta = null, boton = null) {

            if (meta === null && !puedeCrear) {
                return;
            }

            ultimoBoton = boton;
            metaActual = meta;

            formulario.reset();

            const creando = metaActual === null;

            formulario.action = creando ? urlCrear : metaActual.url;
            metodo.value = creando ? 'POST' : 'PUT';
            origen.value = creando ? 'crear' : String(metaActual.id);

            codigo.value = metaActual?.codigo ?? '';
            nombre.value = metaActual?.nombre ?? '';
            descripcion.value = metaActual?.descripcion ?? '';
            estado.checked = (metaActual?.estado ?? 'Activo') === 'Activo';

            if (errores) {
                errores.hidden = true;
            }

            // Las metas existentes siempre abren en modo lectura.
            cambiarModo(creando ? 'crear' : 'ver');

            if (!panel.open) {
                panel.showModal();
            }

        }


        // Abrir el detalle en modo lectura.
        contenedor.querySelectorAll('[data-ver-meta]').forEach(function (boton) {

            boton.addEventListener('click', function () {

                const meta = metas.find(function (item) {
                    return String(item.id) === boton.dataset.verMeta;
                });

                if (meta) {
                    abrirPanel(meta, boton);
                }

            });

        });


        // Abrir el formulario para registrar una meta.
        if (registrar) {

            registrar.addEventListener('click', function () {
                abrirPanel(null, registrar);
            });

        }


        // Habilitar la edición desde el panel.
        if (botonEditar) {

            botonEditar.addEventListener('click', function () {

                cambiarModo('editar');

                if (modoActual !== 'editar') {
                    return;
                }

                if (puedeEditar) {
                    codigo.focus();
                } else if (puedeEstado) {
                    estado.focus();
                }

            });

        }


        // Impedir el envío mientras se consulta la información.
        formulario.addEventListener('submit', function (evento) {

            const puedeEnviar =
                (modoActual === 'crear' && puedeCrear) ||
                (modoActual === 'editar' && (puedeEditar || puedeEstado));

            if (!puedeEnviar) {
                evento.preventDefault();
            }

        });


        // Cerrar sin guardar.
        panel.querySelectorAll('[data-cerrar-panel-meta]').forEach(function (boton) {

            boton.addEventListener('click', function () {
                panel.close();
            });

        });


        // Devolver el foco al botón que abrió el panel.
        panel.addEventListener('close', function () {

            if (ultimoBoton && ultimoBoton.isConnected) {
                ultimoBoton.focus();
            }

        });


        // Recuperar el formulario tras un error de validación.
        if (anteriores.formulario !== null) {

            let formularioRecuperado = false;

            if (anteriores.formulario === 'crear' && puedeCrear) {

                abrirPanel(null, registrar);
                formularioRecuperado = true;

            } else {

                const meta = metas.find(function (item) {
                    return String(item.id) === String(anteriores.formulario);
                });

                if (meta && (puedeEditar || puedeEstado)) {

                    const boton = contenedor.querySelector(
                        '[data-ver-meta="' + meta.id + '"]'
                    );

                    abrirPanel(meta, boton);
                    cambiarModo('editar');

                    formularioRecuperado = true;

                }

            }

            if (formularioRecuperado) {

                if (!codigo.disabled) {

                    codigo.value = anteriores.codigo ?? '';
                    nombre.value = anteriores.nombre ?? '';
                    descripcion.value = anteriores.descripcion ?? '';

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