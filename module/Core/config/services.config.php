<?php

return array(
    'factories' => array(

        // Entity Repositories
        'UserRepository' => 'Core\Factory\UserRepositoryFactory',

        // Entity Services
        'UserService'	 => 'Core\Factory\UserServiceFactory',

        // Forms
        'UserForm'	     => 'Core\Factory\UserFormFactory',
    ),
);
