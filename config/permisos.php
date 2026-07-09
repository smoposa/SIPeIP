<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Permisos por módulo
    |--------------------------------------------------------------------------
    |
    | Roles:
    | - Administrador
    | - Administrador Institucional
    | - Director de Planificación
    | - Coordinador de Planificación
    | - Analista de Planificación
    | - Analista de Inversión Pública
    | - Analista de Seguimiento y Evaluación
    | - Auditor del Sistema
    | - Consulta Institucional
    |
    */

    'modulos' => [

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        'dashboard' => [
            'Administrador',
            'Administrador Institucional',
            'Director de Planificación',
            'Coordinador de Planificación',
            'Analista de Planificación',
            'Analista de Inversión Pública',
            'Analista de Seguimiento y Evaluación',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],

        /*
        |--------------------------------------------------------------------------
        | Configuración
        |--------------------------------------------------------------------------
        */

        'usuarios' => [
            'Administrador',
            'Administrador Institucional',
        ],

        'roles' => [
            'Administrador',
            'Administrador Institucional',
        ],

        'entidades' => [
            'Administrador',
            'Administrador Institucional',
        ],

        /*
        |--------------------------------------------------------------------------
        | Planificación
        |--------------------------------------------------------------------------
        */

        'planes' => [
            'Administrador',
         //   'Administrador Institucional',
            'Director de Planificación',
            'Coordinador de Planificación',
            'Analista de Planificación',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],

        'objetivos' => [
            'Administrador',
         //   'Administrador Institucional',
            'Director de Planificación',
            'Coordinador de Planificación',
            'Analista de Planificación',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],
                'metas' => [
            'Administrador',
            //'Administrador Institucional',
            'Director de Planificación',
            'Coordinador de Planificación',
            'Analista de Planificación',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],

        'indicadores' => [
            'Administrador',
         //   'Administrador Institucional',
            'Director de Planificación',
            'Coordinador de Planificación',
            'Analista de Planificación',
            'Analista de Seguimiento y Evaluación',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],

        /*
        |--------------------------------------------------------------------------
        | Inversión
        |--------------------------------------------------------------------------
        */

        'proyectos' => [
            'Administrador',
          //  'Administrador Institucional',
            'Director de Planificación',
            'Coordinador de Planificación',
            'Analista de Planificación',
            'Analista de Inversión Pública',
            'Analista de Seguimiento y Evaluación',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],

        'presupuesto' => [
            'Administrador',
           // 'Administrador Institucional',
            'Director de Planificación',
            'Analista de Inversión Pública',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],

        /*
        |--------------------------------------------------------------------------
        | Seguimiento
        |--------------------------------------------------------------------------
        */

        'seguimiento' => [
            'Administrador',
            //'Administrador Institucional',
            'Director de Planificación',
            'Coordinador de Planificación',
            'Analista de Inversión Pública',
            'Analista de Seguimiento y Evaluación',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],

        'evaluacion' => [
            'Administrador',
            //'Administrador Institucional',
            'Director de Planificación',
            'Coordinador de Planificación',
            'Analista de Inversión Pública',
            'Analista de Seguimiento y Evaluación',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],

        /*
        |--------------------------------------------------------------------------
        | Administración
        |--------------------------------------------------------------------------
        */

        'reportes' => [
            'Administrador',
       //     'Administrador Institucional',
            'Director de Planificación',
            'Coordinador de Planificación',
            'Analista de Planificación',
            'Analista de Inversión Pública',
            'Analista de Seguimiento y Evaluación',
            'Auditor del Sistema',
            'Consulta Institucional',
        ],

        'auditoria' => [
            'Administrador',
            'Auditor del Sistema',
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
                'Administrador',
                'Administrador Institucional',
            ],

            'editar' => [
                'Administrador',
                'Administrador Institucional',
            ],

            'estado' => [
                'Administrador',
                'Administrador Institucional',
            ],

            'editarRol' => [
                'Administrador',
                'Administrador Institucional',
            ],

            'editarEntidad' => [
                'Administrador',

            ],

            'editarPassword' => [
                'Administrador',
                'Administrador Institucional',
            ],

        ],

    ],

];