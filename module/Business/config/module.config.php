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
            'Business\Controller\Vacancy' => 'Business\Controller\VacancyController',
            'Business\Controller\Agency' => 'Business\Controller\AgencyController',
            'Business\Controller\Subscription' => 'Business\Controller\ResumeController',
            'Business\Controller\Group' => 'Business\Controller\GroupController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'vacancy' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/vacancy[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Business\Controller\Vacancy',
                        'action'     => 'index',
                    ),
                ),
            ),
            'agency' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/agency[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Business\Controller\Agency',
                        'action'     => 'index',
                    ),
                ),
            ),
            'resume' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/resume[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Business\Controller\Resume',
                        'action'     => 'index',
                    ),
                ),
            ),
            'group' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/group[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Business\Controller\Group',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'business' => __DIR__ . '/../view',
        ),
    ),
);