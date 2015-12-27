<?php
/**
 * Created by PhpStorm.
 * User: Ibnu
 * Date: 27/12/2015
 * Time: 20.50
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'Senjata\Controller\Senjata' => 'Senjata\Controller\SenjataController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'senjata' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/senjata[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Senjata\Controller\Senjata',
                        'action' => 'index',
                    )
                )
            )
        )
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'senjata' => __DIR__ . '/../view',
        ),
    ),
);
