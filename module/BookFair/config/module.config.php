<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'BookFair\Controller\BookFair' => 'BookFair\Controller\BookFairController',
            'BookFair\Controller\School' => 'BookFair\Controller\SchoolController',            
        ),
    ),
    
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'bookfair' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/bookfair[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'BookFair\Controller\BookFair',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'school' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/school[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'BookFair\Controller\School',
                        'action'     => 'index',
                    ),
                ),
            ),
            
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'book_fair' => __DIR__ . '/../view',
        ),
    ),
);