<?php

namespace Core\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Core\InputFilter\UserInputFilter;

class UserInputFilterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $formElementManager)
    {
        $services       = $formElementManager->getServiceLocator();
        $userRepository = $services->get('UserRepository');

        $inputFilter = new UserInputFilter();
        $inputFilter->setUserRepository($userRepository);

        return $inputFilter;
    }
}
