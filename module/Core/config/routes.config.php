<?php

return array(
    'routes' => array(
        'user' => array(
            'type' => 'Segment',
            'options' => array(
                'route' => '/users[/:id]',
                'constraints' => array(
                    'id' => '[0-9]+',
                ),
                'defaults' => array(
                    'controller' => 'UserController',
                )
            )
        )
    )
);