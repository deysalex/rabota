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
            'User\Controller\User' => 'User\Controller\UserController',
            'User\Controller\Info' => 'User\Controller\InfoController',
            'User\Controller\Subscription' => 'User\Controller\SubscriptionController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'user' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/user[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\User',
                        'action'     => 'index',
                    ),
                ),
            ),
            'info' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/info[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Info',
                        'action'     => 'index',
                    ),
                ),
            ),
            'subscription' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/subscription[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Subscription',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            'user' => __DIR__ . '/../view',
        ),
    ),
);