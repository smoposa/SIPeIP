@php
    $politicasPanel = $objetivo->politicas->map(function ($politica) use ($objetivo) {
        return [
            'id' => $politica->id,
            'identificador' => $politica->codigo,
            'nombre' => $politica->nombre,
            'estado' => $politica->estado,
            'padre' => $objetivo->id,
            'referencia' => 'Objetivo Nacional ' . $objetivo->numero . ' · ' . $objetivo->nombre,
            'url' => route('pnd.politicas.update', ['objetivo' => $objetivo->id, 'politica' => $politica->id]),
            'urlEstrategia' => route('pnd.estrategias.store', ['objetivo' => $objetivo->id, 'politica' => $politica->id]),
        ];
    })->values()->all();

    $estrategiasPanel = $objetivo->politicas->flatMap(function ($politica) use ($objetivo) {
        return $politica->estrategias->map(function ($estrategia) use ($politica, $objetivo) {
            return [
                'id' => $estrategia->id,
                'identificador' => $estrategia->codigo,
                'descripcion' => $estrategia->descripcion,
                'estado' => $estrategia->estado,
                'padre' => $politica->id,
                'referencia' => 'Política ' . $politica->codigo . ' · ' . $politica->nombre,
                'url' => route('pnd.estrategias.update', [
                    'objetivo' => $objetivo->id,
                    'politica' => $politica->id,
                    'estrategia' => $estrategia->id,
                ]),
            ];
        });
    })->values()->all();

    $metasPanel = $objetivo->metas->map(function ($meta) use ($objetivo) {
        return [
            'id' => $meta->id,
            'identificador' => $meta->numero,
            'descripcion' => $meta->descripcion,
            'estado' => $meta->estado,
            'padre' => $objetivo->id,
            'referencia' => 'Objetivo Nacional ' . $objetivo->numero . ' · ' . $objetivo->nombre,
            'url' => route('pnd.metas.update', ['objetivo' => $objetivo->id, 'meta' => $meta->id]),
        ];
    })->values()->all();

    $contextoPanelPnd = [
        'objetivo' => $objetivo->id,
        'referencia' => 'Objetivo Nacional ' . $objetivo->numero . ' · ' . $objetivo->nombre,
        'crearPolitica' => route('pnd.politicas.store', ['objetivo' => $objetivo->id]),
        'crearMeta' => route('pnd.metas.store', ['objetivo' => $objetivo->id]),
        'crear' => puedeHacer('pnd', 'crear'),
        'editar' => puedeHacer('pnd', 'editar'),
        'estado' => puedeHacer('pnd', 'estado'),
    ];

    $anterioresPanelPnd = [
        'tipo' => old('_pnd_tipo'),
        'registro' => old('_pnd_registro'),
        'padre' => old('_pnd_padre'),
        'codigo' => old('codigo'),
        'numero' => old('numero'),
        'nombre' => old('nombre'),
        'descripcion' => old('descripcion'),
        'estado' => old('estado'),
    ];
