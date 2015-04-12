<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 12.04.2015
 * Time: 21:05
 */
return array(
    'service_manager' => array(
        'invokables' => array(
            'Blog\Service\PostServiceInterface' => 'Blog\Service\PostService'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory'
        )
    ),
    'router' => array(
        // Open configuration for all possible routes
        'routes' => array(
            // Define a new route called "post"
            'post' => array(
                // Define the routes type to be "Zend\Mvc\Router\Http\Literal", which is basically just a string
                'type' => 'literal',
                // Configure the route itself
                'options' => array(
                    // Listen to "/blog" as uri
                    'route'    => '/blog',
                    // Define default controller and action to be called when this route is matched
                    'defaults' => array(
                        'controller' => 'Blog\Controller\List',
                        'action'     => 'index',
                    )
                )
            )
        )
    )
);