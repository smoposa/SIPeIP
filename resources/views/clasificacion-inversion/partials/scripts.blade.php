@php
    $rutasPanel = [
        'macrosector' => 'clasificacion-inversion.macrosectores.panel',
        'sector' => 'clasificacion-inversion.sectores.panel',
        'subsector' => 'clasificacion-inversion.subsectores.panel',
    ];
    $rutaPanel = $rutasPanel[$nivel];
    $parametrosCrear = $esMacrosector ? [] : ($esSector
        ? ['macrosector' => $macrosector->id]
        : ['sector' => $sector->id]);
    $registrosPanel = $registros->map(function ($registro) use ($nivel, $rutaPanel) {
        return [
            'id' => $registro->id,
            'nombre' => $registro->nombre,
            'codigo' => $nivel === 'subsector' ? $registro->codigo : '',
            'nivel_gobierno' => $nivel === 'subsector' ? $registro->nivel_gobierno : 'Nacional',
            'estado' => $registro->estado,
            'url' => route($rutaPanel . '.update', [$nivel => $registro->id]),
        ];
    })->values();
    $configuracionPanel = [
        'nivel' => $nivel,
        'etiqueta' => strtolower($etiqueta),
        'urlCrear' => route($rutaPanel . '.store', $parametrosCrear),
        'crear' => puedeHacer('clasificacion_inversion', 'crear') && $puedeRegistrar,
        'editar' => puedeHacer('clasificacion_inversion', 'editar'),
        'estado' => puedeHacer('clasificacion_inversion', 'estado'),
    ];
    $anterioresPanel = [
        'nivel' => old('_clasificacion_nivel'),
        'formulario' => old('_clasificacion_form'),
        'nombre' => old('nombre'),
        'codigo' => old('codigo'),
        'estado' => old('estado'),
    ];
@endphp

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const contenedor = document.getElementById('gestionClasificacion');
        const panel = document.getElementById('panelClasificacion');
        if (!contenedor || !panel) return;

        const registros = {{ Illuminate\Support\Js::from($registrosPanel) }};
        const config = {{ Illuminate\Support\Js::from($configuracionPanel) }};
        const anteriores = {{ Illuminate\Support\Js::from($anterioresPanel) }};

        const formulario = document.getElementById('formClasificacion');
        const metodo = document.getElementById('metodoClasificacion');
        const origen = document.getElementById('origenClasificacion');
        const titulo = document.getElementById('tituloPanelClasificacion');
        const nombre = document.getElementById('nombreClasificacion');
        const codigo = document.getElementById('codigoClasificacion');
        const nivelGobierno = document.getElementById('nivelGobiernoClasificacion');
        const estado = document.getElementById('estadoClasificacion');
        const inactivo = document.getElementById('inactivoClasificacion');
        const grupoEstado = document.getElementById('grupoEstadoClasificacion');
        const editar = document.getElementById('editarClasificacion');
        const guardar = document.getElementById('guardarClasificacion');
        const cerrar = document.getElementById('cerrarClasificacion');
        const registrar = document.getElementById('registrarClasificacion');
        const errores = document.getElementById('erroresClasificacion');
        let modo = 'ver';
        let ultimoBoton = null;

        function cambiarModo(nuevoModo) {
            modo = nuevoModo;
            const creando = modo === 'crear';
            const editando = modo === 'editar';
            const informacion = creando ? config.crear : editando && config.editar;
            const cambiarEstado = editando && config.estado;

            nombre.disabled = !informacion;
            if (codigo) codigo.disabled = !informacion;
            estado.disabled = !cambiarEstado;
            inactivo.disabled = !cambiarEstado;
            grupoEstado.hidden = creando;
            if (editar) editar.hidden = modo !== 'ver';
            guardar.hidden = modo === 'ver';
            guardar.disabled = !(informacion || cambiarEstado);
            cerrar.textContent = modo === 'ver' ? 'Cerrar' : 'Cancelar';
            titulo.textContent = (creando ? 'Registrar ' : editando ? 'Editar ' : 'Información del ') + config.etiqueta;
        }

        function mostrarPanel(registro, boton) {
            formulario.reset();
            ultimoBoton = boton;
            formulario.action = registro ? registro.url : config.urlCrear;
            metodo.value = registro ? 'PUT' : 'POST';
            origen.value = registro ? String(registro.id) : 'crear';
            nombre.value = registro ? registro.nombre : '';
            if (codigo) codigo.value = registro ? registro.codigo : '';
            if (nivelGobierno) nivelGobierno.value = registro ? registro.nivel_gobierno : 'Nacional';
            estado.checked = !registro || registro.estado === 'Activo';
            if (errores) errores.hidden = true;
            cambiarModo(registro ? 'ver' : 'crear');
            if (!panel.open) panel.showModal();
            if (!registro) nombre.focus();
        }

        contenedor.querySelectorAll('[data-ver-clasificacion]').forEach(function (boton) {
            boton.addEventListener('click', function () {
                const registro = registros.find(item => String(item.id) === boton.dataset.verClasificacion);
                if (registro) mostrarPanel(registro, boton);
            });
        });

        if (registrar) registrar.addEventListener('click', function () {
            if (config.crear) mostrarPanel(null, registrar);
        });

        if (editar) editar.addEventListener('click', function () {
            if (!config.editar && !config.estado) return;
            cambiarModo('editar');
            (config.editar ? nombre : estado).focus();
        });

        formulario.addEventListener('submit', function (evento) {
            if (modo === 'ver' || guardar.disabled) evento.preventDefault();
        });

        panel.querySelectorAll('[data-cerrar-clasificacion]').forEach(function (boton) {
            boton.addEventListener('click', function () { panel.close(); });
        });
        panel.addEventListener('close', function () {
            if (ultimoBoton && ultimoBoton.isConnected) ultimoBoton.focus();
        });

        const buscador = document.getElementById('buscarClasificacion');
        const filtro = document.getElementById('filtroEstadoClasificacion');
        const filas = Array.from(contenedor.querySelectorAll('.fila-clasificacion'));
        const sinResultados = document.getElementById('sinResultadosClasificacion');
        const normalizar = valor => String(valor || '').normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim();

        function filtrar() {
            const texto = normalizar(buscador.value);
            let visibles = 0;
            filas.forEach(function (fila) {
                const coincide = normalizar(fila.dataset.nombre).includes(texto)
                    || normalizar(fila.dataset.codigo).includes(texto);
                const mostrar = coincide && (!filtro.value || fila.dataset.estado === filtro.value);
                fila.hidden = !mostrar;
                if (mostrar) visibles++;
            });
            if (sinResultados) sinResultados.classList.toggle('hidden', visibles > 0 || filas.length === 0);
        }
        buscador.addEventListener('input', filtrar);
        filtro.addEventListener('change', filtrar);
        filtrar();

        // Recuperar los datos y los errores del panel después de la validación.
        if (anteriores.nivel === config.nivel && anteriores.formulario !== null) {
            const creando = anteriores.formulario === 'crear';
            const registro = creando ? null : registros.find(item => String(item.id) === String(anteriores.formulario));
            if ((creando && config.crear) || (registro && (config.editar || config.estado))) {
                mostrarPanel(registro, creando ? registrar : null);
                if (!creando) cambiarModo('editar');
                if (creando || config.editar) {
                    nombre.value = anteriores.nombre ?? '';
                    if (codigo) codigo.value = anteriores.codigo ?? '';
                }
                if (!creando && config.estado && anteriores.estado !== null) {
                    estado.checked = anteriores.estado === 'Activo';
                }
                if (errores) errores.hidden = false;
            }
        }
    });
</script>
