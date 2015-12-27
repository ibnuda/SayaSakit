<?php
/**
 * Created by PhpStorm.
 * User: Ibnu
 * Date: 27/12/2015
 * Time: 15.21
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'Prajurit\Controller\Prajurit' => 'Prajurit\Controller\PrajuritController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'prajurit' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/prajurit[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Prajurit\Controller\Prajurit',
                        'action' => 'index',
                    )
                )
            )
        )
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'prajurit' => __DIR__ . '/../view',
        ),
    ),
);