<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 11.04.2015
 * Time: 15:02
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'Post\Controller\Post' => 'Post\Controller\PostController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'post' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/post[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Post\Controller\Post',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'post' => __DIR__ . '/../view',
        ),
    ),
);