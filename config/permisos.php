<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Permisos por módulo
    |--------------------------------------------------------------------------
    */

    'modulos' => [

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        'dashboard' => [
            'ADMIN_GLOBAL',
            'ADMIN_SISTEMA',
            'ADMIN_INSTITUCIONAL',
            'DIRECTOR_PLANIFICACION',
            'ANALISTA_PLANIFICACION',
            'DIRECTOR_INVERSION',
            'ANALISTA_INVERSION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        /*
        |--------------------------------------------------------------------------
        | Configuración
        |--------------------------------------------------------------------------
        */

        'roles' => [
            'ADMIN_GLOBAL',
            'ADMIN_SISTEMA',
        ],

        'usuarios' => [
            'ADMIN_GLOBAL',
            'ADMIN_SISTEMA',
            'ADMIN_INSTITUCIONAL',
        ],

        'entidades' => [
            'ADMIN_GLOBAL',
            'ADMIN_SISTEMA',
            'ADMIN_INSTITUCIONAL',
        ],

        /*
        |--------------------------------------------------------------------------
        | Planificación
        |--------------------------------------------------------------------------
        */

        'planes' => [
            'ADMIN_SISTEMA',
            'DIRECTOR_PLANIFICACION',
            'ANALISTA_PLANIFICACION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        'objetivos' => [
            'ADMIN_SISTEMA',
            'DIRECTOR_PLANIFICACION',
            'ANALISTA_PLANIFICACION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        'metas' => [
            'ADMIN_SISTEMA',
            'DIRECTOR_PLANIFICACION',
            'ANALISTA_PLANIFICACION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        'indicadores' => [
            'ADMIN_SISTEMA',
            'DIRECTOR_PLANIFICACION',
            'ANALISTA_PLANIFICACION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        /*
        |--------------------------------------------------------------------------
        | Catálogos globales
        |--------------------------------------------------------------------------
        */

        'ods' => [
            'ADMIN_GLOBAL',
            'ADMIN_SISTEMA',
            'ANALISTA_PLANIFICACION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        'pnd' => [
            'ADMIN_GLOBAL',
            'ADMIN_SISTEMA',
            'ANALISTA_PLANIFICACION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        /*
        |--------------------------------------------------------------------------
        | Clasificación de la inversión
        |--------------------------------------------------------------------------
        */

        'clasificacion_inversion' => [
            'ADMIN_GLOBAL',
            'ADMIN_SISTEMA',
            'ADMIN_INSTITUCIONAL',
            'DIRECTOR_PLANIFICACION',
            'ANALISTA_PLANIFICACION',
            'DIRECTOR_INVERSION',
            'ANALISTA_INVERSION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        /*
        |--------------------------------------------------------------------------
        | Inversión pública
        |--------------------------------------------------------------------------
        */

        'programas' => [
            'ADMIN_SISTEMA',
            'DIRECTOR_INVERSION',
            'ANALISTA_INVERSION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        'proyectos' => [
            'ADMIN_SISTEMA',
            'DIRECTOR_INVERSION',
            'ANALISTA_INVERSION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        /*
        |--------------------------------------------------------------------------
        | Seguimiento
        |--------------------------------------------------------------------------
        */

        'avances' => [
            'ADMIN_SISTEMA',
            'DIRECTOR_PLANIFICACION',
            'DIRECTOR_INVERSION',
            'ANALISTA_INVERSION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        'presupuestos' => [
            'ADMIN_SISTEMA',
            'DIRECTOR_PLANIFICACION',
            'DIRECTOR_INVERSION',
            'ANALISTA_INVERSION',
            'AUDITOR_INSTITUCIONAL',
            'CONSULTA_INSTITUCIONAL',
        ],

        /*
        |--------------------------------------------------------------------------
        | Administración
        |--------------------------------------------------------------------------
        */

        'reportes' => [
            'ADMIN_SISTEMA',
            'DIRECTOR_PLANIFICACION',
            'DIRECTOR_INVERSION',
            'ANALISTA_INVERSION',
            'AUDITOR_INSTITUCIONAL',
        ],

        'auditoria' => [
            'ADMIN_SISTEMA',
            'AUDITOR_INSTITUCIONAL',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Permisos por acción
    |--------------------------------------------------------------------------
    */

    'acciones' => [

        /*
        |--------------------------------------------------------------------------
        | Clasificación de la inversión
        |--------------------------------------------------------------------------
        */

        'clasificacion_inversion' => [

            'crear' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

            'editar' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

            'estado' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

        ],

        /*
        |--------------------------------------------------------------------------
        | Programas de inversión pública
        |--------------------------------------------------------------------------
        */

        'programas' => [

            'crear' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'DIRECTOR_INVERSION',
                'ANALISTA_INVERSION',
            ],

            'editar' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'DIRECTOR_INVERSION',
                'ANALISTA_INVERSION',
            ],

            'estado' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'DIRECTOR_INVERSION',
            ],

            'proceso' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'DIRECTOR_INVERSION',
            ],

        ],

        /*
        |--------------------------------------------------------------------------
        | Proyectos de inversión pública
        |--------------------------------------------------------------------------
        */

        'proyectos' => [
            'crear' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'DIRECTOR_INVERSION',
                'ANALISTA_INVERSION',
            ],

            'editar' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'DIRECTOR_INVERSION',
                'ANALISTA_INVERSION',
            ],

            'estado' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'DIRECTOR_INVERSION',
            ],

            'proceso' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'DIRECTOR_INVERSION',
            ],
        ],

        'avances' => [
            'crear' => ['ADMIN_SISTEMA', 'DIRECTOR_INVERSION', 'ANALISTA_INVERSION'],
            'editar' => ['ADMIN_SISTEMA', 'DIRECTOR_INVERSION', 'ANALISTA_INVERSION'],
        ],

        'presupuestos' => [
            'crear' => ['ADMIN_SISTEMA', 'DIRECTOR_INVERSION', 'ANALISTA_INVERSION'],
            'editar' => ['ADMIN_SISTEMA', 'DIRECTOR_INVERSION', 'ANALISTA_INVERSION'],
        ],

        /*
        |--------------------------------------------------------------------------
        | Planes
        |--------------------------------------------------------------------------
        */

        'planes' => [

            'crear' => [
                'ADMIN_SISTEMA',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
            ],

            'editar' => [
                'ADMIN_SISTEMA',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
            ],

            'estado' => [
                'ADMIN_SISTEMA',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
            ],

        ],

        /*
        |--------------------------------------------------------------------------
        | Objetivos estratégicos institucionales
        |--------------------------------------------------------------------------
        */

        'objetivos' => [

            'crear' => [
                'ADMIN_SISTEMA',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
            ],

            'editar' => [
                'ADMIN_SISTEMA',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
            ],

            'estado' => [
                'ADMIN_SISTEMA',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
            ],

        ],

        /*
        |--------------------------------------------------------------------------
        | Indicadores
        |--------------------------------------------------------------------------
        */

        'indicadores' => [

            'crear' => [
                'ADMIN_SISTEMA',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
            ],

            'editar' => [
                'ADMIN_SISTEMA',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
            ],

            'estado' => [
                'ADMIN_SISTEMA',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
            ],

        ],

        /*
        |--------------------------------------------------------------------------
        | Usuarios
        |--------------------------------------------------------------------------
        */

        'usuarios' => [

            'crear' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'ADMIN_INSTITUCIONAL',
            ],

            'editar' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'ADMIN_INSTITUCIONAL',
            ],

            'estado' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'ADMIN_INSTITUCIONAL',
            ],

            'editarRol' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

            'editarEntidad' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

            'editarPassword' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'ADMIN_INSTITUCIONAL',
            ],

        ],

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        'roles' => [

            'crear' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

            'editar' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

            'estado' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

        ],

        /*
        |--------------------------------------------------------------------------
        | Entidades
        |--------------------------------------------------------------------------
        */

        'entidades' => [

            'crear' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

            'editar' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
                'ADMIN_INSTITUCIONAL',
            ],

            'estado' => [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],

        ],

    ],

];
