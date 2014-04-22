<?php

namespace Core\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Core\Controller\UserController;

class UserControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $controllers)
    {
        $services       = $controllers->getServiceLocator();
        $userService    = $services->get('UserService');
        $userForm       = $services->get('UserForm');

        $userController = new UserController();
        $userController->setUserService($userService);
        $userController->setUserForm($userForm);

        return $userController;
    }
}