@endphp

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const panel = document.getElementById('panelRegistroPnd');
        const contenedor = document.getElementById('detalleObjetivoPnd');
        if (!panel || !contenedor) return;

        const contexto = {{ Illuminate\Support\Js::from($contextoPanelPnd) }};
        const anteriores = {{ Illuminate\Support\Js::from($anterioresPanelPnd) }};
        const datos = {
            politica: {{ Illuminate\Support\Js::from($politicasPanel) }},
            estrategia: {{ Illuminate\Support\Js::from($estrategiasPanel) }},
            meta: {{ Illuminate\Support\Js::from($metasPanel) }},
        };

        const formulario = document.getElementById('formRegistroPnd');
        const titulo = document.getElementById('tituloPanelRegistroPnd');
        const referencia = document.getElementById('referenciaRegistroPnd');
        const metodo = document.getElementById('metodoRegistroPnd');
        const tipoInput = document.getElementById('tipoRegistroPnd');
        const idInput = document.getElementById('idRegistroPnd');
        const padreInput = document.getElementById('padreRegistroPnd');
        const identificador = document.getElementById('identificadorRegistroPnd');
        const etiquetaIdentificador = document.getElementById('etiquetaIdentificadorPnd');
        const nombre = document.getElementById('nombreRegistroPnd');
        const descripcion = document.getElementById('descripcionRegistroPnd');
        const grupoNombre = document.getElementById('grupoNombreRegistroPnd');
        const grupoDescripcion = document.getElementById('grupoDescripcionRegistroPnd');
        const grupoEstado = document.getElementById('grupoEstadoRegistroPnd');
        const estado = document.getElementById('estadoRegistroPnd');
        const inactivo = document.getElementById('inactivoRegistroPnd');
        const etiquetaEstado = document.getElementById('etiquetaEstadoRegistroPnd');
        const editar = document.getElementById('editarRegistroPnd');
        const guardar = document.getElementById('guardarRegistroPnd');
        const cerrar = document.getElementById('cerrarRegistroPnd');
        const errores = document.getElementById('erroresRegistroPnd');

        let tipoActual = null;
        let registroActual = null;
        let modoActual = 'ver';
        let ultimoBoton = null;

        function cambiarModo(modo) {
            if (modo === 'crear' && !contexto.crear) return;
            if (modo === 'editar' && (!registroActual || !(contexto.editar || contexto.estado))) return;

            modoActual = modo;
            const creando = modo === 'crear';
            const editando = modo === 'editar';
            const modificando = creando || editando;
            const informacion = creando ? contexto.crear : editando && contexto.editar;
            const esPolitica = tipoActual === 'politica';
            const etiquetas = { politica: 'política', estrategia: 'estrategia', meta: 'meta' };

            titulo.textContent = (creando ? 'Registrar ' : editando ? 'Editar ' : 'Información de la ') + etiquetas[tipoActual];
            identificador.disabled = !informacion;
            nombre.disabled = !informacion || !esPolitica;
            descripcion.disabled = !informacion || esPolitica;
            grupoNombre.hidden = !esPolitica;
            grupoDescripcion.hidden = esPolitica;
            grupoEstado.hidden = creando;
            estado.disabled = !editando || !contexto.estado;
            inactivo.disabled = !editando || !contexto.estado;
            if (editar) editar.hidden = modificando;
            guardar.hidden = !modificando;
            guardar.disabled = !modificando;
            cerrar.textContent = modificando ? 'Cancelar' : 'Cerrar';
        }

        function abrir(tipo, registro = null, politicaId = null, boton = null) {
            if (!Object.hasOwn(datos, tipo)) return;
            if (!registro && !contexto.crear) return;

            const politica = tipo === 'estrategia'
                ? datos.politica.find(item => String(item.id) === String(politicaId ?? registro?.padre))
                : null;
            if (tipo === 'estrategia' && !politica) return;

            tipoActual = tipo;
            registroActual = registro;
            ultimoBoton = boton;
            formulario.reset();
            if (errores) errores.hidden = true;

            formulario.action = registro?.url || (tipo === 'politica'
                ? contexto.crearPolitica
                : tipo === 'meta' ? contexto.crearMeta : politica.urlEstrategia);
            metodo.value = registro ? 'PUT' : 'POST';
            tipoInput.value = tipo;
            idInput.value = registro ? String(registro.id) : 'crear';
            padreInput.value = String(registro?.padre ?? (politica ? politica.id : contexto.objetivo));
            referencia.textContent = registro?.referencia || (politica
                ? 'Política ' + politica.identificador + ' · ' + politica.nombre
                : contexto.referencia);

            const esMeta = tipo === 'meta';
            identificador.type = esMeta ? 'number' : 'text';
            identificador.name = esMeta ? 'numero' : 'codigo';
            etiquetaIdentificador.textContent = esMeta ? 'Número' : 'Código';
            if (esMeta) {
                identificador.min = '1';
                identificador.step = '1';
                identificador.removeAttribute('maxlength');
            } else {
                identificador.removeAttribute('min');
                identificador.removeAttribute('step');
                identificador.maxLength = 20;
            }
            identificador.value = registro?.identificador ?? '';
            nombre.value = registro?.nombre ?? '';
            descripcion.value = registro?.descripcion ?? '';
            estado.checked = registro ? registro.estado === 'Activo' : true;
            etiquetaEstado.textContent = tipo === 'politica' ? 'Política habilitada'
                : tipo === 'estrategia' ? 'Estrategia habilitada' : 'Meta habilitada';

            cambiarModo(registro ? 'ver' : 'crear');
            if (!panel.open) panel.showModal();
            if (!registro) identificador.focus();
        }

        const registrarPolitica = document.getElementById('registrarPoliticaPnd');
        const registrarMeta = document.getElementById('registrarMetaPnd');
        registrarPolitica?.addEventListener('click', () => abrir('politica', null, null, registrarPolitica));
        registrarMeta?.addEventListener('click', () => abrir('meta', null, null, registrarMeta));

        contenedor.querySelectorAll('[data-crear-estrategia]').forEach(function (boton) {
            boton.addEventListener('click', () => abrir('estrategia', null, boton.dataset.crearEstrategia, boton));
        });

        contenedor.querySelectorAll('[data-detalle-pnd]').forEach(function (boton) {
            boton.addEventListener('click', function () {
                const tipo = boton.dataset.detallePnd;
                const registro = datos[tipo]?.find(item => String(item.id) === boton.dataset.registro);
                if (registro) abrir(tipo, registro, null, boton);
            });
        });

        editar?.addEventListener('click', function () {
            cambiarModo('editar');
            if (contexto.editar) identificador.focus();
            else if (contexto.estado) estado.focus();
        });

        formulario.addEventListener('submit', function (evento) {
            if (modoActual === 'ver') evento.preventDefault();
        });
        panel.querySelectorAll('[data-cerrar-registro-pnd]').forEach(boton => {
            boton.addEventListener('click', () => panel.close());
        });
        panel.addEventListener('close', function () {
            if (ultimoBoton?.isConnected) ultimoBoton.focus();
        });

        // Recuperar la pestaña, el padre y los campos después de una validación fallida.
        if (Object.hasOwn(datos, anteriores.tipo)) {
            const creando = anteriores.registro === 'crear';
            const registro = creando ? null : datos[anteriores.tipo].find(item =>
                String(item.id) === String(anteriores.registro)
                && String(item.padre) === String(anteriores.padre)
            );
            const padreValido = anteriores.tipo === 'estrategia'
                ? datos.politica.some(item => String(item.id) === String(anteriores.padre))
                : String(anteriores.padre) === String(contexto.objetivo);
            const autorizado = creando ? contexto.crear : registro && (contexto.editar || contexto.estado);

            if (padreValido && autorizado) {
                const tab = document.getElementById(anteriores.tipo === 'meta' ? 'tabMetasPnd' : 'tabPoliticasPnd');
                tab?.click();
                const boton = creando
                    ? anteriores.tipo === 'politica' ? registrarPolitica
                        : anteriores.tipo === 'meta' ? registrarMeta
                        : contenedor.querySelector('[data-crear-estrategia="' + anteriores.padre + '"]')
                    : contenedor.querySelector('[data-detalle-pnd="' + anteriores.tipo + '"][data-registro="' + registro.id + '"]');

                if (anteriores.tipo === 'estrategia') {
                    const detalle = document.getElementById('politica-' + anteriores.padre);
                    if (detalle) detalle.open = true;
                }
                abrir(anteriores.tipo, registro, anteriores.padre, boton);
                if (!creando) cambiarModo('editar');
                if (creando || contexto.editar) {
                    identificador.value = (anteriores.tipo === 'meta' ? anteriores.numero : anteriores.codigo) ?? '';
                    nombre.value = anteriores.nombre ?? '';
                    descripcion.value = anteriores.descripcion ?? '';
                }
                if (!creando && contexto.estado && anteriores.estado !== null) {
                    estado.checked = anteriores.estado === 'Activo';
                }
                if (errores) errores.hidden = false;
            }
        }
    });
</script>
