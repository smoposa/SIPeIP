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
            'Administrador del Sistema',
            'Administrador Institucional',
            'Director de Planificación',
            'Analista de Planificación',
            'Director de Inversión Pública',
            'Analista de Inversión Pública',
            'Auditor Institucional',
            'Consulta Institucional',
        ],

        /*
        |--------------------------------------------------------------------------
        | Configuración
        |--------------------------------------------------------------------------
        */

        'roles' => [
            'Administrador del Sistema',
            'Administrador Institucional',
        ],

        'usuarios' => [
            'Administrador del Sistema',
            'Administrador Institucional',
        ],

        'entidades' => [
            'Administrador del Sistema',
            'Administrador Institucional',
        ],

        /*
        |--------------------------------------------------------------------------
        | Planificación
        |--------------------------------------------------------------------------
        */

        'planes' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            'Director de Planificación',
            'Analista de Planificación',
            'Auditor Institucional',
            'Consulta Institucional',
        ],

        'objetivos' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            'Director de Planificación',
            'Analista de Planificación',
            'Auditor Institucional',
            'Consulta Institucional',
        ],

        'metas' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            'Director de Planificación',
            'Analista de Planificación',
            'Auditor Institucional',
            'Consulta Institucional',
        ],

        'indicadores' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            'Director de Planificación',
            'Analista de Planificación',
            'Auditor Institucional',
            'Consulta Institucional',
        ],


        /*
        |--------------------------------------------------------------------------
        | Catálogos
        |--------------------------------------------------------------------------
        */

        'ods' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            //'Director de Planificación',
            'Analista de Planificación',
            'Auditor Institucional',
            'Consulta Institucional',
        ],

        'pnd' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            //'Director de Planificación',
            'Analista de Planificación',
            'Auditor Institucional',
            'Consulta Institucional',
        ],



        /*
        |--------------------------------------------------------------------------
        | Inversión Pública
        |--------------------------------------------------------------------------
        */

        'proyectos' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            'Director de Inversión Pública',
            'Analista de Inversión Pública',
            'Auditor Institucional',
            'Consulta Institucional',
        ],

        'presupuesto' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            'Director de Inversión Pública',
            'Analista de Inversión Pública',
            'Auditor Institucional',
            'Consulta Institucional',
        ],

        /*
        |--------------------------------------------------------------------------
        | Seguimiento
        |--------------------------------------------------------------------------
        */

        'seguimiento' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            'Director de Planificación',
            'Director de Inversión Pública',
            'Analista de Planificación',
            'Analista de Inversión Pública',
            'Auditor Institucional',
            'Consulta Institucional',
        ],

        'evaluacion' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            'Director de Planificación',
            'Director de Inversión Pública',
            'Analista de Planificación',
            'Analista de Inversión Pública',
            'Auditor Institucional',
            'Consulta Institucional',
        ],

        /*
        |--------------------------------------------------------------------------
        | Administración
        |--------------------------------------------------------------------------
        */

        'reportes' => [
            'Administrador del Sistema',
            //'Administrador Institucional',
            'Director de Planificación',
            'Analista de Planificación',
            'Director de Inversión Pública',
            'Analista de Inversión Pública',
            'Auditor Institucional',
        ],

        'auditoria' => [
            'Administrador del Sistema',
            'Auditor Institucional',

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Permisos por acción
    |--------------------------------------------------------------------------
    */

    'acciones' => [

        'usuarios' => [

            'crear' => [
                'Administrador del Sistema',
                'Administrador Institucional',
            ],

            'editar' => [
                'Administrador del Sistema',
                'Administrador Institucional',
            ],

            'estado' => [
                'Administrador del Sistema',
                'Administrador Institucional',
            ],

            'editarRol' => [
                'Administrador del Sistema',
            ],

            'editarEntidad' => [
                'Administrador del Sistema',
            ],

            'editarPassword' => [
                'Administrador del Sistema',
                'Administrador Institucional',
            ],

        ],

        'roles' => [

            'crear' => [
                'Administrador del Sistema',
            ],

            'editar' => [
                'Administrador del Sistema',
            ],

            'estado' => [
                'Administrador del Sistema',
            ],

        ],

        'entidades' => [

            'crear' => [
                'Administrador del Sistema',
            ],

            'editar' => [
                'Administrador del Sistema',
                'Administrador Institucional',
            ],

            'estado' => [
                'Administrador del Sistema',
            ],

        ],

    ],

];