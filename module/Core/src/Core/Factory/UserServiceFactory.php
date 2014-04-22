<?php

namespace Core\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Core\Service\DoctrineUserService;

class UserServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectManager  = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $userRepository = $serviceLocator->get('UserRepository');

        return new DoctrineUserService($objectManager, $userRepository);
    }
}
