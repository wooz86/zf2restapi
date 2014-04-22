<?php

return array(
    'factories' => array(

        // Repositories
        'UserRepository' => 'User\Factory\UserRepositoryFactory',

        // Entity Services
        'UserService'	 => 'User\Factory\UserServiceFactory',

        // Forms
        'UserForm'	     => 'User\Factory\UserFormFactory',
    ),
);
