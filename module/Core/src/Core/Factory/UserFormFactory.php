<?php

namespace Core\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Core\Entity\User;
use Core\Form\UserForm;

class UserFormFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $formElementManager)
    {
        $inputFilter = $formElementManager->get('InputFilterManager')->get('UserInputFilter');
        $userEntity  = new User();

        $userForm = new UserForm();
        $userForm->setInputFilter($inputFilter);
        $userForm->setUserEntity($userEntity);

        return $userForm;
    }
}
