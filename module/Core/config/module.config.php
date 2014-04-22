<?php
return array(
    'router' => include('routes.config.php'),
    'view_manager' => array(
        'display_exceptions' => true,
        'strategies' => array('ViewJsonStrategy'),
    ),
    'doctrine' => array(
        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(
                    'Gedmo\Timestampable\TimestampableListener',
                ),
            ),
        ),
        'driver' => array(
            'core_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Core\Entity' => 'core_annotation_driver'
                )
            )
        ),
    ),
);
