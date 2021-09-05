<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'School\Controller\School' => 'School\Controller\SchoolController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'school' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/school[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'School\Controller\School',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'school' => __DIR__ . '/../view',
        ),
    ),
);