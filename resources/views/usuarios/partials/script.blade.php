@php
    $panelesUsuario = [
        [
            'nombre' => 'informacion',
            'panel' => 'panelEditarUsuario',
            'formulario' => 'formularioEditarUsuario',
            'cerrar' => '[data-cerrar-panel-usuario]',
            'origen' => '_usuario_form',
            'url' => route('usuarios.edit', $usuario->id),
        ],
        [
            'nombre' => 'estado',
            'panel' => 'panelEstadoUsuario',
            'formulario' => 'formularioEstadoUsuario',
            'cerrar' => '[data-cerrar-panel-estado-usuario]',
            'origen' => '_usuario_estado_form',
            'url' => route('usuarios.estado', $usuario->id),
        ],
        [
            'nombre' => 'rol',
            'panel' => 'panelRolUsuario',
            'formulario' => 'formularioRolUsuario',
            'cerrar' => '[data-cerrar-panel-rol-usuario]',
            'origen' => '_usuario_rol_form',
            'url' => route('usuarios.editroles', $usuario->id),
        ],
        [
            'nombre' => 'entidad',
            'panel' => 'panelEntidadUsuario',
            'formulario' => 'formularioEntidadUsuario',
            'cerrar' => '[data-cerrar-panel-entidad-usuario]',
            'origen' => '_usuario_entidad_form',
            'url' => route('usuarios.editentidad', $usuario->id),
        ],
        [
            'nombre' => 'password',
            'panel' => 'panelPasswordUsuario',
            'formulario' => 'formularioPasswordUsuario',
            'cerrar' => '[data-cerrar-panel-password-usuario]',
            'origen' => '_usuario_password_form',
            'url' => route('usuarios.editpassword', $usuario->id),
        ],
    ];

    $panelInicialUsuario = null;

    foreach ($panelesUsuario as $configuracionPanel) {
        if (
            (string) old($configuracionPanel['origen'], '')
            === (string) $usuario->id
        ) {
            $panelInicialUsuario = $configuracionPanel['nombre'];
            break;
        }
    }

    $panelInicialUsuario ??= session('abrir_panel_usuario');
@endphp


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const configuraciones = {{
            Illuminate\Support\Js::from($panelesUsuario)
        }};

        const panelInicial = {{
            Illuminate\Support\Js::from($panelInicialUsuario)
        }};

        configuraciones.forEach(function (opciones) {

            const panel = document.getElementById(opciones.panel);
            const formulario = document.getElementById(opciones.formulario);

            if (!panel || !formulario) {
                return;
            }

            const rutaEdicion = new URL(
                opciones.url,
                window.location.origin
            ).pathname;

            const enlacesAbrir = Array.from(
                document.querySelectorAll('a[href]')
            ).filter(function (enlace) {

                const destino = new URL(
                    enlace.href,
                    window.location.origin
                );

                return destino.origin === window.location.origin
                    && destino.pathname === rutaEdicion;

            });

            let ultimoEnlace = null;


            // Abrir el panel y enfocar el primer campo.
            function abrirPanel(enlace = null) {

                ultimoEnlace = enlace;

                if (!panel.open) {
                    panel.showModal();
                }

                const primerCampo = formulario.querySelector(
                    'input:not([type="hidden"]):not([disabled]), select:not([disabled]), textarea:not([disabled])'
                );

                primerCampo?.focus();

                panel.querySelector('[role="alert"]')?.scrollIntoView({
                    block: 'nearest'
                });

            }


            // Abrir desde los enlaces existentes.
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


            // Restablecer campos y borrar las contraseñas ingresadas.
            panel.addEventListener('close', function () {

                formulario.reset();

                formulario.querySelectorAll(
                    'input[type="password"]'
                ).forEach(function (campo) {
                    campo.value = '';
                });

                if (ultimoEnlace && ultimoEnlace.isConnected) {
                    ultimoEnlace.focus();
                }

            });


            // Abrir después de una redirección o validación fallida.
            if (panelInicial === opciones.nombre) {
                abrirPanel(enlacesAbrir[0] ?? null);
            }

        });

    });
</script>


<style>
    #panelEditarUsuario::backdrop,
    #panelEstadoUsuario::backdrop,
    #panelRolUsuario::backdrop,
    #panelEntidadUsuario::backdrop,
    #panelPasswordUsuario::backdrop {
        background: rgb(0 0 0 / 20%);
    }
</style>