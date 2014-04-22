<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'port' => '3306',
                    'charset' => 'UTF8'
                )
            )
        ),
        'migrations' => array(
            'migrations_table' => 'migrations',
            'migrations_namespace' => 'ZF2RESTAPI',
            'migrations_directory' => 'data/migrations',
        ),
    ),
);